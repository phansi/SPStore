<?php
    
    require_once ('connection.php');
    // header('Content-Type: application/json');

    $sql = 'SELECT * FROM `application` where `acception`=1';

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
    }

    // echo json_encode($data);

?>