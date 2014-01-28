<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
include '../db/db_operations.php';
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>

        <table>
            <tbody>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Message</th>
                <th>Position</th>
                <th>Attachment</th>
            </tr>
        <?php
        // put your code here
            $db = new DBOP();
            $msgs = $db->getAllMessages();
            foreach ($msgs as $msg):
        ?>
            <tr>
                <td><?php echo $msg['firstname'];?></td>
                <td><?php echo $msg['lastname'];?></td>
                <td><?php echo $msg['username'];?></td>
                <td><?php echo $msg['text'];?></td>
                <td><?php echo $msg['pos'];?></td>
                <td><a href=<?php echo $msg['attachment'];?>>file</a></td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </body>
</html>
