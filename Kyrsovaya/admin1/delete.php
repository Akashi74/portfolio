<?php
require_once '..\admin\DBconnect.php';
$db = new Database();
$pdo = $db->connect_pdo();

// Определяем, какую таблицу удалять
$table = $_GET['table'];

// Определяем id записи для удаления
$id = $_GET['id'];

// Определяем первичный ключ таблицы
switch ($table) {
    case 'employees':
    case 'owners':
    case 'properties':
    case 'reviews':
    case 'requests':
        $primaryKey = 'id';
        break;
    default:
        die('Неверная таблица');
}

// Проверяем, не владелец ли мы пытаемся удалить, и есть ли у него связанные объекты недвижимости
if ($table === 'owners') {
    // Проверяем, есть ли у владельца связанные объекты недвижимости
    $sql = "SELECT COUNT(*) FROM properties WHERE owner_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    // Если есть связанные объекты недвижимости, выводим сообщение об ошибке и прерываем выполнение скрипта
    if ($count > 0) {
        die('Невозможно удалить владельца, у которого есть объекты недвижимости');
    }
}

if ($table === 'employees') {
    $sql = "DELETE FROM contracts WHERE employee_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

// Удаляем запись из базы данных
$sql = "DELETE FROM $table WHERE $primaryKey = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();

// Перенаправляем пользователя на страницу со списком записей
header('Location: ' . $table . '.php');
