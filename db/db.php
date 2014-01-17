<?php
    include_once 'db_info.php'; 
    class DB{
        private $con = null;         
        function connect(){
            $this->con = mysql_connect(DBINFO::host,  DBINFO::USER,  DBINFO::PASS) or die(mysql_error());
            mysql_set_charset('utf8', $this->con) or die('cannot set names to utf8');            
            mysql_select_db("kilima5_fightdb",$this->con) or die(mysql_error());
        }        
        function disconnect(){            
            mysql_close($this->con);        
        }
    }
?>
