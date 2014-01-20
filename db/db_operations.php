<?php
include 'db.php';

    class DBOP{
        protected $db = NULL;
        public function __construct() {
            $this->db = new DB();
            $this->db->connect();
        }
        
        public function login($user, $pwd, $did){
            $query = sprintf("SELECT * FROM user WHERE username='%s' AND passwd='%s' AND did='%s'",
                                mysql_real_escape_string($user), mysql_real_escape_string($pwd), mysql_real_escape_string($did));
            $result = mysql_query($query) or die(mysql_error());
            $row = mysql_fetch_assoc($result);
            return array('data'=>$row);
        }
        
        public function submitMessage($text, $pos, $attachments){
            
        }
    }
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
