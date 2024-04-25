<?php
require_once 'admin\DBconnect.php';
session_start();
class Property
{
    public function getPropertyData()
    {
        $db = new Database();
        $conn = $db->connect_pdo();

        $sql = "SELECT * FROM properties ORDER BY id ASC LIMIT 9";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $properties = $stmt->fetchAll();

        $db->close_connect();

        return $properties;

    }

}
?>