<?php
    $invalid = 0;

    if($_SERVER['REQUEST_METHOD']=='POST') {
        include 'connect.php';
        $username = $_POST['username'];
        $password = $_POST['password'];



        $sql = $conn->prepare("SELECT * FROM registration WHERE username = :username AND password = :password");
        $sql->bindValue(":username", $username);
        $sql->bindValue(":password", $password);
        $sql->execute();
        
        $rowCount = $sql->rowCount();

        if($rowCount > 0) {
            session_start();
            $_SESSION['username'] = $username;
            header('Location: home.php');
        } else {
            $invalid = 1;
        }
    }



?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Login Page</title>
  </head>
  <body class="bg-info">

    <?php 
        if($invalid) {
            echo 
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Invalid Data.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        } ?>

    <h1 class="text-center mt-5">Login to our website</h1>
    <div class="container mt-5">
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="text" class="form-control"  placeholder="Enter your username" name="username" Required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control"  placeholder="Enter your Password" name="password" Required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>


  </body>
</html>