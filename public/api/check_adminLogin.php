<?php
session_start();
include('cross_domain.php');

echo json_encode([
    "loggedAdmin" => isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true
]);