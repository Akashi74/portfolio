<?php
require_once '..\admin\DBconnect.php';
session_start();
$db = new Database();
$pdo = $db->connect_pdo();

require_once 'EditFunction.php';
$editRecord = new EditRecord($pdo);

// Определяем, какую таблицу редактировать
$table = $_GET['table'];
// Определяем id записи для редактирования
$id = $_GET['id'];

// Определяем поля таблицы
if (!isset($_GET['table'])) {
    die('Имя таблицы не передано');
}

switch ($table) {
    case 'employees':
        $fields = ['name', 'email', 'phone', 'position', 'salary'];
        $primaryKey = 'id';
        break;
    case 'owners':
        $fields = ['name', 'email', 'phone', 'address'];
        $primaryKey = 'id';
        break;
    case 'properties':
        $fields = ['owner_id','title','description', 'price', 'area', 'rooms', 'address', 'image'];
        $primaryKey = 'id';
        break;
    case 'reviews':
        $fields = ['client_id', 'property_id', 'rating', 'comment'];
        $primaryKey = 'id';
        break;
    case 'requests':
        $fields = ['client_id', 'property_id', 'status_id', 'request_status_id', 'date', 'comment'];
        $primaryKey = 'id';
        break;
    default:
        die('Неверная таблица');
}
// Получаем данные записи из базы данных
$record = $editRecord->getRecord($table, $fields, $primaryKey, $id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Получаем данные из формы
    $data = [];
    foreach ($fields as $field) {
        if ($field == 'image') {
            // Обработка загрузки файла
            if ($table == 'properties' && isset($_FILES['image'])) {
                $uploadDir = '../img/';
                $uploadFile = $uploadDir . basename($_FILES['image']['name']);

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $data['image'] = basename($_FILES['image']['name']);
                } else {
                    echo "Ошибка при загрузке файла.";
                }
            }
        } else {
            $data[$field] = $_POST[$field];
        }
    }

    // Удаляем пустые значения из массива $data
    foreach ($data as $field => $value) {
        if ($value === '') {
            unset($data[$field]);
        }
    }

    // Обновляем данные записи в базе данных
    $editRecord->updateRecord($table, $fields, $primaryKey, $data, $id);

    // Перенаправляем пользователя на страницу со списком записей
    header('Location: ../adminka.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Редактирование записи</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
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
<body>
    <h1>Редактирование записи</h1>
    <form method="post" enctype="multipart/form-data">
        <?php foreach ($fields as $field): ?>
            <?php if ($field == 'image' && $table == 'properties'): ?>
                <div class="form-group">
                    <label for="image">Изображение:</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    <?php if (isset($record['image']) && file_exists('../img/' . $record['image'])): ?>
                        <p>Текущее изображение: <img src="<?php echo 'img/' . $record['image']; ?>" alt="Текущее изображение" width="100"></p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="form-group">
                    <label for="<?php echo $field; ?>"><?php echo ucfirst($field); ?>:</label>
                    <input type="text" class="form-control" id="<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $record[$field]; ?>">
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
    </form>
</body>

</html>
