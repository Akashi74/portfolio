<?php
require_once 'admin/reg.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    $userRegistration = new UserRegistration();
    $result = $userRegistration->registerUser($email, $password, $name);

    if ($result['status'] == 'success') {
        echo '<div class="alert alert-success">' . $result['message'] . '</div>';
    } else {
        echo '<div class="alert alert-danger">' . $result['message'] . '</div>';
    }

    // Проверяем авторизацию пользователя
    if (!isset($_SESSION['user_id'])) {
        $is_user_authorized = false;
    } else {
        $is_user_authorized = true;
    }
}

?>


<!DOCTYPE html>
<html>

<head>
	<title>Регистрация</title>
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

		form {
			max-width: 500px;
			margin: 0 auto;
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
			<h2 class="text-center">Регистрация</h2>
			<form action="register.php" method="post">
				<div class="form-group">
					<label name="name" for="name">Имя:</label>
					<input type="name" class="form-control" id="name" name="name" required>
				</div>
				<div class="form-group">
					<label name="email" for="email">Почта:</label>
					<input type="mail" class="form-control" id="email" name="email" required>
				</div>
				<div class="form-group">
					<label name="password" for="password">Пароль:</label>
					<input type="password" class="form-control" id="password" name="password" required>
				</div>
				<button type="submit" class="btn btn-primary">Зарегистрироваться</button>
			</form>
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