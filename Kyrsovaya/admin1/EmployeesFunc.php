<?php
class Employee
{
    private $pdo;
    private $limit;
    private $page;
    private $start;

    public function __construct($pdo, $limit = 10, $page = 1)
    {
        $this->pdo = $pdo;
        $this->limit = $limit;
        $this->page = $page;
        $this->start = ($this->page - 1) * $this->limit;
    }

    public function getAllEmployees()
    {
        $sql = "SELECT id, name, email, phone, position, salary FROM employees LIMIT $this->start, $this->limit";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmployeesCount()
    {
        $sql_count = "SELECT COUNT(*) FROM employees";
        $stmt_count = $this->pdo->query($sql_count);
        return $stmt_count->fetchColumn();
    }
}
