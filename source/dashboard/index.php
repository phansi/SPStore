<?php 

session_start();

if(!isset($_SESSION['user'])){
    header('Location: ../login.php');
    exit();
}

if(isset($_SESSION['user']) && $_SESSION['role'] == 3){
    header('Location: ./user/');
    exit();
}

if(isset($_SESSION['user']) && $_SESSION['role'] == 2){
    header('Location: ./developer/');
    exit();
}

if(isset($_SESSION['user']) && $_SESSION['role'] == 1){
    header('Location: ./admin/');
    exit();
}



