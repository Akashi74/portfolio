<?php
require_once 'admin/DBconnect.php';

class Auth {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function login($email, $password) {
        $conn = $this->db->connect_pdo();

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_role'] = $user['role'];

                return true;
            } else {
                return 'Неверный пароль';
            }
        } else {
            return 'Пользователь с таким email не найден';
        }

        $this->db->close_connect();
    }
}
?>
