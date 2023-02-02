<!DOCTYPE html>
<html lang="en">

<head>
  <title>Activation</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>

<body class="abcxyz">
  <div class="container">

    <?php 

      if (isset($_GET['email']) && isset($_GET['token'])) {
        require_once ('connection.php');
        $sql = 'SELECT * FROM account where `email` = '.'"'.$_GET['email'].'"'.'';
        try{
            $stmt = $dbCon->prepare($sql);
            $stmt->execute();
        }
        catch(PDOException $ex){
            die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
        }
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
        {
            $data[] = $row;
        };
        if ($_GET['email'] == $data[0]['email'] && $_GET['token'] == $data[0]['activate_token']) { 
          
          $sql_activate = 'UPDATE account set activated = 1 where `activate_token` = '.'"'.$_GET['token'].'"'.'';

          try{
            $stmt = $dbCon->prepare($sql_activate);
            $stmt->execute();
          }
          catch(PDOException $ex){
              die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
          };

          ?>
          <div class="row">
            <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
                <h4>Account Activation</h4>
                <p class="text-success">Congratulations! Your account has been activated. Now you can login to manage your account information.</p>
                <a class="btn btn-success px-5" href="login.php">Login</a>
            </div>
          </div><?php
        } else { ?>

          <div class="row">
          <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
              <h4>Account Activation</h4>
              <p class="text-danger">The invalid URL, please try again. Or click <a href="login.php">here</a> to login.</p>
              <a class="btn btn-success px-5" href="login.php">Login</a>
            </div>
          </div><?php
        };
      }; 
    ?>



    <?php

      if (isset($_GET['request'])) { ?> 
      
        <div class="row">
          <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
            <h4>Account Activation</h4>
            <p>Thank you for creating your account! To complete the account creation process please click on the link below
              to verify your email address.</p>
            <p><a
                href="https://accounts.google.com/ServiceLogin/identifier?service=mail&passive=true&rm=false&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&ss=1&scc=1&ltmpl=default&ltmplcache=2&emr=1&osid=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin">Click
                here activate your account.</a></p>
            <p>Thank you!</p>
            <a class="btn btn-success px-5" href="login.php">Login</a>
          </div>
        </div> <?php
      };

    ?>

    <?php

      if (isset($_GET['reset-password'])) { ?> 
        <div class="row">
          <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
            <h4>Reset password</h4>
            <p>We're sending you this email because you requested a password reset. Click on the link below to check your email.</p>
            <p><a
                href="https://accounts.google.com/ServiceLogin/identifier?service=mail&passive=true&rm=false&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&ss=1&scc=1&ltmpl=default&ltmplcache=2&emr=1&osid=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin">Click
                here to set a new password.</a></p>
            <p>Thank you!</p>
            <a class="btn btn-success px-5" href="login.php">Login</a>
          </div>
        </div><?php
      };
    ?>

    
<?php

      if (isset($_GET['reset']) && $_GET['reset'] == 'success') { ?> 
        <div class="row">
          <div class="col-md-6 mt-5 mx-auto p-3 border rounded">
            <h4>Reset password successfully</h4>
            <p>Your password has been reset. Please login again.</p>
            <p>Thank you!</p>
            <a class="btn btn-success px-5" href="login.php">Login</a>
          </div>
        </div><?php
      };
    ?>

  </div>
</body>

</html>