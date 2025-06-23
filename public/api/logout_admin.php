<?php
//清除session
session_start();
session_unset();
session_destroy();
include('cross_domain.php');

echo json_encode(['success' => true]);
?>