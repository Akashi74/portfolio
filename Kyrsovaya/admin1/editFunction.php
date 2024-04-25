<?php
class EditRecord {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getRecord($table, $fields, $primaryKey, $id) {
        $sql = "SELECT * FROM $table WHERE $primaryKey = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateRecord($table, $fields, $primaryKey, $data, $id) {
        $setFields = [];
        foreach ($fields as $field) {
            $setFields[] = "$field = :$field";
        }
        $sql = "UPDATE $table SET " . implode(', ', $setFields) . " WHERE $primaryKey = :id";
    
        $stmt = $this->pdo->prepare($sql);
        foreach ($fields as $field) {
            $stmt->bindParam(":$field", $data[$field]);
        }
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    
}
?>
