<?php
require_once 'admin/DBconnect.php';

class UserRegistration {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function registerUser($email, $password, $name) {
        $conn = $this->db->connect_pdo();

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return ['status' => 'error', 'message' => 'Этот email уже зарегистрирован'];
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':name', $name);

            if ($stmt->execute()) {
                return ['status' => 'success', 'message' => 'Регистрация прошла успешно'];
            } else {
                return ['status' => 'error', 'message' => 'Ошибка при регистрации'];
            }
        }

        $this->db->close_connect();
    }
}
