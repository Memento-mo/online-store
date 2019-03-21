<?php 
    include('./include/db_connect.php');
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Профиль</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
</head>
<body>
    <header class="header">
        <?php
            include("./include/header.php")
        ?>
    </header>
    <main class="container">
        <?php
            if($_SESSION['auth'] == 'yes_auth') {

                include("include/db_connect.php");
                // echo $_SESSION['password'];
                if(isset($_POST["change_info"])) {

                    $current_password = htmlspecialchars($_POST['full_password_info']);
                    $new_password = htmlspecialchars($_POST['full_new_password_info']);
                    $new_full_name = htmlspecialchars($_POST['full_name_info']);
                    $new_username = htmlspecialchars($_POST['username_info']);
                    $new_email = htmlspecialchars($_POST['email_info']);
                    $new_phone = htmlspecialchars($_POST['phone_info']);
                    $new_address = htmlspecialchars($_POST['address_info']);
                    $new_country = htmlspecialchars($_POST['country_info']);

                    $error = array();
                    
                    if($_SESSION['password'] != $current_password) {
                        $error[]='Неверный текущий пароль!';
                    } else {
                        if($_POST["full_new_password_info"] != '') {

                            if(strlen($new_password) < 5 || strlen($new_password) > 15) {
                                $error[]='Введите пароль от 5 до 15 символов!';
                            } else {
                                $_SESSION['password'] = $new_password;
                                $newpassquery = "password='".$new_password."',";
                            }
                        }

                        if(strlen($new_username) < 3 || strlen($new_username) > 15) {
                            $error[]='Введите логин от 3 символов до 15 символов';
                        }

                        if(strlen($new_full_name) < 3 || strlen($new_full_name) > 15) {
                            $error[]='Введите имя от 3 символов до 15 символов';
                        }

                        if(strlen($new_phone) == "") {
                            $error[]="Введите номер телефона";
                        }

                        if(strlen($new_address) == "") {
                            $error[]="Введите адрес доставки";
                        }                       
                    }   

                    if(count($error)) {
                        $_SESSION['msg'] = "<p class='error mt-3'>".implode('<br />', $error)."</p>";
                    } else {
                        $_SESSION['msg'] = "<p class='error mt-3'>Данные успешно сохранены!</p>";

                        $dataquery = $newpassquery."username='".$_POST['username_info']."',full_name='".$_POST["full_name_info"]."',email='".$_POST["email_info"]."',phone='".$_POST["phone_info"]."',address='".$_POST["address_info"]."',country='".$_POST["country_info"]."'";
                        $update = mysql_query("UPDATE reg_users SET $dataquery WHERE username ='{$_SESSION['session_username']}'", $link);
                        
                        if ($new_password) { $_SESSION['password'] = $new_password; };

                        $_SESSION['session_username'] = $_POST["username_info"];
                        $_SESSION['address'] = $_POST["address_info"];
                        $_SESSION['phone'] = $_POST["phone_info"];
                        $_SESSION['email'] = $_POST["email_info"];
                        $_SESSION['country'] = $_POST["country_info"];
                        $_SESSION['full_name'] = $_POST["full_name_info"];
                    }
                    
                }

        ?>
        <div class="p-x-1 p-y-3">
            <div id="reg_message"></div>
            <?php
                echo $_SESSION['msg'];
            ?>
            <form class="card card-block m-x-auto bg-faded form-width" method="POST">
                <legend class="m-b-1 text-xs-center mb-1 mt-1">Изменение профиля</legend>
                <div class="line mb-5"></div>

                <div class="form-group has-float-label">
                    <input class="form-control mb-2 custom-form" id="full_password_info" name="full_password_info" type="password" placeholder="Текущий пароль" value="<?php echo $_SESSION['password'] ?>"/>
                    <label for="full_password_info">Текущий пароль</label>
                </div>
                <div class="form-group has-float-label">
                    <input class="form-control mb-2 custom-form" id="full_new_password_info" name="full_new_password_info" type="password" placeholder="Новый пароль" value=""/>
                    <label for="full_new_password_info">Новый пароль</label>
                </div>

                <div class="form-group has-float-label">
                    <input class="form-control mb-2 custom-form" id="full_name_info" name="full_name_info" type="text" placeholder="Полное имя" value="<?php echo $_SESSION['full_name'] ?>"/>
                    <label for="full_name_info">Полное имя</label>
                </div>

                <div class="form-group has-float-label">
                    <input class="form-control mb-2 custom-form" id="username_info" name="username_info" type="text" placeholder="Логин" value="<?php echo $_SESSION['session_username'] ?>"/>
                    <label for="username_info">Логин</label>
                </div>

                <div class="form-group input-group">
                    <span class="input-group-addon mb-2">@</span>
                    <span class="has-float-label">
                        <input class="form-control mb-2 custom-form" id="email_info" name="email_info" type="email" placeholder="name@example.com" value="<?php echo $_SESSION['email'] ?>"/>
                        <label for="email_info">E-mail</label>
                    </span>
                </div>

                <div class="form-group has-float-label">
                    <input class="form-control mb-2 custom-form" id="phone_info" name="phone_info" type="phone" placeholder="Мобильный телефон" value="<?php echo $_SESSION['phone'] ?>"/>
                    <label for="phone_info">Мобильный телефон</label>
                </div>

                <div class="form-group has-float-label ">
                    <input class="form-control mb-2 custom-form" id="address_info" name="address_info" type="text" placeholder="Адрес доставки" value="<?php echo $_SESSION['address'] ?>"/>
                    <label for="address_info">Адрес доставки</label>
                </div>

                <div class="form-group has-float-label mb2">
                    <select class="form-control custom-select" name="country_info" id="country">
                        <option selected><?php echo $_SESSION['country'] ?></option>
                        <option>Россия</option>
                        <option>Казахстан</option>
                        <option>Белоруссия</option>
                    </select>
                    <label for="country_info">Страна</label>
                </div>
                <div class="text-xs-center d-flex">
                    <button class="btn btn-primary btn-size-info mr-2" type="submit" name="change_info">Сохранить изменения</button>
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

<?php

    } else { header('Location: index.php'); }
?>