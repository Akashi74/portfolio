<?php

require_once '..\admin\DBconnect.php';

class Owner
{
    private $db;
    private $pdo;

    public function __construct()
    {
        $this->db = new Database();
        $this->pdo = $this->db->connect_pdo();
    }

    public function getAllOwners()
    {
        $sql = "SELECT id, name, email, phone, address FROM owners";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
