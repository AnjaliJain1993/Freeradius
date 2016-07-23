
<?php
$conn =  mysql_connect('localhost','root','root') or die("cannot connect");
mysql_select_db("radius");
$user=$argv[1];
$sessionid=$argv[2];
$status=$argv[3];
$sql="select * from radphp where User_Name='$user' and Time_Stamp='2016-07-07 17:21:39'";
$retval=mysql_query($sql);
#if($row = mysql_fetch_row($retval))
#{
$unique="SELECT * FROM acctstart WHERE User_Name='$user' and Session_Id='$sessionid'";
$check=mysql_query($unique);
$row=mysql_fetch_array($check);
if($status=="Start"&& $row==NULL){
	$query="INSERT INTO acctstart VALUES ('$user','$sessionid',ADDTIME(now(),'05:30:00'))";
	$ret=mysql_query($query);
	echo "Reject";
}
else if($status=="Start"&& $row!=NULL){
// //	$query1="DELETE FROM acctstart where User_Name='$user' and Session_Id='$sessionid'";
//   //     $ret1=mysql_query($query1);
//     //   $query="INSERT INTO acctstart VALUES ('$user','$sessionid',ADDTIME(now(),'05:30:00'))";
 //      // $ret=mysql_query($query);
	$query="UPDATE acctstart SET Time_Stamp=ADDTIME(now(),'05:30:00') WHERE User_Name='$user' and Session_Id='$sessionid'";
	$ret=mysql_query($query);
        echo "Accounting response";
}
else if($status=="Stop"){
	$query="DELETE FROM acctstart where User_Name='$user' and Session_Id='$sessionid'";
	$ret=mysql_query($query);
        echo "Accounting response";
}
mysql_close($conn);
?>

