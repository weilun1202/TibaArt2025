<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// 預檢請求處理
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once 'lib/google-api-php-client/vendor/autoload.php'; // Google Client Library
require_once 'config.php';
require_once 'Database.php';
require_once 'JWTHandler.php';

use Google\Client;

// 只允許 POST 請求
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    // 讀取請求資料
    $input = json_decode(file_get_contents('php://input'), true);
    $idToken = $input['idToken'] ?? '';

    if (empty($idToken)) {
        throw new Exception('ID Token is required');
    }

    // 設定 Google Client ID
    $googleClientId = GOOGLE_CLIENT_ID;
    
    // 驗證 Google ID Token
    $client = new Client(['client_id' => $googleClientId]);
    $payload = $client->verifyIdToken($idToken);
    
    if (!$payload) {
        throw new Exception('Invalid ID token');
    }

    // 從 payload 取得用戶資訊
    $googleId = $payload['sub'];
    $email = $payload['email'];
    $name = $payload['name'];
    $picture = $payload['img'] ?? null;
    $emailVerified = $payload['email_verified'] ?? false;

    // 檢查 email 是否已驗證
    if (!$emailVerified) {
        throw new Exception('Email not verified');
    }

    // 連接資料庫
    $db = new Database();
    
    // 檢查用戶是否已存在
    $existingUser = $db->findUserByGoogleId($googleId);
    
    if ($existingUser) {
        // 用戶已存在，更新最後登入時間
        $db->updateLastLogin($existingUser['id']);
        
        // 更新用戶資訊（名稱和頭像可能會改變）
        $db->updateUser($existingUser['id'], [
            'name' => $name,
            'img' => $picture
        ]);
        
        $user = $existingUser;
        $user['name'] = $name; // 更新為最新的名稱
        $user['img'] = $picture; // 更新為最新的頭像
        
    } else {
        // 檢查是否有相同 email 的用戶（可能之前用其他方式註冊）
        $existingEmailUser = $db->findUserByEmail($email);
        
        if ($existingEmailUser) {
            // 如果有相同 email 的用戶，可以選擇合併帳戶或拒絕
            // 這裡選擇拒絕，你可以根據需求調整
            throw new Exception('Email already registered with different method');
        }
        
        // 建立新用戶
        $userData = [
            'google_id' => $googleId,
            'email' => $email,
            'name' => $name,
            'img' => $picture
        ];
        
        $userId = $db->createUser($userData);
        
        if (!$userId) {
            throw new Exception('Failed to create user');
        }
        
        $user = [
            'id' => $userId,
            'google_id' => $googleId,
            'email' => $email,
            'name' => $name,
            'img' => $picture
        ];
    }

    // 生成 JWT Token
    $jwtHandler = new JWTHandler();
    
    $tokenPayload = [
        'user_id' => $user['id'],
        'email' => $user['email'],
        'name' => $user['name']
    ];
    
    $accessToken = $jwtHandler->generateToken($tokenPayload, 3600); // 1小時
    $refreshToken = $jwtHandler->generateRefreshToken($user['id']);

    // 返回成功響應
    echo json_encode([
        'success' => true,
        'message' => 'Login successful',
        'user' => [
            'id' => $user['id'],
            'email' => $user['email'],
            'name' => $user['name'],
            'img' => $user['img']
        ],
        'token' => $accessToken,
        'refreshToken' => $refreshToken
    ]);

} catch (Exception $e) {
    error_log('Google login error: ' . $e->getMessage());
    
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>