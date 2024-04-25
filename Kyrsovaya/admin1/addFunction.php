<?php
require_once 'admin/DBconnect.php';

function addRecord($table) {
    session_start();

    // Проверяем авторизацию пользователя
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../../index.php');
        exit();
    }

    $db = new Database();
    $pdo = $db->connect_pdo();

    $success_message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($table === 'employees') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $position = $_POST['position'];
            $salary = $_POST['salary'];

            $sql = "INSERT INTO employees (name, email, phone, position, salary) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $email, $phone, $position, $salary]);

            $success_message = 'Сотрудник успешно добавлен';
        } elseif ($table === 'properties') {
            $owner_id = $_POST['owner_id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $area = $_POST['area'];
            $rooms = $_POST['rooms'];
            $address = $_POST['address'];
            $image = $_FILES['image']['name'];
            $image_tmp_path = $_FILES['image']['tmp_name'];
            $image_upload_path = '../uploads/' . $image;

            move_uploaded_file($image_tmp_path, $image_upload_path);

            $sql = "INSERT INTO properties (owner_id, title, description, price, area, rooms, address, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$owner_id, $title, $description, $price, $area, $rooms, $address, $image]);

            $success_message = 'Недвижимость успешно добавлена';
        }
    }
    

    return $success_message;
}
?>
