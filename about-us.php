<?php 
    require_once("./include/db_connect.php");
    session_start();
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>О нас</title>
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
    <main class="container">
        <p class="mt-5">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cupiditate perferendis illum debitis non vitae laudantium exercitationem soluta iusto voluptate vero autem tempora aut numquam itaque doloribus, eligendi ipsam unde omnis magni. Magni fuga dolorem reiciendis voluptatum, dicta deleniti tempora praesentium, quas itaque hic non laborum. Omnis, ab! Veniam quos sequi labore illum, delectus, nostrum voluptates iusto expedita deserunt quo enim ex commodi corporis ab aliquid, repudiandae a ut praesentium rem sit aliquam omnis. Saepe exercitationem accusamus aliquid aperiam, assumenda nostrum consequatur perspiciatis. Error corrupti consequuntur, sunt architecto dolor dolore ut placeat provident nesciunt voluptate perferendis veritatis, amet laudantium non facilis.</p>
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