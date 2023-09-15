<?php
    $success = 0;
    $user = 0;

    if($_SERVER['REQUEST_METHOD']=='POST') {
        include 'connect.php';
        $username = addslashes($_POST['username']);
        $password = addslashes($_POST['password']);



        $sql = $conn->prepare("SELECT * FROM registration WHERE username = :username");
        $sql->bindValue(":username", $username);
        $sql->execute();
        

          if($sql->rowCount() > 0) {
            //   echo "User already exist, try other username";
            $user = 1;
          } else {
              $sql = $conn->prepare("INSERT INTO registration (username, password) VALUES(:username, :password)");
              $sql->bindValue(':username', $username);
              $sql->bindValue(':password', $password);
              $sql->execute();
              //echo "Registration Successfully";
                $success = 1; 
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

    <title>Signup Page</title>
  </head>
  <body>
    <?php 
        if($user) {
            echo 
                '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Oh no, sorry!</strong> User already exist
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        } ?>

    <?php 
        if($success) {
            echo 
                '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> You are successfully signed up.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        } ?>

    <h1 class="text-center mt-5">Sign up Page</h1>
    <div class="container mt-5">
        <form action="sign.php" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="text" class="form-control"  placeholder="Enter your username" name="username" Required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control"  placeholder="Enter your Password" name="password" Required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>
    </div>


  </body>
</html>