<?php
require_once 'core/config.php';
require_once 'core/function.php';

$conn = connect();

if (isset($_REQUEST['doGo'])) {
    
    // Все последующие проверки, проверяют форму и выводят ошибку
    // Проверка на совпадение паролей
    if ($_REQUEST['pass'] !== $_REQUEST['pass_rep']) {
        $error = 'Пароль не совпадает';
    }
    
    // Проверка есть ли вообще повторный пароль
    if (!$_REQUEST['pass_rep']) {
        $error = 'Введите повторный пароль';
    }
    
    // Проверка есть ли пароль
    if (!$_REQUEST['pass']) {
        $error = 'Введите пароль';
    }
 
    // Проверка есть ли email
    if (!$_REQUEST['emails']) {
        $error = 'Введите email';
    }
 
    // Проверка есть ли логин
    if (!$_REQUEST['login']) {
        $error = 'Введите login';
    }
 
    // Если ошибок нет, то происходит регистрация 
    if (!$error) {
        $login = $_REQUEST['login'];
        $email = $_REQUEST['emails'];
        // Пароль хешируется
        $pass = md5($_REQUEST['pass']);
        // хешируем хеш, который состоит из логина и времени
        $hash = md5($login . time());

        $result = mysqli_query($conn, "SELECT login, email FROM users");

        $a = array();
        while($row = mysqli_fetch_assoc($result)){
            $a[] = $row;
        }
        $i = 0;
        $b = 0;
        while($i < count($a)){
            if($a[$i]['login'] == $_POST['login'])
            {
                $b = 1;
                break;
            }
            else if($a[$i]['email'] === $_POST['emails']){
                $b = 2;
            }

            $i++;

        }
        if($b == 1){
            $echo = "Такой пользователь существует.";
        }
        else if($b == 2){
            $echo = "Такой email зарегистрирован.";
        }
        else {
            mysqli_query($conn, "INSERT INTO `users` (`login`, `email`, `password`, `hash`, `email_confirmed`) VALUES (UCASE('" . $login . "'),'" . $email . "','" . $pass . "', '" . $hash . "', 1)");
            header("Location: /login.php");
        }

    } else {
        echo $error; 
    }
}
 

require_once "template/header_html.php";
?>
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <h2>Регистрация</h2>
            <form action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="POST">
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <div class="input-group is-invalid username">
                        <input type="text" name="login" id="username" class="form-control is-invalid" placeholder="Name" aria-describedby="validatedInputGroupPrepend" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="validatedInputGroupPrepend">@</span>
                        </div>
                        <input type="email" id="email" name="emails" class="form-control is-invalid" placeholder="Email" aria-describedby="validatedInputGroupPrepend" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <div class="input-group is-invalid">
                        <input type="password" name="pass" id="password" class="form-control is-invalid" placeholder="Password" aria-describedby="validatedInputGroupPrepend" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Confirm the password</label>
                    <div class="input-group is-invalid">
                        <input type="password" name="pass_rep" id="password" class="form-control is-invalid" placeholder="Password" aria-describedby="validatedInputGroupPrepend" required>
                    </div>
                </div>
                <p class="invalid-feedback" style="display: block;" id="check"> <?php echo $echo ?></p>
                    <button type="submit" class="btn btn-primary" name="doGo">Submit</button>
            </form>

        </div>
    </div>
</div>

<script src="js/script.js"></script>
