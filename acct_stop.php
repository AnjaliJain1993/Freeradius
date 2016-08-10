<?php
$conn =  mysql_connect('localhost','root','root') or die("cannot connect");
mysql_select_db("radius");
$user=$argv[1];
$sessionid=$argv[2];
//$sql="INSERT INTO radphp VALUES ('$argv[1]','$argv[2]','$argv[3]','$argv[4]','$argv[5]',ADDTIME(now(),'05:30:00'))";
$sql="DELETE FROM from acctstop where User_Name='$user' and Acct_Session_Id='$sessionid'";
$retval=mysql_query($sql);
//if($row = mysql_fetch_row($retval))
//{
	//$query="INSERT INTO acctstart VALUES ('$argv[1]','$argv[2]')";
	echo "Accounting response";
//}
mysql_close($conn);
?>

