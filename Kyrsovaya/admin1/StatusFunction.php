<?php
class Status {
    private $db;

    public function __construct() {
        require_once '..\admin\DBconnect.php';
        $this->db = new Database();
        $this->pdo = $this->db->connect_pdo();
    }

    public function getRequests() {
        $sql = "SELECT * FROM requests";
        $stmt = $this->pdo->query($sql);
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $requests;
    }
}
