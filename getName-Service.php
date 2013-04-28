<?php
	header("Conntent-Type: application/json");
	if(isset($_POST['username']))
	{	require('config.php');
		$sql = "SELECT PE,date_effort,SR,Project,All_leaves,ETC,Remaining_Open_Dev,Meeting,General_Management,Total,Comment_effort FROM effort WHERE PE='".$_POST['username']."'";
		//echo "$sql";
		$query = mysql_query($sql,$objConnect) or die("sql error");
		while ($row=mysql_fetch_array($query)) 
		{
			//echo var_dump($row);
			$json_data[]=array(
				"PE"=>$row['PE'],
				"date_effort"=>$row['date_effort'],
				"SR"=>$row['SR'],
				"Project"=>$row['Project'],
				"All_leaves"=>$row['All_leaves'],
				"ETC"=>$row['ETC'],
				"Remaining"=>$row['Remaining_Open_Dev'],
				"Meeting"=>$row['Meeting'],
				"General"=>$row['General_Management'],
				"Total"=>$row['Total'],
				"Comment_effort"=>$row['Comment_effort']
			);
		}
	
	$json = json_encode($json_data);
	echo $json;
	}
?>