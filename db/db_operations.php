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
            return array('data'=>$row, 'valid'=>$row?true:false);
        }
        
        public function submitMessage($uid, $text, $pos, $attachment){
            $query = sprintf("INSERT INTO message (uid, text, pos, attachment) VALUES (%s, '%s', '%s', '%s')",
                                mysql_real_escape_string($uid), mysql_real_escape_string($text), mysql_real_escape_string($pos), mysql_real_escape_string($attachment));
            mysql_query($query) or die(mysql_errno());
            return true;
        }
    }