<?php
require_once 'DBconnect.php';

function addEmployee($name, $email, $phone, $position, $salary) {
    $db = new Database();
    $pdo = $db->connect_pdo();

    $sql = "INSERT INTO employees (name, email, phone, position, salary) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $phone, $position, $salary]);
}
