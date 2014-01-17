<?php
include 'db.php';

    class DBOP{
        function login($user, $pwd, $did){
            DB::connect();
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
