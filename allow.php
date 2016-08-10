<?php
	$conn =  mysql_connect('localhost','root','root') or die("cannot connect");
	mysql_select_db("radius_app");
	$sql=SELECT * FROM register_users WHERE user_contact='$argv[1]' and user_password='$argv[6]';
	$retval=mysql_query($sql);
	if(($row=mysql_fetch_array($retval))!=NULL)
	{
		$conn =  mysql_connect('localhost','root','root') or die("cannot connect");
		mysql_select_db("radius");
		$fetch="SELECT * FROM radphp WHERE SUBSTRING(State,1,10)=SUBSTRING('$argv[5]',1,10)";
		$result=mysql_query($fetch);
		if(($row=mysql_fetch_array($result))==NULL && $argv[5]!=NULL)
		{
				$sql="INSERT INTO radphp VALUES ('$argv[1]','$argv[2]','$argv[3]','$argv[4]','$argv[5]',ADDTIME(now(),'05:30:00'))";
				$retval=mysql_query($sql);
				echo "Accept";
		}
		mysql_close($conn);
	}
		else
				echo "Reject";
	mysql_close($conn);
?>


