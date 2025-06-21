<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

include('cross_domain.php');
include ('conn.php');
        
//---------------------------------------------------
// 上傳圖片至 products 的資料夾
// echo $_SERVER["DOCUMENT_ROOT"];
// echo '<br>'
// echo __DIR__;
// echo '<br>'
if (!isset($_FILES['img'])) {
    echo json_encode(['success' => false, 'message' => '缺少圖片']);
    exit;
}


$uploadDir = $_SERVER["DOCUMENT_ROOT"] . '/tjd101/g2/upload/products/';
// $uploadDir = __DIR__ . '/upload/products/';

$uploadPathForDB ='/upload/products/'; 

$allowedExts = ['jpg', 'jpeg', 'png'];
$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
if (!in_array($ext, $allowedExts)) {
    echo json_encode(['success' => false, 'message' => '不支援的圖片格式']);
    exit;
}

$filename = uniqid('img_') . '.' . $ext;
$targetPath = $uploadDir . $filename; // 實體路徑
$targetPathForDB = $uploadPathForDB . $filename; // 資料庫用相對路徑

if (move_uploaded_file($_FILES['img']['tmp_name'], $targetPath)) {
    echo json_encode(['success' => true, 'url' => $targetPathForDB]);
} else {
    echo json_encode([
        'success' => false,
        'message' => '圖片儲存失敗',
        'debug' => [
            'uploadDir' => $uploadDir,
            'targetPath' => $targetPath,
            'is_writable' => is_writable($uploadDir),
            'file_exists_tmp' => file_exists($_FILES['img']['tmp_name'])
        ]
    ]);
}

// file_put_contents('debug.log', print_r($artist, true));
?>
