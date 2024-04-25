<?php
require_once '..\admin\DBconnect.php';
session_start();

// Проверяем авторизацию пользователя
if (!isset($_SESSION['user_id'])) {
	header('Location: ../../index.php');
	exit();
}

$db = new Database();
$pdo = $db->connect_pdo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

	$_SESSION['success_message'] = 'Недвижимость успешно добавлена';
	header('Location: ../properties.php');
	exit();
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Добавить недвижимость</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="/adminka.php">Админ-панель</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
					aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item active">
							<a class="nav-link" href="employees.php">Сотрудники</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="owners.php">Владельцы</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="properties.php">Недвижимость</a>
						</li>
						<li class="nav-item">
						<li class="nav-item">
							<a class="nav-link" href="reviews1.php">Отзывы</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="status.php">Статус</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<main>
		<section class="container">
			<h2 class="text-center">Добавить недвижимость</h2>
			<form action="add_property.php" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="owner_id">Owner ID</label>
					<input type="text" class="form-control" id="owner_id" name="owner_id" required>
				</div>
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" class="form-control" id="title" name="title" required>
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea class="form-control" id="description" name="description" rows="3" required></textarea>
				</div>
				<div class="form-group">
					<label for="price">Price</label>
					<input type="number" class="form-control" id="price" name="price" required>
				</div>
				<div class="form-group">
					<label for="area">Area</label>
					<input type="number" class="form-control" id="area" name="area" required>
				</div>
				<div class="form-group">
					<label for="rooms">Rooms</label>
					<input type="number" class="form-control" id="rooms" name="rooms" required>
				</div>
				<div class="form-group">
					<label for="address">Address</label>
					<input type="text" class="form-control" id="address" name="address" required>
				</div>
				<div class="form-group">
					<label for="image">Image</label>
					<input type="file" class="form-control-file" id="image" name="image" required>
				</div>
				<button type="submit" class="btn btn-success">Добавить недвижимость</button>
			</form>
		</section>
	</main>
	<footer>
		<!-- Подвал сайта -->
	</footer>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="script.js"></script>
</body>

</html>
