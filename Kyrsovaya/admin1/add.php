<?php
require_once '..\admin\DBconnect.php';
require_once '..\admin\addEmployees.php';


session_start();

// Проверяем авторизацию пользователя
if (!isset($_SESSION['user_id'])) {
  header('Location: ../../index.php');
  exit();
}

$db = new Database();
$pdo = $db->connect_pdo();

$table = isset($_GET['table']) ? $_GET['table'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($table === 'employees') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    addEmployee($name, $email, $phone, $position, $salary);

    $success_message = 'Сотрудник успешно добавлен';
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Добавить</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
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
      <?php if ($success_message): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
      <?php elseif ($table === 'employees'): ?>
        <h2 class="text-center">Добавить нового сотрудника</h2>
        <form action="add.php?table=employees" method="POST">
          <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
          </div>
          <div class="form-group">
            <label for="position">Должность</label>
            <input type="text" class="form-control" id="position" name="position" required>
          </div>
          <div class="form-group">
            <label for="salary">Зарплата</label>
            <input type="number" class="form-control" id="salary" name="salary" required>
          </div>
          <button type="submit" class="btn btn-success">Добавить сотрудника</button>
        </form>
      <?php endif; ?>
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
