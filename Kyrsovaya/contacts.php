<?php
require_once 'admin\DBconnect.php';
require_once 'admin\feedback.php';

session_start();

$db = new Database();
$pdo = $db->connect_pdo();

// Проверяем авторизацию пользователя
if (!isset($_SESSION['user_id'])) {
    $is_user_authorized = false;
} else {
    $is_user_authorized = true;
}

$feedback = new Feedback();
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $feedback->send();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Контакты</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
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
            <h2 class="text-center">Контакты</h2>
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <p>Если у вас есть вопросы или предложения, свяжитесь с нами по телефону или электронной почте:</p>
            <p><strong>Телефон:</strong> +7 (123) 456-78-90</p>
            <p><strong>Email:</strong> <a href="mailto:info@example.com">info@example.com</a></p>
            <p>Мы также будем рады видеть вас в нашем офисе:</p>
            <p><strong>Адрес:</strong> г. Москва, ул. Пушкина, д. 123</p>
            <p>Работаем с понедельника по пятницу с 9:00 до 18:00.</p>
            <form method="post">
                <div class="form-group">
                    <label for="name">Имя:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Телефон:</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="message">Сообщение:</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
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