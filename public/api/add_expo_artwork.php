<?php
  
  include('cross_domain.php');
  include ('conn.php');
        
  //---------------------------------------------------

  $data = json_decode(file_get_contents("php://input"), true);

  $expo_id = $data['expo_id'] ?? null;
  $artwork_ids = $data['artwork_ids'] ?? [];

  try {
    $sql = "
        INSERT INTO EXPO_ARTWORK (expo_id, artwork_id)
        VALUES (:expo_id, :artwork_id)
    ";

    $stmt = $pdo->prepare($sql);
    foreach ($artwork_ids as $artwork_id) {
          $stmt->execute([
              ':expo_id' => $expo_id,
              ':artwork_id' => $artwork_id
          ]);
      }
    echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
  }

  // file_put_contents('debug.log', print_r($artwork, true));