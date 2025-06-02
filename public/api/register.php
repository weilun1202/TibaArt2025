<?php


$db_host = "127.0.0.1";
$db_user = "root";
$db_pass = "password";
$db_select = "EXAMPLE";  // 更新這裡

$dsn = "mysql:host=".$db_host.";dbname=".$db_select.";charset=utf8";

$pdo = new PDO($dsn, $db_user, $db_pass);

// $sql = "SELECT * FROM MEMBER where username = :usr and password = :pwd";
$sql = '
    insert into MEMBER(USERNAME, PASSWORD, NICKNAME, AVATAR)
    values(:username, :password, :nickname, :avatar)

';

$member = json_decode(file_get_contents("php://input"), true);

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $member['username']);
$stmt->bindValue(':password', $member['password']);
$stmt->bindValue(':nickname', $member['nickname']);
$stmt->bindValue(':avatar', base64_decode($member['avatar']));

$stmt->execute();

$id = $pdo->lastInsertID();
$respBody['id'] = $id; 

echo json_encode($respBody);


// echo $member['username'];
// echo $member['password'];

// $member['pass'] = true;
// echo json_encode($member);

?>