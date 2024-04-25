<?php
session_start();
require_once 'OwnerFunc.php';

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

$owner = new Owner();
$result = $owner->getAllOwners();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Админ-панель - Владельцы</title>
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
    </style>
</head>

<body>
<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="../adminka.php">Админ-панель</a>
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
							<a class="nav-link" href="reviews1.php">Отзывы</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="status.php">Статус</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="users.php">Пользователи</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../index.php">Выход</a>
						</li>

					</ul>
				</div>
			</div>
		</nav>
	</header>

<main>
    <section class="container">
        <h2 class="text-center">Владельцы</h2>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($result as $owner): ?>
                    <tr>
                        <td><?php echo $owner['id']; ?></td>
                        <td><?php echo $owner['name']; ?></td>
                        <td><?php echo $owner['email']; ?></td>
                        <td><?php echo $owner['phone']; ?></td>
                        <td><?php echo $owner['address']; ?></td>
                        <td>
                            <a href="edit.php?table=owners&id=<?php echo $owner['id']; ?>" class="btn btn-primary">Редактировать</a>
                            <a href="delete.php?table=owners&id=<?php echo $owner['id']; ?>" class="btn btn-danger"
                               onclick="return confirm('Вы уверены что хотите удалить этого владельца?')">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
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
