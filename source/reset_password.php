
<DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
</head>
<body class="nen">

<?php

    $error = '';
    $email = '';
    $pass = '';
    $pass_confirm = '';
    
    
    if (isset($_GET['email']) && isset($_GET['token'])  && !empty($_GET['email']) && !empty($_GET['token'])) { 
        
        require('./API/function.php');
        $email = $_GET['email'];
        $token = $_GET['token'];
        $checkResetToken = json_decode(checkResetToken($email));

        // Kiểm tra email có tồn tại trên bảng reset_token hay không
        if (time() > $checkResetToken->expire_on) {
            $error = 'This link is invalid';
        } else if ($token != $checkResetToken->token){
            $error = 'This link is invalid';
        } else {

            if (isset($_POST['pass']) && isset($_POST['pass-confirm'])){
                $pass = $_POST['pass'];
                $pass_confirm = $_POST['pass-confirm'];
                if(empty($pass)){
                    $error = 'Please enter the password';
                } else if (strlen($pass) < 6) {
                    $error = 'The password must have at least 6 character';
                } else if (empty($pass_confirm)){
                    $error = 'Please confirm the password';
                } else if ($pass != $pass_confirm) {
                    $error = 'Password does not match';
                } 
                else {

                    updatePassword($email, $pass_confirm);
                    disableResetToken($email);
                    header('Location: login.php');
    
                }
            };
        };
        
    } else {
        header('Location: ./login.php');
        exit();
    };
   
?>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <h3 class="text-center text-secondary mt-5 mb-3">Reset Password</h3>

            <form novalidate method="post" class="border rounded w-100 mb-5 mx-auto px-3 pt-3 bg-light">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input readonly value="<?= $email?>" name="email" id="email" type="text" class="form-control" placeholder="Email address">
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input  value="<?= $pass?>" name="pass" required class="form-control" type="password" placeholder="Password" id="pass">
                    <div class="invalid-feedback">Password is not valid.</div>
                </div>
                <div class="form-group">
                    <label for="pass2">Confirm Password</label>
                    <input value="<?= $pass_confirm?>" name="pass-confirm" required class="form-control" type="password" placeholder="Confirm Password" id="pass2">
                    <div class="invalid-feedback">Password is not valid.</div>
                </div>
                <div class="form-group">
                    <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    ?>
                    <button type="submit" class="btn btn-success px-5">Change password</button>
                </div>
            </form>

        </div>
    </div>
</div> 

</body>
</html>
