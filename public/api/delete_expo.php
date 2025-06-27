<?php
  

  include('cross_domain.php');
  include ('conn.php');
        
  //---------------------------------------------------

  $expo = json_decode(file_get_contents("php://input"), true);
  $id = $expo['id'] ?? null;

  if (!$id) {
    echo json_encode(['success' => false, 'message' => '缺少 ID']);
    exit;
  }

  try {
    // 1. 刪除 EXPO_ARTWORK 中引用這筆 expo 的紀錄
    $stmt = $pdo->prepare("DELETE FROM EXPO_ARTWORK WHERE expo_id = :id");
    $stmt->execute([':id' => $id]);

    // 2. 查詢圖片路徑
    $stmt = $pdo->prepare("SELECT cover FROM EXPO WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
      echo json_encode(['success' => false, 'message' => '找不到此筆資料']);
      exit;
    }

    $coverPath = $row['cover'];
    $delete_check='true';
    if (!empty($coverPath)) {
      $fullPath = $_SERVER["DOCUMENT_ROOT"] . '/tjd101/g2' .$coverPath;
      // $fullPath = __DIR__ . $coverPath;

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

    // 3. 刪除 EXPO 資料
    $stmt = $pdo->prepare("DELETE FROM EXPO WHERE id = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount()) {
      echo json_encode(['success' => true,'cover_path'=>$fullPath,'delete_check'=>$delete_check]);
    } else {
      echo json_encode(['success' => false, 'message' => '資料刪除失敗']);
    }

  } catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

  // file_put_contents('debug.log', print_r($expo, true));
