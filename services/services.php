<?php
error_reporting(E_ALL);
 ini_set("display_errors", 1);
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
        case ACTMAP::ACTION_SUBMIT_MSG:
            $uploaddir = '../uploads/';
            if(!is_writable($uploaddir) || !is_dir($uploaddir)){ echo "error in dir"; }
            
            $file = basename($_FILES['attachment']['name']);
            $uploadfile = $uploaddir . $file;

            echo "file=".$file."\n"; //is empty, but shouldn't
            echo $_FILES['attachment']['tmp_name']."\n";
            echo $_FILES['attachment']['error']."\n";
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadfile)) {
                echo $file;
            }
            else {
                echo "error";
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
