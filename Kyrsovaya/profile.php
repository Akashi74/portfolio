<?php
session_start();
require_once 'admin/userProfile.php';

// Получаем ID пользователя из сессии
$user_id = $_SESSION['user_id'];

// Вызываем функцию для получения данных пользователя
$user = getUserProfile($user_id);

// Выход из профиля
if (isset($_GET['logout'])) {
	session_destroy();
	header('Location: index.php');
	exit();
}

// Проверяем авторизацию пользователя
if (!isset($_SESSION['user_id'])) {
	$is_user_authorized = false;
} else {
	$is_user_authorized = true;
}
?>


<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Профиль</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<style>
	html,
	body {
		height: 100%;
	}

	body {
		display: flex;
		flex-direction: column;
	}

	footer {
		background-color: #f8f9fa;
		padding: 15px 0;
		text-align: center;
		font-size: 14px;
		margin-top: auto;
		/* Добавлено */
	}
</style>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="index.php">Недвижимость</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
					aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="catalog.php">Каталог</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="about.php">О нас</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index3.php">Услуги</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contacts.php">Контакты</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="otziv.php">Отзывы</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="profile.php">Профиль</a>
						</li>
						<?php if (!$is_user_authorized): ?>
							<li class="nav-item">
								<a class="nav-link" href="login.php">Авторизация</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="register.php">Регистрация</a>
							</li>
						<?php endif; ?>

						<?php if ($user['role'] == 1): ?>
							<li class="nav-item">
								<a class="nav-link" href="adminka.php">Админ-панель</a>
							</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</nav>
	</header>
	<div class="container">
		<h1>Профиль</h1>
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Имя:
					<?php echo $user['name']; ?>
				</h5>
				<h6 class="card-subtitle mb-2 text-muted">Email:
					<?php echo $user['email']; ?>
				</h6>
				<p class="card-text">Телефон:
					<?php echo $user['phone']; ?>
				</p>
				<a href="editprofile.php" class="btn btn-primary">Редактировать профиль</a>
				<a href="?logout" class="btn btn-danger">Выйти из профиля</a>
			</div>
		</div>
	</div>
	<footer>
		<div class="container">
			<p>&copy; 2024 Недвижимость</p>
		</div>
	</footer>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="script.js"></script>
</body>

</html>