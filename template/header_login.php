<?php
require_once 'core/config.php';
require_once 'core/function.php';
$conn = connect();

function generateHash($length = 5){
    $hash = "qwertyuiopQWERTYUIOP1234567890zxcvbnmZXCVBNM";
    $code = '';
    for($i = 0; $i < $length; $i++){
        $code .= $hash[rand(0, strlen($hash)-1)];
    }
    return $code;
}

if(isset($_POST['password'])){
    $query = mysqli_query($conn, "SELECT id, password FROM users WHERE email='".$_POST['email']."' LIMIT 1");
    $row = mysqli_fetch_assoc($query);
    // var_dump($row);
    if($row['password'] == md5($_POST['password'])){
        $hash = generateHash(16);
        mysqli_query($conn, "UPDATE users SET hash='".$hash."' WHERE id='".$row['id']."'");
        setcookie('id', $row['id'], time()+7*24*60*60);
        setcookie('hash', $hash, time()+7*24*60*60, null, null, null, true);
        header("Location: /admin.php");
        exit();
    }
    // else {
    //     print "Вы ввели неправильный логин/пароль";
    // }
    
}
close($conn);
?>
<?php
require_once 'template/header_html.php';
?>
