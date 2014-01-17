<?php
include '../db/db_operations.php';
include 'action_mapping.php';
if(isset($_GET["action"])){
    $action = $_GET["action"];
    switch($action){
        case ACTMAP::ACTION_LOGIN:
            if(isset($_GET['user']) && isset($_GET['passwd']) && isset($_GET['deviceid'])){
                $user = $_GET['user'];
                $pass = $_GET['passwd'];
                $did = $_GET['deviceid'];
                $data = DBOP::login($user, $pass, $did);
            } else {
                echo 'insufficient info';
            }
            break;
        default:
            echo 'non-recognizable action code';
            break;
    }
    
    $data_encode = json_encode($data);
} else {
    echo 'please provide action code for the service';
}

echo $data_encode;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
