<?php
session_start();
require_once 'admin/reviews.php';

// Создаем экземпляр класса Reviews
$reviewsObj = new Reviews();

// Вызываем функцию для получения отзывов
$reviews = $reviewsObj->getReviews();

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
	<title>О нас</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<style>
			footer {
			background-color: #f8f9fa;
			padding: 15px 0;
			text-align: center;
			font-size: 14px;
		}
</style>
<body>
	<!-- Шапка сайта -->
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

	<!-- Основное содержимое -->
	<main>
		<section class="container">
			<h2 class="text-center">Отзывы о нас</h2>
			<div class="row">
				<?php foreach ($reviews as $review): ?>
					<div class="col-md-12">
						<div class="card mb-4">
							<div class="card-body">
								<h5 class="card-title">Отзыв от
									<?php echo $review["client_name"]; ?>
								</h5>

								<p class="card-text">
									<?php echo $review["comment"]; ?>
								</p>
								<p class="card-text"><strong>Рейтинг:</strong>
									<?php echo $review["rating"]; ?>
								</p>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	</main>

	<!-- Подвал сайта -->
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