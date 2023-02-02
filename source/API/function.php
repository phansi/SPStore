<?php

require ('connection.php');

function checkUser($email){
    
    require ('connection.php');

    $sql = 'SELECT * FROM account where `email` = '.'"'.$email.'"'.'';

    $data = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data[] = array(
            'firstname'         => $row['firstname'],
            'lastname'          => $row['lastname'],
            'password'          => $row['password'],
            'email'             => $row['email'],
            'activated'         => $row['activated'],
            'accounttype'       => $row['accounttype']
        );
    }

    return json_encode($data);

}


function checkResetToken($email){

    require ('connection.php');

    $sql = 'SELECT * FROM reset_token where `email` = '.'"'.$email.'"'.'';

    $data = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data = array(
            'id'          => $row['id'],
            'email'             => $row['email'],
            'token'         => $row['token'],
            'expire_on'       => $row['expire_on']
        );
    }

    return json_encode($data);

}


function updatePassword($email, $pass){

    require ('connection.php');

    $sql = 'UPDATE `account` set password = '.'"'.md5($pass).'"'.' where `email` = '.'"'.$email.'"'.'';

    $data = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();

}


function disableResetToken($email){

    require ('connection.php');

    $sql = 'UPDATE `reset_token` set expire_on = 0 where `email` = '.'"'.$email.'"'.'';

    $data = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();

}

function forgotPassword($email, $token){

    require ('connection.php');

    $token_expired = time()+3600;

    $stmt = $dbCon->prepare('INSERT INTO `reset_token`(email,token,expire_on) VALUES(?,?,?)');
    $stmt->execute(array($email, $token, $token_expired));

}



function getUser($role){
    
    require ('connection.php');

    $sql = 'SELECT * FROM account where `accounttype` = '.$role.'';

    $users = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $users[] = array(
            'firstname'         => $row['firstname'],
            'lastname'          => $row['lastname'],
            'email'             => $row['email'],
            'activated'         => $row['activated'],
            'password'         => $row['password'],
            'accounttype'       => $row['accounttype'],
            'wallet'            => $row['wallet'],
            'avatar'            => $row['avatar']
        );
    }

    return json_encode($users);

}



function getApp($role){
    
    require ('connection.php');

    $sql = 'SELECT * FROM application where `acception` = '.$role.'';

    $apps = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $apps[] = array(
            'id'         => $row['id'],
            'name'          => $row['name'],
            'description'             => $row['description'],
            'author'         => $row['author'],
            'version'       => $row['version'],
            'category'            => $row['category'],
            'acception'            => $row['acception'],
            'size'            => $row['size'],
            'publish'            => $row['publish'],
            'icon'            => $row['icon'],
            'download'            => $row['download'],
            'price'            => $row['price']
        );
    }

    return json_encode($apps);

}


function newCategory($name){

    require ('connection.php');

    $stmt = $dbCon->prepare('INSERT INTO `category`(name) VALUES(?)');
    $stmt->execute(array($name));

}




function removeCate($id){

    require ('connection.php');

    $stmt = $dbCon->prepare('DELETE FROM category WHERE id = '.$id.'');
    $stmt->execute();

}


function getCategories(){
    
    require ('connection.php');

    $sql = 'SELECT * FROM category';

    $categories = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $categories[] = array(
            'id'         => $row['id'],
            'name'          => $row['name']
        );
    }

    return json_encode($categories);

}



function appCensorship($id,$param){

    require ('connection.php');
    $sql = 'UPDATE `application` set acception = '.$param.' where id = '.$id.'';
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();

}


function removeApp($id){

    require ('connection.php');
    $sql = 'DELETE FROM `application` where id = '.$id.'';
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();

}




function removeusers($email){
    require ('connection.php');
    $sql = 'DELETE From `account` where email = '.'"'.$email.'"'.'';
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();
}

function newApp($name,$description,$author,$version,$category,$size,$acception,$icon,$download,$price){
    require ('connection.php');
    $sql='INSERT INTO `application` (name,description,author,version,category,size,acception,icon,download,price) VALUES (?,?,?,?,?,?,?,?,?,?)';
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($name,$description,$author,$version,$category,$size,$acception,$icon,$download,$price));
}

function editprofile($firstname,$lastname,$email, $avatar){
    require ('connection.php');
    $sql = 'UPDATE `account` set firstname ='.'"'.$firstname.'"'.',lastname ='.'"'.$lastname.'"'.',avatar ='.'"'.$avatar.'"'.' where `email` = '.'"'.$email.'"'.'';
    $data = array();
    $stmt = $dbCon->prepare($sql);
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

function newcard($serialnumber,$money,$numberofcards){
    require ('connection.php');
    $sql='INSERT INTO `recharge`(serialnumber,money,numberofcards) VALUES (?,?,?)';
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($serialnumber,$money,$numberofcards));
}


function getrecharge(){
    
    require ('connection.php');

    $sql = 'SELECT * FROM recharge ';

    $recharges = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $recharges[] = array(
            'serialnumber'                  => $row['serialnumber'],
            'money'                         => $row['money'],
            'numberofcards'                 => $row['numberofcards'],
            'status'                        => $row['status'],
        );
    }

    return json_encode($recharges);

}
function removecard($serialnumber){
    require ('connection.php');
    $sql = 'DELETE FROM `recharge` where serialnumber = '.$serialnumber.'';
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();

}



function getmoneyofserial($serialnumber){
    
    require ('connection.php');

    $sql = 'SELECT * from recharge where serialnumber = '.$serialnumber.'';
    $data = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $data = array(
            'serialnumber'          => $row['serialnumber'],
            'money'             => $row['money'],
            'status'       => $row['status']
        );
    }

    return json_encode($data);

}



function napthe($sotien,$emailnap,$wallet){
    require ('connection.php');
    $sql = 'UPDATE `account` set wallet =wallet + '.'"'.$sotien.'"'.' ';
                            

   $data = array();
   $stmt = $dbCon->prepare($sql);
   $stmt->execute();
}





function getcard1($seri){
    
    require ('connection.php');

    $sql = 'SELECT * FROM recharge where `serialnumber`= '.'"'.$seri.'"'.'';

    $card1 = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $card1[] = array(
            'serialnumber'                  => $row['serialnumber'],
            'money'                         => $row['money'],
                 'status'                        => $row['status'],
            'numberofcards'                 => $row['numberofcards'],
       
        );
    }

    return json_encode($card1);

}

function getcard2($seri){
    
    require ('connection.php');

    $sql = 'SELECT * FROM recharge_history where `seri`= '.'"'.$seri.'"'.'';

    $card2 = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $card2[] = array(
            'seri'                  => $row['seri'],
            'value'                         => $row['value'],
                 'date'                        => $row['date'],
           
        );
    }

    return json_encode($card2);

}

function nap($seri,$value,$emailnap){
    require ('connection.php');
    $sql='INSERT INTO `recharge_history` (seri,value,emailnap) VALUES (?,?,?)';
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($seri,$value,$emailnap));
}

function disablecard($seri){

    require ('connection.php');

    $sql = 'UPDATE `recharge` set status = "Đã nạp" where `serialnumber` = '.'"'.$seri.'"'.'';

    $data = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();

}



function getcard22($email){
    
    require ('connection.php');

    $sql = 'SELECT * FROM recharge_history where emailnap='.'"'.$email.'"'.'';

    $cc2 = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $cc2[] = array(
            'seri'                  => $row['seri'],
            'value'                         => $row['value'],
            'date'                 => $row['date'],
            
        );
    }

    return json_encode($cc2);

}

function upgrade($email){

    require ('connection.php');

    $sql = 'UPDATE `account` set accounttype = 2,wallet=wallet-500000 where `email` = '.'"'.$email.'"'.'';
    $data = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();
}
function getinfo($email){
    
    require ('connection.php');

    $sql = 'SELECT * FROM account where `email` = '.'"'.$email.'"'.'';

    $info = array();
    $stmt = $dbCon->prepare($sql);
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $info[] = array(
            'firstname'         => $row['firstname'],
            'lastname'          => $row['lastname'],
            'email'             => $row['email'],
            'activated'         => $row['activated'],
            'password'         => $row['password'],
            'accounttype'       => $row['accounttype'],
            'wallet'            => $row['wallet'],
            'avatar'            => $row['avatar']
        );
    }

    return json_encode($info);

}