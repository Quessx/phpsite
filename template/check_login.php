<?php
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);

    if(($userdata['hash'] !== $_COOKIE['hash']) or ($userdata['id'] !== $_COOKIE['id']))
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        header('Location: /login.php');

    }
}
else {
    header('Location: /login.php');
}
?>