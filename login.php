<?php
    include "../EMS/php/koneksi.php";
    include "../EMS/php/user.php";
    session_start();

    if( isset($_SESSION["login"]) ) {
        header("Location: index.php");
        exit;
    }


    if( isset($_POST["login"]) ) {

        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "CALL login_procedure('$username','".sha1($password)."')");

        // cek username
        if(mysqli_num_rows($result) === 1 ) {
            // cek password
            $row = mysqli_fetch_assoc($result);

      
            if( sha1($password)== $row["password"] ) {

                $_SESSION["login"] = true;
                $_SESSION["password"] = $password;
                
                if ($row["level"]=="1") {
                    $_SESSION['user']=new admin($username);
                }else{
                    $_SESSION['user']=new user($username);
                }

               

                
                header("Location: index.php");               
                exit;
            }
        }

        $error = true;
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/global.css">
    <title>E-Corp</title>
</head>
<body>


   


    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Evil Corp - Employee Management System</a>
    </nav>
    

    <div class="d-flex justify-content-center">
                <form class="form-container" method="post">
                <h3>Login Page</h3>
                    <div class="form-group">
                        <label for="username">ID Pegawai</label>
                        <input type="username" class="form-control" id="username" aria-describedby="username" placeholder="ID Pegawai" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password" name>Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>
                    <?php if( isset($error) ) : ?>
                        <p style="color: red; font-style: italic;">username / password salah</p>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                </form>
        </div>




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="js/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <!-- <script src="js/popper.min.js"></script> -->
    <script src="js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/jquery-3.5.0.min.js"></script>
    <script src="script.js"></script>
</body>
</html>