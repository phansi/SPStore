<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css"
        integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
        <!-- Validation library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Đăng ký tài khoản</title>
</head>

<body class="abcxyz">
<?php

    require('./API/function.php');

    $error = '';
    $first_name = '';
    $last_name = '';
    $email = '';
    $pass = '';
    $pass_confirm = '';

    if (isset($_POST['first']) && isset($_POST['last']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['pass-confirm']))
    {
        $first_name = $_POST['first'];
        $last_name = $_POST['last'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $pass_confirm = $_POST['pass-confirm'];

        if (empty($first_name)) {
            $error = 'Please enter your first name';
        }
        else if (empty($last_name)) {
            $error = 'Please enter your last name';
        }
        else if (empty($email)) {
            $error = 'Please enter your email';
        }
        else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $error = 'This is not a valid email address';
        }
        else if (empty($pass)) {
            $error = 'Please enter your password';
        }
        else if (empty($pass_confirm)) {
            $error = 'Please confirm your password';
        }
        else if (strlen($pass) < 6) {
            $error = 'Password must have at least 6 characters';
        }
        else if ($pass != $pass_confirm) {
            $error = 'Password does not match';
        }
        else {
            
            $checkUser = json_decode(checkUser($email));

            if (!empty($checkUser)) {
                $error = 'This account has already exists';
            } else {
                $activate_token = bin2hex(random_bytes(50));
                ini_set( 'display_errors', 1 );
                error_reporting( E_ALL );
                $from = "test@user.com";
                $to = "$email";
                $subject = "ACTIVATE YOUR ACCOUNT";
                $headers = "From:" . $from;
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                $message = "Thank you for your creating your account. Please click <a href='http://localhost/source/activate.php?email=$email&token=$activate_token'>here<a> to activate your account.";
                mail($to,$subject,$message, $headers);
                $sql = 'INSERT INTO `account`(firstname,lastname,email,password,activate_token) VALUES(?,?,?,?,?)';
                $stmt = $dbCon->prepare($sql);
                $stmt->execute(array($first_name,$last_name,$email,md5($pass_confirm),$activate_token));
                die('<script>window.location.href = "activate.php?request='.$email.'"</script>');
            };
            
        };
    }
?>
    <div class="container  login-form-custom">
        <form method="POST" id="register-form">
            <div class="form-group mb-5">
                <h1 class="Dangnhap text-center text-uppercase ">Đăng ký tài khoản</h1>
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                <input value="<?= $first_name?>" type="text" class="form-control"  placeholder="Firs tname" name="first" >
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                <input value="<?= $last_name?>" type="text" class="form-control" placeholder="Last name" name="last" >
                <div class="invalid-tooltip">Last name is required</div>
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input value="<?= $email?>" type="email" class="form-control" placeholder="Email" name="email" >
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                <input value="<?= $pass?>" type="password" class="form-control" placeholder="Password" name="pass">
                <div class="invalid-feedback">Password is not valid.</div>
            </div>
            <div class="form-message"></div>
            <div class="input-group mb-4">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                <input value="<?= $pass_confirm?>"type="password" class="form-control" placeholder="Nhập lại Password" name="pass-confirm" >
                <div class="invalid-feedback">Password is not valid.</div>
            </div>
        
            <div class="form-group">
                        <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        ?>
                        <button type ="submit"class="form-submit  btn btn-primary btn-block">Đăng ký</button>
                        <button type="reset" class="form-submit  btn btn-dark btn-block ">Reset</button>
                    </div>
                            
            <div class="form-group text-white text-center">
                <a href="login.php">Đăng nhập</a>
            </div>
        </form>

    </div>
    
 


</body>

</html>