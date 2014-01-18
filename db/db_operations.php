<?php
include 'db.php';

    class DBOP{
        protected $db = NULL;
        public function __construct() {
            $this->db = new DB();
        }
        
        public function login($user, $pwd, $did){
            $this->db->connect();
            $query = sprintf("SELECT * FROM user WHERE username='%s' AND passwd='%s' AND did='%s'",
                                $user, $pwd, $did);
            $result = mysql_query($query) or die(mysql_error());
            $row = mysql_fetch_assoc($result);
            return array('data'=>$row);
        }
    }
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
