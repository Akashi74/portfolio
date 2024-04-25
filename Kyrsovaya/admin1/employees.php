<?php
require_once '..\admin\DBconnect.php';
require_once 'EmployeesFunc.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../../index.php');
    exit();
}

$db = new Database();
$pdo = $db->connect_pdo();

$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;

$employee = new Employee($pdo, $limit, $page);
$result = $employee->getAllEmployees();
$count = $employee->getEmployeesCount();
$pages_count = ceil($count / $limit);

?>
<!DOCTYPE html>
<html>

<head>
  <title>Админ-панель</title>
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
      <h2 class="text-center">Сотрудники</h2>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Position</th>
              <th>Salary</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($result as $employee): ?>
  <tr>
    <td><?php echo $employee['id']; ?></td>
    <td><?php echo $employee['name']; ?></td>
    <td><?php echo $employee['email']; ?></td>
    <td><?php echo $employee['phone']; ?></td>
    <td><?php echo $employee['position']; ?></td>
    <td><?php echo $employee['salary']; ?></td>
    <td>
      <a href="edit.php?table=employees&id=<?php echo $employee['id']; ?>" class="btn btn-primary">Редактировать</a>
      <a href="delete.php?table=employees&id=<?php echo $employee['id']; ?>" class="btn btn-danger"
        onclick="return confirm('Вы уверены что хотите удалить этот столбец?')">Удалить</a>
    </td>
  </tr>
<?php endforeach; ?>

          </tbody>
        </table>

      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <?php for ($i = 1; $i <= $pages_count; $i++): ?>
            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
              <a class="page-link" href="employees.php?page=<?= $i ?>"><?= $i ?></a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>
      <a href="add.php?table=employees" class="btn btn-success">Добавить нового сотрудника</a>

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