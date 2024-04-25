<?php
require_once 'admin/cat.php';
session_start();

$catalog = new Catalog();

$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'price';
$sort_order = isset($_GET['sort_price']) ? $_GET['sort_price'] : 'ASC';
$min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 50000;
$max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 150000;

$stmt = $catalog->getCatalog($min_price, $max_price, $sort_by, $sort_order);

if (!isset($_SESSION['user_id'])) {
    $is_user_authorized = false;
} else {
    $is_user_authorized = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Каталог недвижимости</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
    <style>
    		footer {
			background-color: #f8f9fa;
			padding: 15px 0;
			text-align: center;
			font-size: 14px;
		}
    </style>
</head>
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
					</ul>
				</div>
			</div>
		</nav>
	</header>

    <div class="container mt-5">
        <h1 class="text-center mb-5">Каталог недвижимости</h1>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <form method="GET" action="">
                    <div class="form-group">
                        <label for="sort_by">Сортировать по:</label>
                        <select name="sort_by" id="sort_by" class="form-control">
                            <option value="price" <?php if($sort_by == 'price') echo 'selected'; ?>>Цене</option>
                            <option value="area" <?php if($sort_by == 'area') echo 'selected'; ?>>Площади</option>
                            <option value="rooms" <?php if($sort_by == 'rooms') echo 'selected'; ?>>Количеству комнат</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sort_price">Порядок сортировки:</label>
                        <select name="sort_price" id="sort_price" class="form-control">
                            <option value="ASC" <?php if($sort_order == 'ASC') echo 'selected'; ?>>По возрастанию</option>
                            <option value="DESC" <?php if($sort_order == 'DESC') echo 'selected'; ?>>По убыванию</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="min_price">Цена от:</label>
                        <input type="number" name="min_price" id="min_price" class="form-control" value="<?php echo $min_price; ?>" min="50000" max="150000">
                    </div>
                    <div class="form-group">
                        <label for="max_price">Цена до:</label>
                        <input type="number" name="max_price" id="max_price" class="form-control" value="<?php echo $max_price; ?>" min="50000" max="150000">
                    </div>
                    <button type="submit" class="btn btn-primary">Применить</button>
                </form>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <?php
                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch()) {
                            echo '
                                <div class="col-md-8 mb-4">
                                    <div class="card">
                                        <img src="' . $row["image"] . '" class="card-img-top" alt="...">
                                        <div class="card-body p-3">
                                            <h5 class="card-title">' . $row["title"] . '</h5>
                                            <p class="card-text">' . $row["description"] . '</p>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    Цена
                                                    <span class="badge badge-primary badge-pill">' . $row["price"] . '</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    Количество комнат
                                                    <span class="badge badge-primary badge-pill">' . $row["rooms"] . '</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    Площадь
                                                    <span class="badge badge-primary badge-pill">' . $row["area"] . ' м²</span>
                                                </li>
                                                <li class="list-group-item">
                                                    Адрес: ' . $row["address"] . '
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                ';
                        }
                    } else {
                        echo "Нет доступных квартир";
                    }
                    ?>
                </div>
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
