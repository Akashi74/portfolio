<?php
require_once 'admin/DBconnect.php';

class Feedback
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->pdo = $this->db->connect_pdo();
    }

    public function send()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $message = $_POST['message'];

            $sql = "INSERT INTO feedback (name, email, phone, message, created_at) VALUES (?, ?, ?, ?, NOW())";

            if ($this->pdo) {
                $stmt = $this->pdo->prepare($sql);
            } else {
                die("Ошибка подключения к базе данных");
            }

            $stmt->bindValue(1, $name);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $phone);
            $stmt->bindValue(4, $message);

            if ($stmt->execute()) {
                return "Сообщение успешно отправлено!";
            } else {
                return "Ошибка при отправке сообщения. Попробуйте еще раз.";
            }

            $stmt->closeCursor();
        }
    }
}
