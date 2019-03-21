<?php 
    include("include/db_connect.php");
    include("./functions/functions.php");
    session_start();
    include("./include/auth_cookie.php");

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
</head>
<body>
    <header class="header">
        <?php
            include("./include/header.php");
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

                    <div class="products-flex " id="card-deck_tile">
                    <?php

                        $num = 4;
                        $page = (int)$_GET['page'];

                        $count = mysql_query("SELECT COUNT(*) FROM table_products WHERE visible='1'", $link);
                        $temp = mysql_fetch_array($count);

                        if ($temp[0] > 0) {
                            $tempcount = $temp[0];

                            $total = (($tempcount - 1) / $num) + 1;
                            $total = intval($total);

                            $page = intval($page);

                            if(empty($page) || $page < 0) $page = 1;

                            if($page > $total) $page = $total;

                            $start = $page * $num - $num;

                            $query_start_num = " LIMIT $start, $num";
                        }

                        $result = mysql_query("SELECT * FROM table_products WHERE visible='1' ORDER BY $sorting $query_start_num", $link);

                        if(mysql_num_rows($result) > 0) {
                            $row = mysql_fetch_array($result);

                            do {
                                echo '
                                    <div class="mb-3 mt-3">    
                                        <div class="card card_hover" style="width: 18rem;">
                                            <img class="card-img-top card_size" src="./img/products/'.$row["type_of_products"].'/'.$row["image"].'" alt="Card image cap">
                                            <div class="card-body">
                                                <a class="card-title-link" href="view-content.php?id='.$row["products_id"].'"><h5 class="card-title">'.$row["title"].'</h5></a>
                                                <p class="card-text">'.$row["mini_description"].'</p>
                                                <div class="product-price">
                                                    <div class="product-price__count">'.group_numerals($row["price"]).' руб.</div>
                                                    <button class="btn btn-primary button-user-tile" tid="'.$row["products_id"].'">В корзину</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';

                            } while ($row = mysql_fetch_array($result));
                        };

                        if ($page != 1) $pstr_prev = '<li class="page-item"><a class="page-link" href="index.php?page='.($page - 1).'">Previous</a></li>';
                        if ($page != $total) $pstr_next = '<li class="page-item"><a class="page-link" href="index.php?page='.($page + 1).'">Next</a></li>';

                        // Формируем ссылки со страницами
                        if ($page - 5 > 0) $page5left = '<li class="page-item"><a class="page-link" href="index.php?page='.($page - 5).'">'.($page - 5).'</a></li>';
                        if ($page - 5 > 0) $page4left = '<li class="page-item"><a class="page-link" href="index.php?page='.($page - 4).'">'.($page - 4).'</a></li>';
                        if ($page - 5 > 0) $page3left = '<li class="page-item"><a class="page-link" href="index.php?page='.($page - 3).'">'.($page - 3).'</a></li>';
                        if ($page - 5 > 0) $page2left = '<li class="page-item"><a class="page-link" href="index.php?page='.($page - 2).'">'.($page - 2).'</a></li>';
                        if ($page - 5 > 0) $page1left = '<li class="page-item"><a class="page-link" href="index.php?page='.($page - 1).'">'.($page - 1).'</a></li>';

                        if ($page + 5 <= $total) $page5right = '<li class="page-item"><a class="page-link" href="index.php?page='.($page + 5).'">'.($page + 5).'</a></li>';
                        if ($page + 5 <= $total) $page4right = '<li class="page-item"><a class="page-link" href="index.php?page='.($page + 4).'">'.($page + 4).'</a></li>';
                        if ($page + 5 <= $total) $page3right = '<li class="page-item"><a class="page-link" href="index.php?page='.($page + 3).'">'.($page + 3).'</a></li>';
                        if ($page + 5 <= $total) $page2right = '<li class="page-item"><a class="page-link" href="index.php?page='.($page + 2).'">'.($page + 2).'</a></li>';
                        if ($page + 5 <= $total) $page1right = '<li class="page-item"><a class="page-link" href="index.php?page='.($page + 1).'">'.($page + 1).'</a></li>';
                        

                        if ($page + 1 < $total) {
                            $strtotal = '<li class="page-item"><p class="nav-point page-link">...</p></li><li class="page-item"><a class="page-link" href="index.php?page='.$total.'">'.$total.'</a></li>';
                        } else {
                            $strtotal = '';
                        }

                        if ($total > 1) {
                            echo '
                                <nav class="mt-5">
                                    <ul class="pagination">
                                    ';
                            echo        $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li class='page-item'><a class='pstr-active page-link' href='index.php?type='.$type.'page=".$page."'>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
                            echo '
                                    </ul>
                                </nav>
                                ';
                            
                        }
                    ?>
                    </div>
                    
                    <div class="products-flex-list" id="card-deck_list">
                    <?php
                        $result = mysql_query("SELECT * FROM table_products WHERE visible='1' ORDER BY $sorting $query_start_num", $link);

                        if(mysql_num_rows($result) > 0) {
                            $row = mysql_fetch_array($result);

                            do {
                                echo '
                                    <div class="mb-3 mt-3">    
                                        <div class="card-user card_hover card-size">
                                            <img class="card-img-top card-img-top-user" src="./img/products/'.$row["type_of_products"].'/'.$row["image"].'" alt="Card image cap">
                                            <div class="card-body-user">
                                                <a class="card-title-link" href="view-content.php?id='.$row["products_id"].'"><h5 class="card-title">'.$row["title"].'</h5></a>
                                                <p class="card-text">'.$row["mini_description"].'</p>
                                                <div class="product-price-user">
                                                    <div class="product-price__count">'.group_numerals($row["price"]).' руб.</div>
                                                    <button class="btn btn-primary button-user button-user-list" tid="'.$row["products_id"].'">В корзину</button>
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
        <section class="filter-params">
            <?php 
                include("./include/filter.php")
            ?>
        </section>        
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