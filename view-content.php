<?php 
    include("include/db_connect.php");
    include("./functions/functions.php");
    session_start();
    include("./include/auth_cookie.php");

    $id = clear_string($_GET["id"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
</head>
<body>
    <header class="header">
        <?php
            include("./include/header.php");
        ?>
    </header>
    <main class="container">
        <?php
            $result1 = mysql_query("SELECT * FROM table_products WHERE products_id='$id' AND visible='1'", $link);

            if(mysql_num_rows($result) > 0) {
                $row1 = mysql_fetch_array($result1);

                do {

                    echo '
                    <div class="view-info mt-3 mb-5"><a href="view_cat.php?type='.$row1["type_of_products"].'">'.$row1["type_of_products"].'</a> \ '.$row1["brand"].'</div>

                    <div class="mb-3 mt-3">    
                        <div class="card-user cart-view-content_size">
                            <img class="card-img-top card-img-top-user" src="./img/products/'.$row1["type_of_products"].'/'.$row1["image"].'" alt="Card image cap">
                            <div class="card-body-user">
                                <div class="card-body-user__text">
                                    <h5 class="card__view_title">'.$row1["title"].'</h5>
                                    <div class="view-price__count mt-3">'.$row1["price"].' руб.</div>
                                    <button class="btn btn-dark mt-2 button-user-tile" tid="'.$row1["products_id"].'">Купить</button>
                                    <p class="card__view_count mt-1">Количество на складе: '.$row1["count"].'</p>
                                </div>
                                <p class="cart-text__view_size mt-4">'.$row1["mini_description"].' Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae nemo impedit aut pariatur aspernatur qui mollitia soluta unde voluptatem esse.</p>
                            </div>
                        </div>
                    </div>
                    ';
                  
                } while ($row = mysql_fetch_array($result1));

                echo '
                    <nav class="pageNav">
                        <div class="pageNav__tabList">
                            <div class="pageNav__tabItem pageNav__tabItem--active">Описание</div>
                            <div class="pageNav__tabItem">Характеристики</div>
                        </div>
                        
                        <div class="pageNav__contentList">
                            <div class="pageNav__contentItem pageNav__contentItem--active">'.$row1["description"].'</div>
                            <div class="pageNav__contentItem">'.$row1["features"].'</div>
                    </div>
                </nav>
                ';
            }
        ?>
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
    <script src="./js/tabs.js"></script>

</body>
</html>