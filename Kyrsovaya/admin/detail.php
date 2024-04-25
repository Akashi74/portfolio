<?php
require_once 'admin/DBconnect.php';

class Detail
{
    private $db;
    private $conn;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->connect_pdo();
    }

    public function getPropertyDetails($property_id)
    {
        $sql = "SELECT * FROM properties WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $property_id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getPropertyImages($property_id)
    {
        $sql = "SELECT * FROM foto WHERE id_propertyes = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $property_id);
        $stmt->execute();

        return $stmt;
    }

    public function isUserAuthorized()
    {
        if (!isset($_SESSION['user_id'])) {
            return false;
        } else {
            return true;
        }
    }

    public function addRequest($client_id, $property_id, $status_id, $request_status_id, $date, $comment)
    {
        $sql = "SELECT * FROM users WHERE user_id = :client_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':client_id', $client_id);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            echo "Пользователь с указанным client_id не существует";
            exit;
        }

        $sql = "INSERT INTO requests (client_id, property_id, status_id, request_status_id, date, comment)
                VALUES (:client_id, :property_id, :status_id, :request_status_id, :date, :comment)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':property_id', $property_id);
        $stmt->bindParam(':status_id', $status_id);
        $stmt->bindParam(':request_status_id', $request_status_id);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':comment', $comment);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = 'Ваша заявка успешно отправлена!';
            header("Location: index.php");
            exit();
        } else {
            echo '<div class="alert alert-danger">Ошибка при отправке заявки. Пожалуйста, попробуйте снова.</div>';
        }
    }

    public function __destruct()
    {
        $this->db->close_connect();
    }
}
?>