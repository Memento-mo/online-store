<?php 
    include("include/db_connect.php");
    include("./functions/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
</head>
<body>
    <header class="header">
        <?php
            include("./include/header.php")
        ?>
    </header>
    <main class="container registration">
        <div class="p-x-1 p-y-3">
            <form class="card card-block m-x-auto bg-faded form-width needs-validation" id="form_reg" method="post" action="/reg/handler_reg.php" novalidate>
                <legend class="m-b-1 text-xs-center mb-1">Регистрация</legend>
                <div class="line mb-3"></div>
                <div class="form-group input-group">
                    <span class="has-float-label mb-3">
                        <input class="form-control custom-form" id="first" type="text" placeholder="Имя"/>
                        <label for="first">Имя</label>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </span>
                    <span class="has-float-label">
                        <input class="form-control custom-form" id="last" type="text" placeholder="Фамилия"/>
                        <label for="last">Фамилия</label>
                    </span>
                    <span class="has-float-label">
                        <input class="form-control custom-form" id="patronymic" type="text" placeholder="Отчество"/>
                        <label for="patronymic">Отчество</label>
                    </span>
                </div>
                <div class="form-group has-float-label">
                    <input class="form-control mb-3 custom-form" id="login" type="text" placeholder="Логин"/>
                    <label for="login">Логин</label>
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon mb-3">@</span>
                    <span class="has-float-label">
                        <input class="form-control mb-3custom-form" id="email" type="email" placeholder="name@example.com"/>
                        <label for="email">E-mail</label>
                    </span>
                </div>
                <div class="form-group has-float-label">
                    <input class="form-control mb-3 custom-form" id="phone" type="phone" placeholder="Мобильный телефон"/>
                    <label for="phone">Мобильный телефон</label>
                </div>
                <div class="form-group has-float-label">
                    <input class="form-control mb-3 custom-form" id="password" type="password" placeholder="••••••••"/>
                    <label for="password">Пароль</label>
                </div>
                <div class="form-group has-float-label ">
                    <input class="form-control mb-3 custom-form" id="address" type="text" placeholder="••••••••"/>
                    <label for="address">Адрес доставки</label>
                </div>
                <div class="form-group has-float-label mb-3">
                    <select class="form-control custom-select" id="country">
                        <option selected>Россия</option>
                        <option>Казахстан</option>
                        <option>Белоруссия</option>
                    </select>
                    <label for="country">Страна</label>
                </div>
                <div class="text-xs-center">
                    <button class="btn btn-block btn-primary btn-size" type="submit">Регистрация</button>
                </div>
            </form>
        </div>
    </main>

    <footer class="footer mt-3">
        <?php
            include("./include/footer.php")
        ?>
    </footer>

    <script src="./js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./js/validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.min.js"></script>
    <script src="./js/jquery-form.js"></script>
</body>
</html>