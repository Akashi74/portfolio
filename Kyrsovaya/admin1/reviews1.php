<?php
require_once '../admin/DBconnect.php';

class Reviews {
    public function getReviews() {
        // Создаем экземпляр класса Database
        $db = new Database();

        // Получаем соединение с базой данных
        $conn = $db->connect_pdo();

        // Запрос на получение отзывов и информации о пользователях из базы данных
        $sql = "SELECT reviews.*, users.name AS client_name FROM reviews JOIN users ON reviews.client_id = users.user_id ORDER BY reviews.id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Получаем отзывы и информацию о пользователях из результата запроса
        $reviews = $stmt->fetchAll();

        // Закрываем соединение с базой данных
        $db->close_connect();

        return $reviews;
    }
}

$reviews = (new Reviews())->getReviews();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Отзывы</title>
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
      <h2 class="text-center">Отзывы</h2>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Client ID</th>
              <th>Client Name</th>
              <th>Property ID</th>
              <th>Rating</th>
              <th>Comment</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($reviews as $review): ?>
              <tr>
                <td><?php echo $review['id']; ?></td>
                <td><?php echo $review['client_id']; ?></td>
                <td><?php echo $review['client_name']; ?></td>
                <td><?php echo $review['property_id']; ?></td>
                <td><?php echo $review['rating']; ?></td>
                <td><?php echo $review['comment']; ?></td>
                <td>
                  <a href="edit.php?table=reviews&id=<?php echo $review['id']; ?>" class="btn btn-primary">Редактировать</a>
                  <a href="delete.php?table=reviews&id=<?php echo $review['id']; ?>" class="btn btn-danger"
                    onclick="return confirm('Вы уверены что хотите удалить этот столбец?')">Удалить</a>
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
