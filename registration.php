<?php 
    require_once("./include/db_connect.php");
    include("./functions/functions.php");
    session_start();
    include("./include/auth_cookie.php");
    
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
        <?php
        
        if(isset($_POST["register"])){
        
            if(!empty($_POST['full_name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['phone']) && !empty($_POST['address']) && !empty($_POST['country'])) {
                $full_name = htmlspecialchars($_POST['full_name']);
                $email = htmlspecialchars($_POST['email']);
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $address = htmlspecialchars($_POST['address']);
                $phone = htmlspecialchars($_POST['phone']);
                $country = htmlspecialchars($_POST['country']);
                $query = mysql_query("SELECT * FROM reg_users WHERE username='".$username."'");
                $numrows = mysql_num_rows($query);

                if($numrows == 0) {

                    $sql="INSERT INTO reg_users
                        (full_name, email, username, password, address, phone, country)
                        VALUES('$full_name','$email', '$username', '$password', '$address', '$phone', '$country')";

                    $result=mysql_query($sql);

                        if($result) {
                            $message = "Аккаунт успешно создан!";
                        } else {
                            $message = "Не удалось проверить данные!";
                        }
                    
                } else {
                    $message = "Это имя уже используется, попробуйте другое.";
                }
            } else {
                    $message = "Необходимо заполнить все поля";
            }
        }

        if (!empty($message)) {
                echo "<p class='error'>$message</p>";
            };
        ?>

        <div class="p-x-1 p-y-3">
            <div id="reg_message"></div>
            <form class="card card-block m-x-auto bg-faded form-width" name="form_reg" id="form_reg" method="POST" action="./registration.php">
                <legend class="m-b-1 text-xs-center mb-1">Регистрация</legend>
                <div class="line mb-5"></div>

                <div class="form-group has-float-label">
                    <input class="form-control mb-2 custom-form" id="full_name" name="full_name" type="text" placeholder="Полное имя" value=""/>
                    <label for="full_name">Полное имя</label>
                </div>

                <div class="form-group has-float-label">
                    <input class="form-control mb-2 custom-form" id="username" name="username" type="text" placeholder="Логин" value=""/>
                    <label for="username">Логин</label>
                </div>
                <div class="form-group input-group">
                    <span class="input-group-addon mb-2">@</span>
                    <span class="has-float-label">
                        <input class="form-control mb-2 custom-form" id="email" name="email" type="email" placeholder="name@example.com" value=""/>
                        <label for="email">E-mail</label>
                    </span>
                </div>
                <div class="form-group has-float-label">
                    <input class="form-control mb-2 custom-form" id="phone" name="phone" type="phone" placeholder="Мобильный телефон" value=""/>
                    <label for="phone">Мобильный телефон</label>
                </div>
                <div class="form-group has-float-label">
                    <input class="form-control mb-2 custom-form" id="password" name="password" type="password" placeholder="••••••••" value=""/>
                    <label for="password">Пароль</label>
                </div>
                <div class="form-group has-float-label ">
                    <input class="form-control mb-2 custom-form" id="address" name="address" type="text" placeholder="Адрес доставки" value=""/>
                    <label for="address">Адрес доставки</label>
                </div>
                <div class="form-group has-float-label mb-2">
                    <select class="form-control custom-select" name="country" id="country">
                        <option selected>Россия</option>
                        <option>Казахстан</option>
                        <option>Белоруссия</option>
                    </select>
                    <label for="country">Страна</label>
                </div>
                <div class="text-xs-center d-flex">
                    <button class="btn btn-block btn-primary btn-size mr-2" type="submit" name="register">Регистрация</button>
                    <button class="btn btn-danger btn-size-danger"><a href="./login.php" class="reg-account">Уже есть аккаунт? Войти!</a></button>
                </div>
            </form>
        </div>
    </main>

    <footer class="footer mt-3">
        <?php
            include("./include/footer.php")
        ?>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>