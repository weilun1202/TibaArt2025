<?php
  
  include('cross_domain.php');
  include ('conn.php');
        
  //---------------------------------------------------

  $expo = json_decode(file_get_contents("php://input"), true);

  // 檢查必要欄位
if (
    empty($expo['name']) ||
    empty($expo['type']) ||
    empty($expo['des']) ||
    empty($expo['price']) ||
    empty($expo['stock']) ||
    empty($expo['img'])
) {
    http_response_code(400);
    echo json_encode(['error' => '缺少必要欄位']);
    exit;
}

$updated = empty($expo['updated']) ? null : $expo['updated'];

$sql = "
    INSERT INTO PRODUCT (name, type, des, price, stock, img)
    VALUES (:name, :type, :des, :price, :stock, :img)
";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $expo['name']);
$stmt->bindValue(':type', $expo['type']);
$stmt->bindValue(':des', $expo['des']);
$stmt->bindValue(':price', $expo['price']);
$stmt->bindValue(':stock', $expo['stock']);
$stmt->bindValue(':img', $expo['img']);

// 執行資料庫操作
try {
    $stmt->execute();
    echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

// file_put_contents('debug.log', print_r($artwork, true));