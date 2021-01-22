<?php
require_once 'core/config.php';
require_once 'core/function.php';
$conn = connect();
$data = select($conn);
require_once 'check_login.php';
$flash = '';
if(isset($_COOKIE['bd_create_success']) && $_COOKIE['bd_create_success']!=''){
    if($_COOKIE['bd_create_success'] == 1){
        setcookie('bd_create_success', 1, time()-10);
        $flash = "New record created successfully";
    }
}
?>
<?php
require_once 'template/header_html.php';
?>