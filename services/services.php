<?php
// session_start();
include '../db/db_operations.php';
include 'action_mapping.php';
include 'system_info.php';

$data = NULL;
$data_encode = NULL;
$action = filter_input(INPUT_GET, "action", FILTER_VALIDATE_INT);
$db = new DBOP();
$uid = NULL;
// if(isset($_SESSION['uid'])){
    // $uid = $_SESSION['uid'];
// }
if($action){
    // if($action != ACTMAP::ACTION_LOGIN && !$uid){
        // echo "login required";
    // } else {
        $uid = filter_input(INPUT_POST, "uid");
    
        switch($action){
            case ACTMAP::ACTION_LOGIN:
                $user = filter_input(INPUT_GET, "user");
                $pass = filter_input(INPUT_GET, "passwd");
                $deviceid = filter_input(INPUT_GET, "deviceid");
                if($user && $pass && $deviceid){
                    $data = $db->login($user, $pass, $deviceid);
                    if($data['valid']){
                        // $_SESSION['uid'] = $data['data']['uid'];
                    }
                } else {
                    echo 'insufficient info';
                }
                break;
            case ACTMAP::ACTION_SUBMIT_MSG_WITH_IMG:
                $text = filter_input(INPUT_POST, "text");
                $pos = filter_input(INPUT_POST, "pos");
                if($text && $pos){
                    $uploaddir = '../'.SYSINFO::UPLOAD_DIR;
                    if(!is_writable($uploaddir) || !is_dir($uploaddir)){ echo "error in dir"; }

                    $file = basename($_FILES['attachment']['name']);
                    $uploadfile = $uploaddir . $file;

//                    echo "file=".$file."\n"; //is empty, but shouldn't
//                    echo $_FILES['attachment']['tmp_name']."\n";
//                    echo $_FILES['attachment']['error']."\n";
                    if (move_uploaded_file($_FILES['attachment']['tmp_name'], $uploadfile)) {
                        if($db->submitMessage($uid, $text, $pos, $uploadfile)){
                            $data = array("valid"=>true);
                        } else {
                            $data = array("valid"=>false);
                        }
                    }
                    else {
                        $data = array("valid"=>false);
                    }
                }
                break;
            case ACTMAP::ACTION_SUBMIT_MSG_WITH_DOC:
                $text = filter_input(INPUT_POST, "text");
                $pos = filter_input(INPUT_POST, "pos");
                if($text && $pos){
                    $title = filter_input(INPUT_POST, "title");
                    $var1 = filter_input(INPUT_POST, "var1")?filter_input(INPUT_POST, "var1"):"";
                    $var2 = filter_input(INPUT_POST, "var2")?filter_input(INPUT_POST, "var2"):"";
                    $var3 = filter_input(INPUT_POST, "var3")?filter_input(INPUT_POST, "var3"):"";
                    if($title){
                        require_once '../PHPWord.php';
                        $uploaddir = '../'.SYSINFO::UPLOAD_DIR;
                        $templateFile = '../'.SYSINFO::TEMPLATE_FILE_PATH;
                        $PHPWord = new PHPWord();

                        $document = $PHPWord->loadTemplate($templateFile);

                        $document->setValue('Value1', $var1);
                        $document->setValue('Value2', $var2);
                        $document->setValue('Value3', $var3);
                        $filename = iconv('UTF-8','GBK',$uploaddir.$title.'.docx');;
                        $document->save($filename);
                        if(file_exists($filename)){
                            if($db->submitMessage($uid, $text, $pos, $filename)){
                                $data = array("valid"=>true);
                            } else {
                                $data = array("valid"=>false);
                            }
                        }else {
                            $data = array("valid"=>false);
                        }

                    }
                }
                break;
            default:
                echo 'non-recognizable action code';
                break;
        }
    // }
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
