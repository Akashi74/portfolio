<?php
require_once 'admin/ep.php';

// Создаем экземпляр класса EditProfile
$editProfile = new EditProfile();

// Вызываем функцию edit_profile и получаем результат
$result = $editProfile->edit_profile();

// Извлекаем переменные из результата
$user = $result['user'];
$error_message = $result['error_message'];
$is_user_authorized = $result['is_user_authorized'];

// Выводим форму редактирования профиля
?>



<!DOCTYPE html>
<html>

<head>
    <title>Редактирование профиля</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
  margin-top: auto; /* Добавлено */
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
					</ul>
				</div>
			</div>
		</nav>
	</header>

    <main>
        <section class="container">
            <h2 class="text-center">Редактирование профиля</h2>
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <form action="editprofile.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo $user["email"]; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Старый пароль</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="new_password">Новый пароль</label>
                    <input type="password" class="form-control" id="new_password" name="new_password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Подтверждение пароля</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>
                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="<?php echo $user["phone"]; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
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
</body>
</html>
