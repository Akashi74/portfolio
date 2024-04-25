<?php
require_once 'admin/DBconnect.php';

class Catalog {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getCatalog($min_price = 50000, $max_price = 150000, $sort_by = 'price', $sort_order = 'ASC') {
        $pdo = $this->db->connect_pdo();

        $sql_conditions = [];
        if ($min_price > 0) {
            $sql_conditions[] = "price >= $min_price";
        }
        if ($max_price > 0) {
            $sql_conditions[] = "price <= $max_price";
        }

        $sql_condition = implode(' AND ', $sql_conditions);

        $sql = "SELECT id, title, description, price, area, rooms, address, image FROM properties";
        if (!empty($sql_condition)) {
            $sql .= " WHERE $sql_condition";
        }
        $sql .= " ORDER BY $sort_by $sort_order";

        $stmt = $pdo->query($sql);

        return $stmt;
    }
}
