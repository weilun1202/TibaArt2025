<?php

$id = $_GET['id'];

$db_host = "127.0.0.1";
$db_user = "root";
$db_pass = "password";
$db_select = "EXAMPLE";  // 更新這裡

$dsn = "mysql:host=".$db_host.";dbname=".$db_select.";charset=utf8";

$pdo = new PDO($dsn, $db_user, $db_pass);


$sql = 'select avatar from MEMBER where ID = :id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();
$row = $stmt->fetch();


header('Content-Type: image/png');
echo $row['avatar'];








?>