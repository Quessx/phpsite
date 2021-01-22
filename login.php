<?php
require_once('template/header_login.php');

?>
<div class="container">
    <div class="row">
    <div class="col-lg-4">
    <h2>Войти</h2>
    <form method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="den@d">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    </div>
</div>


</div><!--content-->
<?php 
    require_once('template/footer.php');
?>