<?php
include 'db.php';

    class DBOP{
        protected $db = NULL;
        public function __construct() {
            $this->db = new DB();
            $this->db->connect();
        }
        
        public function login($user, $pwd, $did){
            $query = sprintf("SELECT * FROM user WHERE username='%s' AND passwd='%s'",
                                mysql_real_escape_string($user), mysql_real_escape_string($pwd));
            $result = mysql_query($query) or die(mysql_error());
            $row = mysql_fetch_assoc($result);
            if($row){
                //check if did exists
                if(is_null($row['did']) || $row['did'] == ""){
                    //if not, we set the passed $did to sql
                    $query = sprintf("UPDATE user SET did='%s' WHERE uid=%d",
                                mysql_real_escape_string($did), $row['uid']);
                    $result = mysql_query($query) or die(mysql_errno());
                    $row['did'] = $did;
                    return array('data'=>$row, 'valid'=>true);
                } else {
                    //else, see if the passed value matches
                    if($did == $row['did']){
                        return array('data'=>$row, 'valid'=>true); 
                    } else {
                        //not match, return failure
                        return array('data'=>false, 'valid'=>false); 
                    }
                }
            } else {
                //passwd not match with user
                return array('data'=>$row, 'valid'=>false);
            }
        }
        
        public function submitMessage($uid, $text, $pos, $attachment){
            $query = sprintf("INSERT INTO message (uid, text, pos, attachment) VALUES (%s, '%s', '%s', '%s')",
                                mysql_real_escape_string($uid), mysql_real_escape_string($text), mysql_real_escape_string($pos), mysql_real_escape_string($attachment));
            mysql_query($query) or die(mysql_errno());
            return true;
        }
    }