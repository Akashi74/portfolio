<?php
require_once 'admin/DBconnect.php';
session_start();

$db = new Database();
$pdo = $db->connect_pdo();

// Проверяем авторизацию пользователя
if (!isset($_SESSION['user_id'])) {
	$is_user_authorized = false;
} else {
	$is_user_authorized = true;
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Услуги</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<style>
		body {
			font-family: Arial, sans-serif;
		}

		header {
			background-color: #f8f9fa;
		}

		.navbar-brand {
			font-weight: bold;
		}

		.navbar-nav .nav-link {
			font-weight: bold;
			color: #333;
		}

		.navbar-nav .nav-link:hover {
			color: #007bff;
		}

		.card {
			margin-bottom: 30px;
			transition: transform .3s ease-in-out;
		}

		.card:hover {
			transform: scale(1.05);
		}

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
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<main>
		<section class="container">
			<h2 class="text-center">Наши услуги</h2>
			<div class="row">
				<div class="col-md-4">
					<div class="card">
						<img src="img\754678190004037.jpeg" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title">Аренда квартир</h5>
							<p class="card-text">Найдите подходящее жилье для аренды в нашем каталоге. Мы предлагаем
								широкий выбор квартир по всему городу.</p>
							<a href="#" class="btn btn-primary">Подробнее</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<img src="img\1-bukhgalterskie-uslugi-dlya-ip-960h540-960x540.jpg" class="card-img-top"
							alt="...">
						<div class="card-body">
							<h5 class="card-title">Управление недвижимостью</h5>
							<p class="card-text">Мы предлагаем услуги по управлению недвижимостью, включая сбор арендной
								платы, ремонт и техническое обслуживание.</p>
							<a href="#" class="btn btn-primary">Подробнее</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card">
						<img src="img\img.jpg" class="card-img-top" alt="...">
						<div class="card-body">
							<h5 class="card-title">Продажа недвижимости</h5>
							<p class="card-text">Если вы хотите продать свою недвижимость, мы поможем вам найти
								покупателя и оформить сделку.</p>
							<a href="#" class="btn btn-primary">Подробнее</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
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