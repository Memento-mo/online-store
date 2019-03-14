<div class="filter">
    <div class="filter__container">
        <form method="GET" action="search_filter.php">
            <button type="submit" name="submit" class="btn btn-primary mb-2" id="showFilter">Показать результат</button>
            <button class="btn btn-primary" id="clearFilter">Очистить фильтр</button>

            <div class="title">Производитель</div>

            <div class="row">
                <div class="filter__inputs_one">
                    <?php 
                        $result = mysql_query("SELECT * FROM brands", $link);
                
                        if(mysql_num_rows($result) > 0) {
                            $row = mysql_fetch_array($result);

                            do {
                                $checked_brand = "";

                                if ($_GET["brand"]) {

                                    if (in_array($row["brand_id"], $_GET["brand"])) {
                                        $checked_brand = "checked";
                                    };
                                    
                                };
                                echo '
                                    <label class="container-checkbox">'.$row["brand"].'
                                        <input '.$checked_brand.'name="brand[]" value="'.$row["brand_id"].'" type="checkbox" class="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                ';

                            } while ($row = mysql_fetch_array($result));
                        };
                    ?>

            </div>
        </form>
    </div>
</div>
