<?php 
    include("include/db_connect.php");

    $sorting = $_GET["sort"];

    switch ($sorting) {
        case "price-asc";
            $sorting = "price ASC";
            $sort_name = "По возрастанию цены";
            break;
        case "price-desc";
            $sorting = "price DESC";
            $sort_name = "По убыванию цены";
            break;
        default:
            $sorting = "products_id DESC";
            $sort_name = "Нет сортировки";
            break;
    }
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

                    <div class="products-view d-flex">
                        <div class="products-view__title">Вид:</div>
                        <img src="./img/icons/tile-black.svg" alt="tile" class="products-view__icon" id="tile-icon">
                        <img src="./img/icons/list.svg" alt="tile" class="products-view__icon" id="list-icon">
                        <div class="sorts d-flex">
                            <a class="sorts-item" href="index.php?sort=price-desc">По убыванию цены</a>
                            <a class="sorts-item" href="index.php?sort=price-asc">По возрастанию цены</a>
                        </div>
                    </div>
                    

                    <div class="line line_indents"></div>

                    <div class="products-flex" id="card-deck_tile">
                    <?php
                        $result = mysql_query("SELECT * FROM table_products WHERE visible='1' ORDER BY $sorting", $link);

                        if(mysql_num_rows($result) > 0) {
                            $row = mysql_fetch_array($result);

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
                        };
                    ?>
                    </div>
                    
                    <div class="products-flex-list" id="card-deck_list">
                    <?php
                        $result = mysql_query("SELECT * FROM table_products WHERE visible='1' ORDER BY $sorting", $link);

                        if(mysql_num_rows($result) > 0) {
                            $row = mysql_fetch_array($result);

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
</body>
</html>