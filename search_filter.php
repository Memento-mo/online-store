<?php 
    include("include/db_connect.php");
    include("./functions/functions.php");
    session_start();
    include("./include/auth_cookie.php");
    
    $cat = clear_string($_GET["cat"]);
    $type = clear_string($_GET["type"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Поиск по параметрам</title>
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
    <main>
        <section class="products">
            <div class="card-deck mt-3">
                <div class="container">
                    <div class="products-flex" id="card-deck_tile">
                    <?php

                        if ($_GET["brand"]) {
                            $check_brand = implode(',', $_GET["brand"]);
                        };

                        if(!empty($check_brand)) {
                            $query_brand = " AND brand_id IN($check_brand)";
                        };

                        $result = mysql_query("SELECT * FROM table_products WHERE visible='1' $query_brand ORDER BY products_id DESC", $link);
                        
                        if(mysql_num_rows($result) > 0) {
                            $row = mysql_fetch_array($result);

                                echo '<div class="products-view d-flex">
                                        <div class="products-view__title">Вид:</div>
                                        <img src="./img/icons/tile-black.svg" alt="tile" class="products-view__icon" id="tile-icon">
                                        <img src="./img/icons/list.svg" alt="tile" class="products-view__icon" id="list-icon">
                                        <div class="sorts d-flex">
                                            <a class="sorts-item" href="view_cat.php?cat='.$cat.'&type='.$type.'&sort=price-desc">По убыванию цены</a>
                                            <a class="sorts-item" href="view_cat.php?cat='.$cat.'&type='.$type.'&sort=price-asc">По возрастанию цены</a>
                                        </div>
                                    </div>
                                    <div class="line line_indents"></div>';

                            do {
                                echo '
                                    <div class="mb-3 mt-3">    
                                        <div class="card card_hover" style="width: 18rem;">
                                            <img class="card-img-top card_size" src="./img/products/'.$row["type_of_products"].'/'.$row["image"].'" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title">'.$row["title"].'</h5>
                                                <p class="card-text">'.$row["mini_description"].'</p>
                                                <div class="product-price">
                                                    <div class="product-price__count">'.$row["price"].' руб.</div>
                                                    <a href="#" class="btn btn-primary">В корзину</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';

                            } while ($row = mysql_fetch_array($result));
                        } else {
                            echo '<div>Выберите категорию</div>';
                        };
                    ?>
                    </div>
                    
                    <div class="products-flex-list" id="card-deck_list">
                    <?php
                        $result = mysql_query("SELECT * FROM table_products WHERE visible='1' $query_brand ORDER BY products_id DESC", $link);

                        if(mysql_num_rows($result) > 0) {
                            $row = mysql_fetch_array($result);
                                echo '  <div class="products-view d-flex">
                                            <div class="products-view__title">Вид:</div>
                                            <img src="./img/icons/tile-black.svg" alt="tile" class="products-view__icon" id="tile-icon-second">
                                            <img src="./img/icons/list.svg" alt="tile" class="products-view__icon" id="list-icon-second">
                                            <div class="sorts d-flex">
                                                <a class="sorts-item" href="view_cat.php?cat='.$cat.'&type='.$type.'&sort=price-desc">По убыванию цены</a>
                                                <a class="sorts-item" href="view_cat.php?cat='.$cat.'&type='.$type.'&sort=price-asc">По возрастанию цены</a>
                                            </div>
                                        </div>
                                        <div class="line line_indents"></div>';
                            do {
                                echo '
                                    <div class="mb-3 mt-3">    
                                        <div class="card-user card_hover" style="width: 44rem; height: 209px">
                                            <img class="card-img-top card-img-top-user" src="./img/products/'.$row["type_of_products"].'/'.$row["image"].'" alt="Card image cap">
                                            <div class="card-body-user">
                                                <h5 class="card-title">'.$row["title"].'</h5>
                                                <p class="card-text">'.$row["mini_description"].'</p>
                                                <div class="product-price-user">
                                                    <div class="product-price__count">'.$row["price"].' руб.</div>
                                                    <a href="#" class="btn btn-primary button-user">В корзину</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                ';

                            } while ($row = mysql_fetch_array($result));
                        };
                    ?>
                    </div>    
                </div>
            </div>
            
        </section>        
    </main>

    <section class="filter-params">
        <?php 
            include("./include/filter.php")
        ?>
    </section>

    <footer class="footer mt-3">
        <?php
            include("./include/footer.php")
        ?>
    </footer>

    <script src="./js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>