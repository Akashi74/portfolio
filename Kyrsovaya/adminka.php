<?php
require_once 'admin1/AdminPanel.php';
session_start();

$adminPanel = new AdminPanel();

if (isset($_SESSION['success_message'])) {
	echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
	unset($_SESSION['success_message']); // удаляем сообщение из сессии после отображения
}

// Проверяем авторизацию пользователя
if (!isset($_SESSION['user_id'])) {
	$is_user_authorized = false;
} else {
	$is_user_authorized = true;
}

$result = $adminPanel->getEmployees();

?>
<!DOCTYPE html>
<html>

<head>
	<title>Админ-панель</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<style>
		/* Добавляем стили для выдвигающейся таблицы */
		.table-responsive {
			overflow-x: auto;
			white-space: nowrap;
		}

		.table-responsive table {
			width: 100%;
			margin-bottom: 0;
		}

		.table-responsive thead th,
		.table-responsive tbody td {
			white-space: nowrap;
			text-overflow: ellipsis;
			overflow: hidden;
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
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="adminka.php">Админ-панель</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
					aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item active">
							<a class="nav-link" href="admin1/employees.php">Сотрудники</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="admin1/owners.php">Владельцы</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="admin1/properties.php">Недвижимость</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="admin1/reviews1.php">Отзывы</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="admin1/status.php">Статус</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="admin1/users.php">Пользователи</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="index.php">Выход</a>
						</li>

					</ul>
				</div>
			</div>
		</nav>
	</header>

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