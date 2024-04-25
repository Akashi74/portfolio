<?php
require_once 'admin/DBconnect.php';

class EditProfile {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function edit_profile() {
        session_start();

        // Получаем ID пользователя из сессии
        $user_id = $_SESSION['user_id'];

        // Получаем соединение с базой данных
        $conn = $this->db->connect_pdo();

        // Запрос на получение данных пользователя из базы данных
        $sql = "SELECT * FROM users WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Получаем данные пользователя из результата запроса
        $user = $stmt->fetch();

        // Обработка формы редактирования профиля
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Получаем значения полей формы
            $email = $_POST["email"];
            $password = $_POST["password"];
            $new_password = $_POST["new_password"];
            $confirm_password = $_POST["confirm_password"];
            $phone = $_POST["phone"];

            // Проверяем, что старый пароль введен верно
            if (password_verify($password, $user["password"])) {
                if (!empty($new_password) && $new_password == $confirm_password) {
                    // Хешируем новый пароль
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                    // Обновляем данные пользователя в базе данных
                    $sql = "UPDATE users SET email = :email, password = :password, phone = :phone WHERE user_id = :user_id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':password', $hashed_password);
                    $stmt->bindParam(':phone', $phone);
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->execute();
                } else {
                    // Обновляем только номер телефона
                    $sql = "UPDATE users SET email = :email, phone = :phone WHERE user_id = :user_id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':phone', $phone);
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->execute();
                }

                // Закрываем соединение с базой данных
                $this->db->close_connect();

                // Перенаправляем пользователя на страницу профиля
                header("Location: profile.php");
                exit();
            } else {
                // Выводим сообщение об ошибке, если старый пароль введен неверно
                $error_message = "Старый пароль введен неверно";
            }
        }

        // Проверяем авторизацию пользователя
        if (!isset($_SESSION['user_id'])) {
            $is_user_authorized = false;
        } else {
            $is_user_authorized = true;
        }

        // Возвращаем переменные для использования во view
        return [
            'user' => $user,
            'error_message' => isset($error_message) ? $error_message : null,
            'is_user_authorized' => $is_user_authorized
        ];
    }
}
