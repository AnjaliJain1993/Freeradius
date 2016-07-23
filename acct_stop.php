<?php
$conn =  mysql_connect('localhost','root','root') or die("cannot connect");
mysql_select_db("radius");
$user=$argv[1];
$sessionid=$argv[2];
$sql="DELETE FROM from acctstop where User_Name='$user' and Acct_Session_Id='$sessionid'";
$retval=mysql_query($sql);
mysql_close($conn);
?>

