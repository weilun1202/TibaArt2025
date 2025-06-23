<?php
// header("Access-Control-Allow-Origin: *");   //支持的所有跨網域請求的
// header("Access-Control-Allow-Origin: https://tibamef2e.com");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json");
header('Access-Control-Allow-Credentials: true');   //是否允許發送Cookie(需精確指定一個網域使用)

// 處理預檢請求（CORS 預先請求）
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
?>