<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>Hello, world!</title>
</head>
<body>
<div class="wrap">
    <div class="content">
        <nav class="navbar justify-content-between navbar-dark bg-dark mb-4">
            <a class="navbar-brand" href="/">Animal</a>
            <ul class="navbar-nav flex-row mr-3">
                
                    <?php
                        if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
                        {
                            $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '".intval($_COOKIE['id'])."' LIMIT 1");
                            $userdata = mysqli_fetch_assoc($query);
                            echo "<li class='nav-item mr-2'><a href='/admin.php' class='btn btn-secondary text-white-50 text-uppercase font-weight-bold mr-5'>".$userdata['login']."</a></li>";
                            echo '<li class="nav-item mr-5"><a class="nav-link text-uppercase font-weight-bold" href="/logout.php" tabindex="-1" aria-disabled="true">Logout</a></li>';

                        }
                        else {
                            echo '<li class="nav-item mr-5"><a class="nav-link text-uppercase font-weight-bold" href="/logout.php" tabindex="-1" aria-disabled="true">Login</a></li>';
                            echo '<li class="nav-item mr-5"><a class="nav-link text-uppercase font-weight-bold" href="/registration.php">Registration</a></li>';
                        }
                    ?>
            </ul>
        </nav>