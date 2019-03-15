<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Магазины</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Контакты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Доставка и оплата</a>
                </li>
                <li class="nav-item">
                    <a href="../registration.php" class="nav-link">Регистрация</a>
                </li>
            </ul>
        </div>
        <form class="form-inline" method="GET" action="serach.php?q=">
            <input class="form-control mr-sm-2" type="search" placeholder="Поиск по товару" aria-label="Search" name="q">
            <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Поиск</button>
        </form>
    </div>
</nav>
<div class="container">
    <div class="header-menu header-menu_text">
        <div class="header-logo">
            <a href="index.php">
                <img src="./img/on_white_by_logaster.png" alt="logo">
            </a>
        </div>
        <div class="header-telephones">
            <div>+7(929)-594-56-07</div>
            <div>+7(999)-674-52-01</div>
            <button class="btn btn-info mt-2">Заказать звонок</button>
        </div>
    </div>   
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Категории</a>
                    <div class="dropdown-menu">
                        <?php 
                            echo '
                                <a class="dropdown-item" href="view_cat.php?type=BCAA">BCAA</a>
                                <a class="dropdown-item" href="view_cat.php?type=gainer">Гейнер</a>
                                <a class="dropdown-item" href="view_cat.php?type=protein">Протеин</a>
                                <a class="dropdown-item" href="view_cat.php?type=creatine">Креатин</a>
                                <a class="dropdown-item" href="view_cat.php?type=burners">Жиросжигатели</a>
                                <a class="dropdown-item" href="view_cat.php?type=snickers">Батончики</a>
                            ';
                        ?>
                       
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Новинки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Лидеры продаж</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Протеины</a>
                    <div class="dropdown-menu">
                        <?php 
                            $result = mysql_query("SELECT * FROM category WHERE type='protein'", $link);

                            if(mysql_num_rows($result) > 0) {
                                $row = mysql_fetch_array($result);

                                do {
                                    echo '
                                        <a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'" class="dropdown-item">'.$row["brand"].'</a>   
                                    ';

                                } while ($row = mysql_fetch_array($result));
                            };
                        ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false">Гейнеры</a>
                    <div class="dropdown-menu">
                        <?php
                            $result = mysql_query("SELECT * FROM category WHERE type='gainer'", $link);

                            if(mysql_num_rows($result) > 0) {
                                $row = mysql_fetch_array($result);

                                do {
                                    echo '
                                        <a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'" class="dropdown-item">'.$row["brand"].'</a>   
                                    ';
                                } while ($row = mysql_fetch_array($result));
                            };
                        ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">BCAA</a>
                    <div class="dropdown-menu">
                        <?php
                            $result = mysql_query("SELECT * FROM category WHERE type='BCAA'", $link);

                            if(mysql_num_rows($result) > 0) {
                                $row = mysql_fetch_array($result);

                                do {
                                    echo '
                                        <a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'" class="dropdown-item">'.$row["brand"].'</a>   
                                    ';
                                } while ($row = mysql_fetch_array($result));
                            };
                        ?>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Креатин</a>
                    <div class="dropdown-menu">
                        <?php
                            $result = mysql_query("SELECT * FROM category WHERE type='creatine'", $link);

                            if(mysql_num_rows($result) > 0) {
                                $row = mysql_fetch_array($result);

                                do {
                                    echo '
                                        <a href="view_cat.php?cat='.strtolower($row["brand"]).'&type='.$row["type"].'" class="dropdown-item">'.$row["brand"].'</a>   
                                    ';
                                } while ($row = mysql_fetch_array($result));
                            };
                        ?>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</nav>