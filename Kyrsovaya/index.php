<?php
require_once 'admin/Property.php';
session_start();

if (isset($_SESSION['success_message'])) {
	echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
	unset($_SESSION['success_message']); // удаляем сообщение из сессии после отображения
}

$property = new Property();
$properties = $property->getPropertyData();

// Проверяем авторизацию пользователя
if (!isset($_SESSION['user_id'])) {
	$is_user_authorized = false;
} else {
	$is_user_authorized = true;
}

// Далее идет ваш код для вывода данных
?>
<!DOCTYPE html>
<html>

<head>
	<title>Недвижимость</title>
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

		.card-img-top {
			height: 300px;
			object-fit: cover;
		}

		.card {
			height: 100%;
		}

		.card-body {

			display: flex;
			flex-direction: column;
			justify-content: space-between;
		}

		.card {
			margin-bottom: 30px;
			transition: transform .3s ease-in-out;
		}

		.card:hover {
			transform: scale(1.05);
		}

		footer {
			background-color: #f8f9fa;
			padding: 15px 0;
			text-align: center;
			font-size: 14px;
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
			<h2 class="text-center">Продажа квартир</h2>
			<div class="row">
				<?php foreach ($properties as $property): ?>
					<?php if ($property["id"] <= 3): ?>
						<div class="col-md-4">
							<div class="card">
								<img src="<?php echo $property["image"]; ?>" class="card-img-top"
									alt="<?php echo $property["title"]; ?>">
								<div class="card-body">
									<h5 class="card-title">
										<?php echo $property["title"]; ?>
									</h5>
									<p class="card-text">
										<?php echo substr($property["description"], 0, 100) . '...'; ?>
									</p>
									<p class="card-text"><strong>Цена:</strong>
										<?php echo $property["price"]; ?> руб.
									</p>
									<a href="more_details.php?id=<?php echo $property["id"]; ?>"
										class="btn btn-primary">Подробнее</a>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="container">
			<h2 class="text-center">Новостройки</h2>
			<div class="row">
				<?php foreach ($properties as $property): ?>
					<?php if ($property["id"] >= 4 && $property["id"] <= 6): ?>
						<div class="col-md-4">
							<div class="card">
								<img src="<?php echo $property["image"]; ?>" class="card-img-top"
									alt="<?php echo $property["title"]; ?>">
								<div class="card-body">
									<h5 class="card-title">
										<?php echo $property["title"]; ?>
									</h5>
									<p class="card-text">
										<?php echo substr($property["description"], 0, 100) . '...'; ?>
									</p>
									<p class="card-text"><strong>Цена:</strong>
										<?php echo $property["price"]; ?> руб.
									</p>
									<a href="more_details.php?id=<?php echo $property["id"]; ?>"
										class="btn btn-primary">Подробнее</a>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</section>

		<section class="container">
			<h2 class="text-center">Аренда</h2>
			<div class="row">
				<?php foreach ($properties as $property): ?>
					<?php if ($property["id"] >= 7 && $property["id"] <= 9): ?>
						<div class="col-md-4">
							<div class="card">
								<img src="<?php echo $property["image"]; ?>" class="card-img-top"
									alt="<?php echo $property["title"]; ?>">
								<div class="card-body">
									<h5 class="card-title">
										<?php echo $property["title"]; ?>
									</h5>
									<p class="card-text">
										<?php echo substr($property["description"], 0, 100) . '...'; ?>
									</p>
									<p class="card-text"><strong>Цена:</strong>
										<?php echo $property["price"]; ?> руб/мес.
									</p>
									<a href="more_details.php?id=<?php echo $property["id"]; ?>"
										class="btn btn-primary">Подробнее</a>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
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