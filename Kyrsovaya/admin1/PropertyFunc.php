<?php
require_once '..\admin\DBconnect.php';

class Property
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect_pdo();
    }

    public function getProperties($limit, $start)
    {
        $sql = "SELECT id, owner_id, title, description, price, area, rooms, address, image FROM properties LIMIT $start, $limit";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPropertiesCount()
    {
        $sql_count = "SELECT COUNT(*) as total_rows FROM properties";
        $stmt_count = $this->pdo->query($sql_count);
        $row_count = $stmt_count->fetch(PDO::FETCH_ASSOC);
        return $row_count['total_rows'];
    }
}
