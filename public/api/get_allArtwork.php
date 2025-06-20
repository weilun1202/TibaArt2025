<?php
include('cross_domain.php');
include ('conn.php');

// --------------------------------------------------

try {
    $stmt = $pdo->query("SELECT id, name, name_en FROM ARTWORK");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => '讀取藝術家失敗']);
}
?>


