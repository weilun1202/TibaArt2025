<?php
include ('cross_domain.php');
include('conn.php');

// 檢查請求方式
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => '請使用 POST 方法']);
    exit;
}

// 驗證必要欄位
if (!isset($_POST['id'])) {
    echo json_encode(['success' => false, 'message' => '缺少作品ID']);
    exit;
}

$id = $_POST['id'];

// 取得原本的資料
$stmt = $pdo->prepare("SELECT * FROM ARTWORK WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$artwork = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$artwork) {
    echo json_encode(['success' => false, 'message' => '找不到該作品資料']);
    exit;
}

$name = $_POST['name'] ?? $artwork['name'];
$name_en = $_POST['name_en'] ?? $artwork['name_en'];
$stuff = $_POST['stuff'] ?? $artwork['stuff'];
$size = $_POST['size'] ?? $artwork['size'];
$note = $_POST['note'] ?? $artwork['note'];
$artist_id = $_POST['artist_id'] ?? $artwork['artist_id'];


// 圖片上傳處理
$img = $artwork['img'];
if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/artworks/';
    $fileName = uniqid() . '_' . $_FILES['img']['name'];
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['img']['tmp_name'], $filePath)) {
        $img = '/uploads/artworks/' . $fileName;
    } else {
        echo json_encode(['success' => false, 'message' => '圖片上傳失敗']);
        exit;
    }
}

try {
  $sql = "
      UPDATE ARTWORK 
      SET
        name = :name, 
        name_en = :name_en, 
        stuff = :stuff, 
        size = :size, 
        note = :note, 
        artist_id = :artist_id, 
        img = :img
      WHERE
        id = :id
  "

  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':name', $name);
  $stmt->bindValue(':name_en', $name_en);
  $stmt->bindValue(':stuff', $stuff);
  $stmt->bindValue(':size', $size);
  $stmt->bindValue(':note', $note );
  $stmt->bindValue(':artist_id', $artist_id);
  $stmt->bindValue(':img', $img);

// 執行資料庫操作
    $stmt->execute();
    echo json_encode(['success' => true, 'message' => '更新成功']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => '資料庫錯誤', 'error' => $e->getMessage()]);
}

?>