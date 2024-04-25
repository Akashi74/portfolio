<?php
require_once 'admin/DBconnect.php';

class AdminPanel {
    private $db;
    private $pdo;

    public function __construct() {
        $this->db = new Database();
        $this->pdo = $this->db->connect_pdo();
    }

    public function getEmployees() {
        $sql = "SELECT id, name, email, phone, position, salary FROM employees";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
