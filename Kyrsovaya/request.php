<?php
require_once 'DBconnect.php';
session_start();
// Проверяем авторизацию пользователя
if (!isset($_SESSION['user_id'])) {
    $is_user_authorized = false;
} else {
    $is_user_authorized = true;
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заявка на недвижимость</title>
    <!-- Подключите Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl7/1L_dstPt3HV5HzF6Gvk/e3s4Wz6iJgD/+ub2oU" crossorigin="anonymous">
    <!-- Ваш CSS (необязательно) -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            max-width: 100%;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h1 {
            color: #333;
        }

        label {
            font-weight: 600;
        }

        input,
        select,
        textarea {
            border-radius: 0;
            border: 1px solid #ccc;
            padding: 15px;
            font-size: 14px;
            box-shadow: none;
            transition: border-color 0.3s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #007bff;
            box-shadow: none;
        }

        button[type="submit"] {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 2px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .application-form {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 600px;
        }

        .form-control {
            width: 100%;
        }

        .row .col {
            padding-left: 0;
            padding-right: 0;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="application-form">
            <h1 class="text-center mb-4">Заявка на недвижимость</h1>
            <form>
                <div class="row">
                    <div class="col">
                        <label for="firstName" class="form-label">Имя</label>
                        <input type="text" class="form-control" id="firstName" required>
                    </div>
                    <div class="col">
                        <label for="lastName" class="form-label">Фамилия</label>
                        <input type="text" class="form-control" id="lastName" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Электронная почта</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Телефон</label>
                    <input type="tel" class="form-control" id="phone" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Сообщение</label>
                    <textarea class="form-control" id="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Отправить заявку</button>
            </form>
        </div>
    </div>

    <!-- Подключите Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gybBud7TlRbs/ic4AwGcFZOxg5DpPt8EgeUIgIwzjWfXQKWA3" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
        integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous">
        </script>
    <!-- Ваш JavaScript (необязательно) -->
    <script>
        // Добавьте свой JavaScript, если необходимо
    </script>
</body>

</html>