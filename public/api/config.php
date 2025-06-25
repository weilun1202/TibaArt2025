<?php
// config.php - 環境設定檔

// Google OAuth 設定
define('GOOGLE_CLIENT_ID', '360104213341-jfogr4douuub3tj81tldrdotgqs7ga1c.apps.googleusercontent.com');
// define('GOOGLE_CLIENT_SECRET', '');

// JWT 設定
define('JWT_SECRET', 'your-jwt-secret-key-change-this-in-production');

// 資料庫設定
// define('DB_HOST', '127.0.0.1');
// define('DB_USER', 'root');
// define('DB_PASS', 'password');
// define('DB_NAME', 'TIBAART');

// Tibame 設定
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'tibamefe_since2021');
define('DB_PASS', 'vwRBSb.j&K#E');
define('DB_NAME', 'tibamefe_tjd101g2');

// 其他設定
define('FRONTEND_URL', 'http://localhost:5173'); // 你的前端網址
define('API_BASE_URL', 'http://localhost/TIBAART/api');

// 錯誤報告設定（開發環境）
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 時區設定
date_default_timezone_set('Asia/Taipei');
?>