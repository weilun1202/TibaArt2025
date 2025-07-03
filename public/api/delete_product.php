<?php
  

  include('cross_domain.php');
  include ('conn.php');
        
  //---------------------------------------------------

  $product = json_decode(file_get_contents("php://input"), true);
  $id = $product['id'] ?? null;

  if (!$id) {
    echo json_encode(['success' => false, 'message' => '缺少 ID']);
    exit;
  }

  try {
    $stmt = $pdo->prepare("SELECT img FROM PRODUCT WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
      echo json_encode(['success' => false, 'message' => '找不到此筆資料']);
      exit;
    }

    $imgPath = $row['img'];
    $delete_check='true';
    if (!empty($imgPath)) {
      $fullPath = $_SERVER["DOCUMENT_ROOT"] . '/tjd101/g2' .$imgPath;
      // $fullPath = __DIR__ . $imgPath;

      if (file_exists($fullPath)) {
        if (!unlink($fullPath)) {
          $delete_check='刪除失敗';
        }else{
          $delete_check='刪除成功';
        }
      } else {
          $delete_check='圖片不存在：';
      }
    }

    // 3. 刪除 PRODUCT 資料
    $stmt = $pdo->prepare("DELETE FROM PRODUCT WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount()) {
      echo json_encode(['success' => true,'img_path'=>$fullPath,'delete_check'=>$delete_check]);
    } else {
      echo json_encode(['success' => false, 'message' => '資料刪除失敗']);
    }

  } catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

  // file_put_contents('debug.log', print_r($product, true));
