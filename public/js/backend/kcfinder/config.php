<?php

ini_set('session.use_only_cookies', '0');

// Вот тут бы выбираем нестандартное имя для cookie!!
/*@session_name('session');

@session_start();
*/

if(!isset($_SESSION)){
    $_SESSION = [];
    $_SESSION['type'] = '';
}

if(isset($_GET['config']))
{
    $_SESSION['type'] = $_GET['config'];
}else{
    //$_SESSION['type'] = 'default';
}
if(isset($_GET['homedir']))
{
    $_SESSION['homedir'] = $_GET['homedir'];
}
/*if(!$_SESSION['auth_user'])
    die("no permissions");*/

switch($_SESSION['type'])
{
    case "articles":
            include 'config_articles.php';
        break;
    case "categories":
        include 'config_categories.php';
        break;
    default:
            include 'config_default.php';
        break;
}


?>