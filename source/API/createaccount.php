<?php
    
    require_once ('connection.php');
    header('Content-Type: application/json');

    if (!isset($_POST['email']) && !isset($_POST['fullname']) && !isset($_POST['password']) && empty($_POST['email']) && empty($_POST['fullname']) && empty($_POST['password'])){
        header('http/1.1 404 not found');
        die();
    } else {
        
        
        try{

            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $password = md5($_POST['password']);
            $token = bin2hex(random_bytes(50));
            $sql = 'INSERT INTO account (email, fullname, password, activated, activate_token, account_type) values (?,?,?,?,?,?)';
            $stmt = $dbCon->prepare($sql);
            $stmt->execute(array($email, $fullname, $password,'', $token, ''));
            header('http/1.1 404 not found');
            echo json_encode(array(
                'status' => true,
                'token' => $token,
            ));
        }
        catch(PDOException $ex){
            die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
        }
    }

    




?>