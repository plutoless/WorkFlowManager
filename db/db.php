<?php
    include_once 'db_info.php'; 
    class DB{
        private $con = null;         
        function connect(){
            $con = mysql_connect(DBINFO::HOST,  DBINFO::USER,  DBINFO::PASS) or die(mysql_error());
            mysql_set_charset('utf8', $con) or die('cannot set names to utf8');            
            mysql_select_db(DBINFO::DB_NAME,$con) or die(mysql_error());
        }        
        function disconnect(){            
            mysql_close($this->con);        
        }
    }
?>
