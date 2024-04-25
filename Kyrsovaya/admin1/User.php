<?php
class User {
  private $db;

  public function __construct() {
    require_once '..\admin\DBconnect.php';
    $this->db = new Database();
    $this->pdo = $this->db->connect_pdo();
  }

  public function getUsers() {
    $sql = "SELECT user_id, name, email, phone, password FROM users";
    $stmt = $this->pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }

  public function deleteUser($id) {
    $sql = "DELETE FROM users WHERE user_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
  }

  public function updateUser($id, $name, $email, $phone, $password) {
    $sql = "UPDATE users SET name = :name, email = :email, phone = :phone, password = :password WHERE user_id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':password', $password);

    return $stmt->execute();
  }
}
