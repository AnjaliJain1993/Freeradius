<?php
$conn =  mysql_connect('localhost','root','root') or die("cannot connect");
mysql_select_db("radius_app");
$user=$argv[1];
$sessionid=$argv[2];
$status=$argv[3];
$input_octets=$argv[4];
$output_octets=$argv[5];
$i="";
#$sql="select * from radphp where User_Name='$user' and Time_Stamp='2016-07-07 17:21:39'";
//$retval=mysql_query($sql);
#if($row = mysql_fetch_row($retval))
#{
$unique="SELECT * FROM acctstart WHERE User_Name='$user' and Session_Id='$sessionid'";
$check=mysql_query($unique);
$row=mysql_fetch_array($check);
if($status=="Start"&& $row==NULL){
        $query="INSERT INTO acctstart VALUES ('$user','$sessionid',ADDTIME(now(),'05:30:00'),$input_octets,$output_octets)";
        $ret=mysql_query($query);
        $i="Reply-Message:=\"start\"";
}
else if($status=="Interim-Update"&& $row!=NULL){
        $query="UPDATE acctstart SET Time_Stamp=ADDTIME(now(),'05:30:00'),Input_Octets=Input_Octets-$input_octets,Output_Octets=Output_Octets-$output_octets WHERE User_Name='$user' and Session_Id='$sessionid'";
        $ret=mysql_query($query);
	$query="SELECT Input_Octets,Output_Octets from acctstart where User_Name='$user' and Session_Id='$sessionid'";
        $ret=mysql_query($query);
	$row=mysql_fetch_array($ret);
	$in=$row[0];
	$out=$row[1];
	if($in<0 || $out<0)
		$i="Reply-Message:=\"disconnect\"";
	else 
		$i="Reply-Message:=\"update\"";
}
else if($status=="Stop" && $row!=NULL){
        $query="DELETE FROM acctstart where User_Name='$user' and Session_Id='$sessionid'";
        $ret=mysql_query($query);
        $i="Reply-Message:=\"stop\"";
}
//$i="Reply-Message:=\"hello\"";
echo $i;
mysql_close($conn);
?>


