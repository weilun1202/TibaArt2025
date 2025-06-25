<?php
  
  include('cross_domain.php');
  include ('conn.php');
        
  //---------------------------------------------------

  $artwork = json_decode(file_get_contents("php://input"), true);
  $id = $artwork['id'] ?? null;

  if (!$id) {
    echo json_encode(['success' => false, 'message' => '缺少 ID']);
    exit;
  }

  try {
    // 1. 刪除 EXPO_ARTWORK 中引用這筆 artwork 的紀錄
    $stmt = $pdo->prepare("DELETE FROM EXPO_ARTWORK WHERE artwork_id = :id");
    $stmt->execute([':id' => $id]);

    // 2. 查詢圖片路徑
    $stmt = $pdo->prepare("SELECT img FROM ARTWORK WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
      echo json_encode(['success' => false, 'message' => '找不到此筆資料']);
      exit;
    }

    $imgPath = $row['img'];
    if (!empty($imgPath)) {
      $fullPath = $_SERVER["DOCUMENT_ROOT"] . '/tjd101/g2' .$imgPath;
      // $fullPath = __DIR__ . $imgPath;

      if (file_exists($fullPath)) {
        if (!unlink($fullPath)) {
          error_log("圖片刪除失敗：" . $fullPath);
        }
      } else {
        error_log("圖片不存在：" . $fullPath);
      }
    }

    // 3. 刪除 ARTWORK 資料
    $stmt = $pdo->prepare("DELETE FROM ARTWORK WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount()) {
      echo json_encode(['success' => true]);
    } else {
      echo json_encode(['success' => false, 'message' => '資料刪除失敗']);
    }

  } catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

  // file_put_contents('debug.log', print_r($artwork, true));
