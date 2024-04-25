<?php
require_once 'admin/DBconnect.php';

function getUserProfile($user_id) {
    $db = new Database();
    $conn = $db->connect_pdo();

    if (!$user_id) {
        die('Ошибка: пользователь не авторизован');
    }

    $sql = "SELECT * FROM users WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    $user = $stmt->fetch();

    $db->close_connect();

    return $user;
}
?>
