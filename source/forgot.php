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

        <link rel="stylesheet" href="css/style.css">
    <title>Quên mật khẩu </title>
</head>

<body class="abcxyz">

<?php

    $error = '';
    $email = '';

    if (isset($_POST['email'])) {

        $email = $_POST['email'];
        
        if (empty($email)) {
            $error = 'Please enter your email';
        }
        else if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $error = 'This is not a valid email address';
        }
        else {
            
            require_once('./API/function.php');

            $checkUser = json_decode(checkUser($email));
            $checkResetToken = json_decode(checkResetToken($email));

            // $error = $checkResetToken[0]->token;

            if (empty($checkUser[0]->email)) {

                $error = "This account doesn't exist. Please try again.";
                
            } else {
                
                if (!empty($checkResetToken->email) && time() < $checkResetToken->expire_on) {

                    $error = 'Request has been sent!';
                    
                } else {
                    
                    $token = bin2hex(random_bytes(50));

                    forgotPassword($email, $token);

                    // Sending email for activate account
                    ini_set( 'display_errors', 1 );
                    error_reporting( E_ALL );
                    $to = "$email";
                    $from = "test@user.com";
                    $subject = "RESET YOUR PASSWORD";
                    $headers = "From:" . $from;
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $message = "Please click <a href='http://localhost/source/reset_password.php?email=$email&token=$token'>here<a> to reset your password";
                    mail($to,$subject,$message, $headers);
                    
                    exit('<script>window.location.href = "activate.php?reset-password='.$email.'"</script>');
                    
                    };

                };

            };
        };
    
?>

    <div class="container  login-form-custom">
        <form method="POST" >
            <div class="form-group mb-5">
                <h1 class="Dangnhap text-center text-uppercase ">Quên mật khẩu</h1>
            </div>
            <div class="input-group mb-4">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                <input name="email" id="email" type="text" class="form-control" placeholder="Email address" value="<?= $email?>">
            </div>
      
            <div class="form-group">
                    <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    ?>
                        <button class="btn btn-primary btn-block">Quên mật khẩu</button>
                </div>
            
           
        </form>
    </div>


</body>

</html>