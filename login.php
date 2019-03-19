<?php 
    require_once("./include/db_connect.php");
    session_start();

    if(isset($_SESSION["session_username"])) {
    // вывод "Session is set"; // в целях проверки
        header("Location: intropage.php");
    }

    if(isset($_POST["login"])) {

        if(!empty($_POST['username']) && !empty($_POST['password'])) {
            $username=htmlspecialchars($_POST['username']);
            $password=htmlspecialchars($_POST['password']);
            $query =mysql_query("SELECT * FROM reg_users WHERE username='".$username."' AND password='".$password."'");
            $numrows=mysql_num_rows($query);

            if ($_POST['remember'] == 'yes') {
                setcookie('remember', $username.'+'.$password, time()+3600*24*32, '/');
            }

            if($numrows!=0) {
                while($row=mysql_fetch_assoc($query)) {
                    $dbfullnname = $row['full_name'];
                    $dbusername = $row['username'];
                    $dbpassword = $row['password'];
                    $dbaddress = $row['address'];
                    $dbphone = $row['phone'];
                    $dbemail = $row['email'];
                    $dbcountry = $row['country'];
                }
                if ($username == $dbusername && $password == $dbpassword) {
                    // старое место расположения
                    $_SESSION['session_username'] = $username;
                    $_SESSION['full_name'] = $dbfullnname;
                    $_SESSION['auth'] = 'yes_auth';
                    $_SESSION['address'] = $dbaddress;
                    $_SESSION['phone'] = $dbphone;
                    $_SESSION['email'] = $dbemail;
                    $_SESSION['country'] = $dbcountry;
                    $_SESSION['password'] = $dbpassword;
                    /* Перенаправление браузера */
                    header("Location: intropage.php");
                }
            } else {
                //  $message = "Invalid username or password!";    
                echo  "Invalid username or password!";
            }
        } else {
            $message = "All fields are required!";
        }
    }
    
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
        <legend class="m-b-1 text-xs-center mb-1">Вход!</legend>
        <form class="card card-block m-x-auto bg-faded form-width" name="loginform" id="loginform" method="POST" action="">
            <div id="login">
                <div class="form-group has-float-label">
                    <input class="form-control mb-3 custom-form" id="username" name="username" type="text" placeholder="Логин" value=""/>
                    <label for="username">Логин</label>
                </div>

                <div class="form-group has-float-label">
                    <input class="form-control mb-3 custom-form" id="password" name="password" type="password" placeholder="password" value=""/>
                    <label for="password">Пароль</label>
                </div>

                <div class="text-xs-center d-flex">
                    <button class="btn btn-block btn-primary btn-size mr-2" type="submit" name="login" action="">Войти</button>
                    <button class="btn btn-danger btn-size-danger"><a href="./registration.php" class="reg-account">Регистрация</a></button>
                </div>
            </div>
        </form>
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