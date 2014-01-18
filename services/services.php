<?php
include '../db/db_operations.php';
include 'action_mapping.php';

$data = NULL;
$data_encode = NULL;
$action = filter_input(INPUT_GET, "action", FILTER_VALIDATE_INT);
$db = new DBOP();
if($action){
    switch($action){
        case ACTMAP::ACTION_LOGIN:
            $user = filter_input(INPUT_GET, "user");
            $pass = filter_input(INPUT_GET, "passwd");
            $deviceid = filter_input(INPUT_GET, "deviceid");
            if($user && $pass && $deviceid){
                $data = $db->login($user, $pass, $deviceid);
            } else {
                echo 'insufficient info';
            }
            break;
        default:
            echo 'non-recognizable action code';
            break;
    }
    if($data){
        $data_encode = json_encode($data);
    }
} else {
    echo 'please provide action code for the service';
}
if($data_encode){
    echo $data_encode;
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
