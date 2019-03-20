<?php 
    include("include/db_connect.php");
    include("./functions/functions.php");
    session_start();
    include("./include/auth_cookie.php");

    $id = clear_string($_GET["id"]);
    $action = clear_string($_GET["action"]);

    switch ($action) {
        case 'clear':
            $clear = mysql_query("DELETE FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}'", $link);
            break;

        case 'delete':
            $delete = mysql_query("DELETE FROM cart WHERE cart_id = '$id' AND cart_ip = '{$_SERVER['REMOTE_ADDR']}'", $link);
            break;
    }

    if (isset($_POST["next_submit"])) {
        $_SESSION["order_delivery"] = $_POST["order_delivery"];
        $_SESSION["order_full_name"] = $_POST["order_full_name"];
        $_SESSION["order_email"] = $_POST["order_email"];
        $_SESSION["order_phone"] = $_POST["order_phone"];
        $_SESSION["order_address"] = $_POST["order_address"];
        $_SESSION["order_note"] = $_POST["order_note"];
        $_SESSION["order_country"] = $_POST["order_country"];

        header("Location: cart.php?action=completion");
    }

    $result = mysql_query("SELECT * FROM cart, table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_products", $link);

    if (mysql_num_rows($result) > 0) {
        $row = mysql_fetch_array($result);

        do {
            $int = $row["cart_price"] * $row["cart_count"];
        } while ($row = mysql_fetch_array($result));

        $total_price = $total_price + $int;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Корзина заказов</title>
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
            $action = clear_string($_GET["action"]);

            switch($action) {
                case 'oneclick':
                    echo '
                        <div class="cart-container mt-3">
                            <div class="d-flex cart-info">
                                <div class="cart-info__item d-flex">
                                    <div class="cart-info__item-title mr-1 ">
                                        <a href="cart.php?action=oneclick" class="cart-active">1. Корзина товаров</div></a>
                                    <div class="cart-info__item-arrow">
                                        <img src="../img/icons/right-arrow.svg" alt="arrow">  
                                    </div>
                                </div>
                                <div class="cart-info__item d-flex">
                                    <div class="cart-info__item-title mr-1">
                                        <a href="cart.php?action=confirm">2. Контактная информация</div></a>
                                    <div class="cart-info__item-arrow">
                                        <img src="../img/icons/right-arrow.svg" alt="arrow">  
                                    </div>
                                </div>
                                <div class="cart-info__item d-flex">
                                    <div class="cart-info__item-title mr-1">
                                        <a href="cart.php?action=completion">3. Завершение</div></a>
                                </div>
                            </div>

                            <div class="cart-steps d-flex justify-content-between align-items-center mt-4">
                                <div class="cart-steps__step">Шаг 1 из 3</div>
                                <a href="cart.php?action=clear"><button class="btn btn-danger">Очистить</button></a>
                            </div>
                            <div class="line mt-2 mb-2"></div>
                        </div>
                    ';

                        $result = mysql_query("SELECT * FROM cart, table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_products", $link);

                        if (mysql_num_rows($result) > 0) {
                            $row = mysql_fetch_array($result);

                            echo '
                            <div class="cart-cap cart-container mt-2">
                                <div class="cart-cap__titles d-flex justify-content-around">
                                    <div class="cart-cap__titles-title">
                                        Изображение
                                    </div>
                                    <div class="cart-cap__titles-title">
                                        Наименование товара
                                    </div>
                                    <div class="cart-cap__titles-title">
                                        Кол-во
                                    </div>
                                    <div class="cart-cap__titles-title">
                                        Цена
                                    </div>
                                </div>
                                <div class="line mt-2"></div>
                            ';

                            do {

                                $int = $row["cart_price"] * $row["cart_count"];
                                $all_price = $all_price + $int;
                                echo '

                                <div class="mb-3 mt-3">    
                                    <div class="card-user card_hover cart-size">
                                        <img class="card-img-top card-img-top-user" src="./img/products/'.$row["type_of_products"].'/'.$row["image"].'" alt="Card image cap">
                                        <div class="card-body-user d-flex align-items-center">
                                            <div class="card-body-user__text">
                                                <h5 class="card-title">'.$row["title"].'</h5>
                                                <p class="card-text cart-text_size">'.$row["mini_description"].'</p>
                                            </div>
                                            <div class="card-count card-count_indents">
                                                <div class="card-count__minus" count="'.$row["cart_id"].'">-</div>
                                                <div class="card-count__input">
                                                    <input id="input-id'.$row["cart_id"].'" class="count-input" count="'.$row["cart_id"].'" maxlength="3" type="text" value="'.$row["cart_count"].'"/>
                                                </div>
                                                <div class="card-count__plus" count="'.$row["cart_id"].'">+</div>
                                            </div>
                                            <div id="product'.$row["cart_id"].'" class="product-price__count product-price__count_indents" price="'.$row["cart_price"].'">'.$int.' руб.</div>
                                        </div>
                                        <div class="cart-delete">
                                            <a href="cart.php?id='.$row["cart_id"].'&action=delete"><img src="./img/icons/cancel.svg" alt="delete" class="cart-delete"></a>
                                        </div>
                                    </div>
                                </div>
                                ';
                            } while ($row = mysql_fetch_array($result));

                            echo '
                                <div class="d-flex cart-total align-items-end mt-2">
                                    <div class="cart-total__price mr-2 mb-2">Итого: '.$all_price.' руб.</div>
                                    <a href="cart.php?action=confirm"><button class="btn btn-outline-primary">Далее</button></a>
                                </div>
                            ';
                        } else {
                            echo '<h3>Корзина пустая</h3>';
                        }   
                    break;
                case 'confirm':
                    echo '
                        <div class="cart-container mt-3">
                            <div class="d-flex cart-info">
                                <div class="cart-info__item d-flex">
                                    <div class="cart-info__item-title mr-1 ">
                                        <a href="cart.php?action=oneclick">1. Корзина товаров</div></a>
                                    <div class="cart-info__item-arrow">
                                        <img src="../img/icons/right-arrow.svg" alt="arrow">  
                                    </div>
                                </div>
                                <div class="cart-info__item d-flex">
                                    <div class="cart-info__item-title mr-1">
                                        <a href="cart.php?action=confirm" class="cart-active">2. Контактная информация</div></a>
                                    <div class="cart-info__item-arrow">
                                        <img src="../img/icons/right-arrow.svg" alt="arrow">  
                                    </div>
                                </div>
                                <div class="cart-info__item d-flex">
                                    <div class="cart-info__item-title mr-1">
                                        <a href="cart.php?action=completion">3. Завершение</div></a>
                                </div>
                            </div>

                            <div class="cart-steps d-flex justify-content-between align-items-center mt-4">
                                <div class="cart-steps__step">Шаг 2 из 3</div>
                                <a href="cart.php?action=clear"><button class="btn btn-danger">Очистить</button></a>
                            </div>
                            <div class="line mt-2 mb-4"></div>
                        </div>
                    ';

                        if($_SESSION["order_delivery"] == 'По почте') $check1 = "checked";
                        if($_SESSION["order_delivery"] == 'Курьером') $check2 = "checked";
                        if($_SESSION["order_delivery"] == 'Самовывоз') $check3 = "checked";

                    echo '
                        <div class="cart-container">
                            <form method="POST">
                                <div class="delivery-method">
                                    <div class="delivery-title mt-2">Способ доставки:</div>
                                    <div class="line mt-1 mb-2"></div>

                                    <div class="forms__inputs">
                                        <div class="forms__inputs__el">
                                            <input type="radio" id="contactChoice1"
                                                name="order_delivery" class="order_delivery radio" value="По почте" '.$check1.'>
                                            <label for="contactChoice1">По почте</label>
                                        </div>
                                        
                                        <div class="forms inputs__el radio_indents">
                                            <input type="radio" id="contactChoice2"
                                                name="order_delivery" class="order_delivery radio radio_indents" value="Курьером" '.$check2.'>
                                            <label for="contactChoice2">Курьером</label>
                                        </div>

                                        <div class="forms inputs__el radio_indents">
                                            <input type="radio" id="contactChoice3"
                                                name="order_delivery"class="order_delivery radio radio_indents" value="Самовывоз" '.$check3.'>
                                            <label for="contactChoice3">Самовывоз</label>
                                        </div>
                                    </div>
                                </div>
                            
                        ';          

                        if ($_SESSION['auth'] != 'yes_auth') {
                            echo '                  
                                <div class="info-delivery">
                                    <div class="delivery-title mt-2">Информация для доставки:</div>
                                    <div class="line mt-2"></div>

                                    <div class="form-group has-float-label mt-3">
                                        <input class="form-control mb-2 custom-form" id="order_full_name" name="order_full_name" type="text" placeholder="Полное имя" value="'.$_SESSION["order_full_name"].'"/>
                                        <label for="order_full_name">Полное имя</label>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">@</span>
                                        <span class="has-float-label">
                                            <input class="form-control custom-form" id="order_email" name="order_email" type="email" placeholder="name@example.com" value="'.$_SESSION["order_email"].'"/>
                                            <label for="order_email">E-mail</label>
                                        </span>
                                    </div>
                                    <div class="form-group has-float-label">
                                        <input class="form-control mb-2 custom-form" id="order_phone" name="order_phone" type="phone" placeholder="Мобильный телефон" value="'.$_SESSION["order_phone"].'"/>
                                        <label for="order_phone">Мобильный телефон</label>
                                    </div>
                                    <div class="form-group has-float-label ">
                                        <input class="form-control mb-2 custom-form" id="order_address" name="order_address" type="text" placeholder="Адрес доставки" value="'.$_SESSION["order_address"].'"/>
                                        <label for="order_address">Адрес доставки</label>
                                    </div>
                                    <div class="form-group has-float-label mb-2">
                                        <select class="form-control custom-select" name="order_country" id="order_country">
                                            <option selected>'.$_SESSION["order_country"].'</option>
                                            <option>Россия</option>
                                            <option>Казахстан</option>
                                            <option>Белоруссия</option>
                                        </select>
                                        <label for="order_country">Страна</label>
                                    </div>
                                </div>
                      
                                ';
                            }
                            
                        echo '
                            <div class="form-group mt-3">
                                <label for="order_information">Примечание<br>Уточните информацию о заказе.</label>
                                <textarea class="form-control" id="order_information" rows="5" name="order_note">'.$_SESSION["order_note"].'</textarea>
                            </div>
                            <p style="text-align: right;">
                                <button class="btn btn-outline-primary" type="submit" id="btn-send" name="next_submit">Далее</button>
                            </p>
                        </form>
                    </div>
                    ';
                            
                        
                    break;
                case 'completion':
                    $result = mysql_query("SELECT * FROM cart, table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_products", $link);
    
                    if (mysql_num_rows($result) > 0) {
                        $row = mysql_fetch_array($result);

                        do {

                            $int = $row["cart_price"] * $row["cart_count"];
                            $all_price = $all_price + $int;

                        } while ($row = mysql_fetch_array($result));
                    }
                    echo '
                        <div class="cart-container mt-3">
                            <div class="d-flex cart-info">
                                <div class="cart-info__item d-flex">
                                    <div class="cart-info__item-title mr-1 ">
                                        <a href="cart.php?action=oneclick">1. Корзина товаров</div></a>
                                    <div class="cart-info__item-arrow">
                                        <img src="../img/icons/right-arrow.svg" alt="arrow">  
                                    </div>
                                </div>
                                <div class="cart-info__item d-flex">
                                    <div class="cart-info__item-title mr-1">
                                        <a href="cart.php?action=confirm">2. Контактная информация</div></a>
                                    <div class="cart-info__item-arrow">
                                        <img src="../img/icons/right-arrow.svg" alt="arrow">  
                                    </div>
                                </div>
                                <div class="cart-info__item d-flex">
                                    <div class="cart-info__item-title mr-1">
                                        <a href="cart.php?action=completion" class="cart-active">3. Завершение</div></a>
                                </div>
                            </div>

                            <div class="cart-steps d-flex justify-content-between align-items-center mt-4">
                                <div class="cart-steps__step">Шаг 3 из 3</div>
                                <a href="cart.php?action=clear"><button class="btn btn-danger">Очистить</button></a>
                            </div>
                            <div class="line mt-2"></div>
                       
                    ';

                    if($_SESSION['auth'] == 'yes_auth') {
                        echo '
                            <div class="delivery-title mt-2">Конечная информация:</div>
                            <ul class="delivery-list mt-2">
                                <li class="delivery-list_item"><span class="completion-title">Способ доставки:</span>  '.$_SESSION['order_delivery'].'</li>
                                <li class="delivery-list_item"><span class="completion-title">Email:</span>  '.$_SESSION['email'].'</li>
                                <li class="delivery-list_item"><span class="completion-title">ФИО:</span>  '.$_SESSION['full_name'].'</li>
                                <li class="delivery-list_item"><span class="completion-title">Адрес доставки:</span>  '.$_SESSION['address'].'</li>
                                <li class="delivery-list_item"><span class="completion-title">Телефон:</span>  '.$_SESSION['phone'].'</li>
                                <li class="delivery-list_item"><span class="completion-title">Примечание:</span>  '.$_SESSION['order_note'].'</li>
                            </ul>
                        ';
                    } else {
                        echo '
                            <div class="delivery-title mt-2">Конечная информация:</div>
                            <ul class="delivery-list mt-2">
                                <li class="delivery-list_item"><span class="completion-title">Способ доставки:</span>  '.$_SESSION['order_delivery'].'</li>
                                <li class="delivery-list_item"><span class="completion-title">Email:</span>  '.$_SESSION['order_email'].'</li>
                                <li class="delivery-list_item"><span class="completion-title">ФИО:</span>  '.$_SESSION['order_full_name'].'</li>
                                <li class="delivery-list_item"><span class="completion-title">Адрес доставки:</span>  '.$_SESSION['order_address'].'</li>
                                <li class="delivery-list_item"><span class="completion-title">Телефон:</span>  '.$_SESSION['order_phone'].'</li>
                                <li class="delivery-list_item"><span class="completion-title">Примечание:</span>  '.$_SESSION['order_note'].'</li>
                            </ul>
                        ';
                    }

                    echo '
                        <div class="total-price">
                            <div class="cart-total__price mb-3">Итого: '.$all_price.' руб.</div>
                            <button class="btn btn-success">Оплатить</button>
                        </div>
                    </div>
                    ';

                    break;
                default:
                    echo '
                        <div class="cart-container mt-3">
                            <div class="d-flex cart-info">
                                <div class="cart-info__item d-flex">
                                    <div class="cart-info__item-title mr-1 ">
                                        <a href="cart.php?action=oneclick" class="cart-active">1. Корзина товаров</div></a>
                                    <div class="cart-info__item-arrow">
                                        <img src="../img/icons/right-arrow.svg" alt="arrow">  
                                    </div>
                                </div>
                                <div class="cart-info__item d-flex">
                                    <div class="cart-info__item-title mr-1">
                                        <a href="cart.php?action=confirm">2. Контактная информация</div></a>
                                    <div class="cart-info__item-arrow">
                                        <img src="../img/icons/right-arrow.svg" alt="arrow">  
                                    </div>
                                </div>
                                <div class="cart-info__item d-flex">
                                    <div class="cart-info__item-title mr-1">
                                        <a href="cart.php?action=completion">3. Завершение</div></a>
                                </div>
                            </div>

                            <div class="cart-steps d-flex justify-content-between align-items-center mt-4">
                                <div class="cart-steps__step">Шаг 1 из 3</div>
                                <a href="cart.php?action=clear"><button class="btn btn-danger">Очистить</button></a>
                            </div>
                        </div>
                    ';

                    $result = mysql_query("SELECT * FROM cart, table_products WHERE cart.cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND table_products.products_id = cart.cart_id_products", $link);

                    if (mysql_num_rows($result) > 0) {
                        $row = mysql_fetch_array($result);

                        echo '
                        <div class="cart-cap cart-container mt-4">
                            <div class="line mb-2"></div>
                            <div class="cart-cap__titles d-flex justify-content-around">
                                <div class="cart-cap__titles-title">
                                    Изображение
                                </div>
                                <div class="cart-cap__titles-title">
                                    Наименование товара
                                </div>
                                <div class="cart-cap__titles-title">
                                    Кол-во
                                </div>
                                <div class="cart-cap__titles-title">
                                    Цена
                                </div>
                            </div>
                            <div class="line mt-2"></div>
                        ';

                        do {

                            $int = $row["cart_price"] * $row["cart_count"];
                            $all_price = $all_price + $int;
                            echo '
                                <div class="mb-3 mt-3">    
                                    <div class="card-user card_hover cart-size">
                                        <img class="card-img-top card-img-top-user" src="./img/products/'.$row["type_of_products"].'/'.$row["image"].'" alt="Card image cap">
                                        <div class="card-body-user d-flex align-items-center">
                                            <div class="card-body-user__text">
                                                <h5 class="card-title">'.$row["title"].'</h5>
                                                <p class="card-text cart-text_size">'.$row["mini_description"].'</p>
                                            </div>
                                            <div class="card-count card-count_indents">
                                                <div class="card-count__minus" count="'.$row["cart_id"].'">-</div>
                                                <div class="card-count__input">
                                                    <input id="input-id'.$row["cart_id"].'" class="count-input" count="'.$row["cart_id"].'" maxlength="3" type="text" value="'.$row["cart_count"].'"/>
                                                </div>
                                                <div class="card-count__plus" count="'.$row["cart_id"].'">+</div>
                                            </div>
                                            <div id="product'.$row["cart_id"].'" class="product-price__count product-price__count_indents" price="'.$row["cart_price"].'">'.$int.' руб.</div>
                                        </div>
                                        <div class="cart-delete">
                                            <a href="cart.php?id='.$row["cart_id"].'&action=delete"><img src="./img/icons/cancel.svg" alt="delete" class="cart-delete"></a>
                                        </div>
                                    </div>
                                </div>
                            ';
                        } while ($row = mysql_fetch_array($result));

                        echo '
                            <div class="d-flex cart-total align-items-end mt-2">
                                <div class="cart-total__price mr-2 mb-2">Итого: '.$all_price.' руб.</div>
                                <a href="cart.php?action=confirm"><button class="btn btn-outline-primary">Далее</button></a>
                            </div>
                        ';
                    } else {
                        echo '
                            <div class="cart-container">
                                <div class="line mt-4 mb-2"></div>
                                <h3>Корзина пустая</h3>
                            </div>
                            ';
                    }     
                    break;
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
</body>
</html>