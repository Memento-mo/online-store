<?php 
    if ($_SESSION['auth'] != 'yes_auth' && $_COOKIE['remember']) {
        $str = $_COOKIE['remember'];

        $all_len = strlen($str);
        $login_len = strpos($str, '+');
        $login = clear_string(substr($str, 0, $login_len));

        $pass = clear_string(substr($str, $login_len + 1, $all_len));

        $result =mysql_query("SELECT * FROM reg_users WHERE username='".$username."' AND password='".$password."'");    

        
        if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_array($result);
            session_start();
            $_SESSION['session_username'] = $username;
            $_SESSION['auth'] = 'yes_auth';
            $_SESSION['address'] = $dbaddress;
            $_SESSION['phone'] = $dbphone;
            $_SESSION['email'] = $dbemail;
            $_SESSION['country'] = $dbcountry;
            $_SESSION['password'] = $dbpassword;
            $_SESSION['full_name'] = $dbfullname;
        };
    }
?>