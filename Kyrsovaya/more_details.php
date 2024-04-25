<?php
session_start();
require_once 'admin/detail.php';

$detail = new Detail();

if (isset($_GET['id'])) {
    $property_id = $_GET['id'];
} elseif (isset($_POST['property_id'])) {
    $property_id = $_POST['property_id'];
} else {
    echo "Отсутствует обязательный параметр property_id";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user_id'])) {
        $client_id = $_SESSION['user_id'];
    } else {
        echo "Пользователь не авторизован";
        exit;
    }
    $status_id = 1;
    $request_status_id = 1;
    $date = date('Y-m-d H:i:s');
    $comment = $_POST['requestMessage'];

    $detail->addRequest($client_id, $property_id, $status_id, $request_status_id, $date, $comment);
}

$property = $detail->getPropertyDetails($property_id);
$images = $detail->getPropertyImages($property_id);
$is_user_authorized = $detail->isUserAuthorized();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Подробная информация о недвижимости</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<style>
    .owl-stage-outer {
        width: 710px;
        margin-left: 10px;
    }

    .owl-carousel .owl-item img {
        width: 100%;
        height: 120px;
        object-fit: cover;
    }

    .property-image {
        max-width: 100%;
        margin-right: 1rem;
        padding: 10px;
    }

    .col-md-4 {
        margin-top: 10px;
    }

    .owl-nav {
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
    }

    .owl-prev,
    .owl-next {
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .owl-prev:hover,
    .owl-next:hover {
        background-color: #555;
    }

    .owl-prev {
        left: -50px;
    }

    .owl-next {
        right: -50px;
    }

    .owl-prev span,
    .owl-next span {
        font-size: 20px;
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

    <!-- Модальное окно заявки -->
    <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModalLabel"
        aria-hidden="true">
        <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestModalLabel">Заявка на недвижимость</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="more_details.php">
                        <input type="hidden" name="property_id" value="<?php echo $property_id; ?>">
                        <div class="form-group">
                            <label for="requestName">Имя</label>
                            <input type="text" class="form-control" id="requestName" name="requestName" required>
                        </div>
                        <div class="form-group">
                            <label for="requestEmail">Email</label>
                            <input type="email" class="form-control" id="requestEmail" name="requestEmail" required>
                        </div>
                        <div class="form-group">
                            <label for="requestPhone">Телефон</label>
                            <input type="tel" class="form-control" id="requestPhone" name="requestPhone" required>
                        </div>
                        <div class="form-group">
                            <label for="requestMessage">Сообщение</label>
                            <textarea class="form-control" id="requestMessage" name="requestMessage" rows="3"
                                required></textarea>
                        </div>
                        <button type="submit">Отправить заявку</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <main>
        <section class="container">
            <h2 class="text-center">
                <?php echo $property["title"]; ?>
            </h2>
            <div class="row">
                <div class="col-md-8">
                    <img src="<?php echo $property["image"]; ?>" class="img-fluid property-image" alt="">
                    <div class="owl-carousel owl-theme">
                        <?php
                        while ($image = $images->fetch()) {
                            echo '<div class="item"><img src="' . $image["address"] . '" alt=""></div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <p><strong>Цена:</strong>
                        <?php echo $property["price"]; ?> руб.
                    </p>
                    <p><strong>Площадь:</strong>
                        <?php echo $property["area"]; ?> м<sup>2</sup>
                    </p>
                    <p><strong>Количество комнат:</strong>
                        <?php echo $property["rooms"]; ?>
                    </p>
                    <p><strong>Описание:</strong></p>
                    <p>
                        <?php echo $property["description"]; ?>
                    </p>

                    <?php if ($is_user_authorized): ?>
                        <p><button type="button" class="btn btn-primary mt-3" data-toggle="modal"
                                data-target="#requestModal">Подать заявку</button></p>
                    <?php else: ?>
                        <p><a href="login.php"><button type="button" class="btn btn-primary mt-3">Авторизоваться, чтобы
                                    подать заявку</button></a></p>
                    <?php endif; ?>

                    <p><a href="index.php#property-<?php echo $property["id"]; ?>"
                            class="btn btn-secondary mt-3">Вернуться назад</a></p>

                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="container">
            <p>&copy; 2024 Недвижимость</p>
        </div>
    </footer>
    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1920: {
                        items: 5
                    }
                }
            });
        });
    </script>
</body>

</html>