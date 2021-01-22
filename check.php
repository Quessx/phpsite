<?php
require_once 'core/config.php';
require_once 'core/function.php';
$conn = connect();

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $user = mysqli_fetch_assoc($query);

    if(($user['hash'] !== $_COOKIE['hash']) or ($user['id'] !== $_COOKIE['id']))
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        header('Location: /');

    }
    else
    {
        header('Location: /');
    }
}
else
{
    print "Включите куки";
}
?>