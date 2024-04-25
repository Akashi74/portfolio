<?php
require_once 'admin/DBconnect.php';

class Reviews {
    public function getReviews() {
        // Создаем экземпляр класса Database
        $db = new Database();

        // Получаем соединение с базой данных
        $conn = $db->connect_pdo();

        // Запрос на получение отзывов и информации о пользователях из базы данных
        $sql = "SELECT reviews.*, users.name AS client_name FROM reviews JOIN users ON reviews.client_id = users.user_id ORDER BY reviews.id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Получаем отзывы и информацию о пользователях из результата запроса
        $reviews = $stmt->fetchAll();

        // Закрываем соединение с базой данных
        $db->close_connect();

        return $reviews;
    }
}
?>
