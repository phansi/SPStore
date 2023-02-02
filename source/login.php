<?php
    session_start();
    if (isset($_SESSION['user'])) {
        header('Location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->

    <!-- Latest compiled JavaScript -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"
        integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
    
    <title>Đăng nhập</title>

</head>

<body class="abcxyz">
    <?php

    $error = '';
    $email = '';
    $pass = '';

    if (isset($_POST['email']) && isset($_POST['pass'])) {

        require('./API/function.php');

        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $checkUser = json_decode(checkUser($email));

        
        if (empty($email)) {
            $error = 'Please enter your email';
        }
        else if (empty($pass)) {
            $error = 'Please enter your password';
        }
        else if (strlen($pass) < 6) {
            $error = 'Password must have at least 6 characters';
        } 
        else if (empty($checkUser)) {
            $error = 'Account does not exists';
        } else {

            if (md5($pass) != $checkUser[0]->password) {
                $error = 'Password is invalid';
            } else {
                if ($checkUser[0]->activated == 0 ) {
                    $error = 'Account is not activated';
                } else {
                    //Login success and create session
                    $_SESSION['user'] = $checkUser[0]->email;
                    $_SESSION['firstname'] = $checkUser[0]->firstname;
                    $_SESSION['lastname'] = $checkUser[0]->lastname;
                    $_SESSION['role'] = $checkUser[0]->accounttype;
                    header('Location: index.php?Author=1');
                    exit();
                }
            }
        }
    };
?>
    <div class="container  login-form-custom">
        <form  method="POST" id="myLoginForm">
            <fieldset>

                <div class="form-group mb-5">
                    <h1 class="Dangnhap text-center text-uppercase ">Đăng nhập</h1>
                </div>


                <div class="form-group">
                    <div class="input-group mb-2">
                        <span class="input-group-text" id="email"><i class="fas fa-users"></i></span>
                        <input value="<?= $email ?>" name="email" id="email" type="email" class="form-control" placeholder="Email">
                    </div>
                </div>



                <div class="form-group">
                    <div class="input-group mb-2">
                        <span class="input-group-text" id="password"><i class="fas fa-lock"></i></span>
                        <input name="pass" value="<?= $pass ?>" id="password" type="password" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="form-group custom-control custom-checkbox">
                    <input <?= isset($_POST['remember']) ? 'checked' : '' ?> name="remember" type="checkbox" class="custom-control-input" id="remember">
                    <label class="custom-control-label" for="remember">Remember login</label>
                </div>

                <div class="form-group">
                <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    ?>
                    <button class="btn btn-primary btn-block">Đăng nhập</button>
                </div>

                <div class="form-group text-white text-center">
                    <a href="forgot.php">Quên mật khẩu</a>
                </div>
                <div class="form-group text-white text-center">
                    <a href="register.php">Tạo tài khoản mới</a>
                </div>

            </fieldset>

        </form>

    </div>


    
</body>

</html>