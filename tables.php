<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Index Website</title>
<link rel="stylesheet" type="text/css" href="tables.css">
</head>
<form action="#" method="POST">
		<select name="pe" style="padding:5px;margin:20px;" id="pe">
			<option>Choose User...</option>
			<?php 
				require('config.php');
				$sql = "SELECT username FROM user2";
				$query = mysql_query($sql);
				while($row = mysql_fetch_assoc($query))
				{
					foreach ($row as $cell) 
					{
						echo "<option value\"".$cell."\" >".$cell."</option>";
					}
				}
			?>
		</select>
	</form>
<?php 
	require('config.php');
	echo "<h1 id=\"name\" style=\"margin-left:100px;\">Choose User...</h1>";
	if(isset($_POST['pe']))
	{	
		$result = selectDB($objConnect,$_POST['pe']);
		
	}
	if(isset($_POST['total'][1]))
	{	for($i=0;$i<5;$i++)
		if($_POST['total'][$i]>0&&$_POST['datepost'][$i]!=0&&$_POST['total'][$i]<=8)
		{    
			$found = searchDB($_POST['datepost'][$i],$_POST['pe'],$objConnect);
			//echo $found;
			if($found)
			{
				/////////++++++++++++++++++++++++++++++++++++++++++++++++++++
				$sql = "UPDATE effort SET SR='".$_POST['sr'][$i]."',Project='".$_POST['project'][$i]."',";
				$sql.= "All_leaves='".$_POST['all'][$i]."',ETC='".$_POST['etc'][$i]."',Remaining_Open_Dev='".$_POST['remain'][$i]."',Meeting='".$_POST['meeting'][$i]."',";
				$sql.= "General_Management='".$_POST['general'][$i]."',Total='".$_POST['total'][$i]."',";
				$sql.= "Comment_effort='".$_POST['comment'][$i]."',PE='".$_POST['pe']."'";
				$sql.= "WHERE date_effort='".$_POST['datepost'][$i]."' AND pe='".$_POST['pe']."'";
				//echo $sql;
				mysql_query($sql,$objConnect) or die("SQL Error");
			}
			else
			{
				/////////++++++++++++++++++++++++++++++++++++++++++++++++++++
				$sql = "INSERT INTO effort (date_effort,SR,Project,All_leaves,ETC,Remaining_Open_Dev,Meeting,General_Management,Total,Comment_effort,PE)";
				$sql.= "VALUES('".$_POST['datepost'][$i]."','".$_POST['sr'][$i]."','".$_POST['project'][$i]."','".$_POST['all'][$i]."',";
				$sql.= "'".$_POST['etc'][$i]."','".$_POST['remain'][$i]."','".$_POST['meeting'][$i]."','".$_POST['general'][$i]."','".$_POST['total'][$i]."',";
				$sql.= "'".$_POST['comment'][$i]."','".$_POST['pe']."')";
				//echo $sql;
				mysql_query($sql,$objConnect) or die("SQL error");
			}
		}
		else if($_POST['total'][$i]>8)
	     { echo("<script> alert('total over 8 hour per day can not save haha');</script>"); }
	}

	function searchDB($datepost,$pe,$objConnect)
	{
		/////////++++++++++++++++++++++++++++++++++++++++++++++++++++
		$sql = "SELECT * FROM effort WHERE date_effort='$datepost' AND PE = '$pe'";
		//echo $sql;
		$query = mysql_query($sql,$objConnect);
		$row = mysql_fetch_assoc($query);
		$found  = empty($row) ? false : true;
		return $found;
	}
	//echo var_dump($result);
	function selectDB($objConnect,$pe)
	{	$result = array();
		$sql = "SELECT * FROM effort WHERE PE='".$pe."'";
		//echo $sql;
		$query = mysql_query($sql,$objConnect)or die('Sql error');
		while ($obResult = mysql_fetch_array($query)) 
		{
			array_push($result,$obResult);
		}
		return $result;
	}

	//echo $result['0']['date'];
	//echo var_dump($result);
/*$click=0;
$arDate = generate($click);
function generate($click)
{	$arDate = array(5);
	for($i=-2;$i<=2;$i++)
	{	$inputDate = date("Y-m-d");
		$date = add_date($inputDate,$click+$i,0,0);
		$strdate = date("d-l",strtotime($date));
		array_push($arDate, $strdate);
	}
	return $arDate;
}

function add_date($givendate,$day=0,$mth=0,$yr=0)
{
	$cd = strtotime($givendate);
	$newdate = date('Y-m-d', mktime(date('h',$cd),
	date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
	date('d',$cd)+$day, date('Y',$cd)+$yr));
	return $newdate;
}*/
 ?>
<form action="#" method="POST">
<center><p><input class="submit" type="button" onclick="back();" value="<<<">      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  <input class="submit" type="button" onclick="forward();" value=">>>"></p></center>

<center>
	<span class="drag">0</span>
	<span class="drag">1</span>
	<span class="drag">2</span>
	<span class="drag">3</span>
	<span class="drag">4</span>
	<span class="drag">5</span>
	<span class="drag">6</span>
	<span class="drag">7</span>
	<span class="drag">8</span>
</center>

<table id="price-chart" cellspacing="0" cellpadding="0" align="center"> 
	<tbody>
	<tr class="even">
		<td class="left-col-captions">Activity</td>
		<td class="table-col-0" id="date1"></td>
		<td class="table-col-1" id="date2"></td>
		<td class="table-col-2" id="date3"></td>
		<td class="table-col-3" id="date4"></td>
		<td class="table-col-4" id="date5"></td>
	</tr>
 
	<tr class="odd">
		<td class="left-col-captions">SR</td>
		<td class="table-col-0"> 
			<p><textarea id="sr0" name="sr[]" value="55555" style="width:80px;height:20px;background-color:#c4e2ec;"/></textarea></p>
		</td> 
		<td class="table-col-1">
			<p><textarea id="sr1" name="sr[]" value="55555" style="width:80px;height:20px;background-color:#e9dbaa;"/></textarea></p>
		</td>
		<td class="table-col-2">
			<p><textarea id="sr2" name="sr[]" value="55555" style="width:80px;height:20px;background-color:#e9bfbf;"/></textarea></p>
		</td>
		<td class="table-col-3">
	 		<p><textarea id="sr3" name="sr[]" value="55555" style="width:80px;height:20px;background-color:#d4e0a9;"/></textarea></p>
	 	</td>
		<td class="table-col-4">
 			<p><textarea id="sr4" name="sr[]" value="55555" style="width:80px;height:20px;background-color:#d7c4ed;"/></textarea></p>
 		</td>
	</tr>
 
	<tr class="even">
		<td class="left-col-captions">Project</td>
		<td class="table-col-0">
			<p><textarea id="project0" name="project[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="project1" name="project[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-2">
			<p><textarea id="project2" name="project[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="project3" name="project[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-4">
			<p><textarea id="project4" name="project[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
	</tr>
 
	<tr class="odd">
		<td class="left-col-captions">All Leaves</td>
		<td class="table-col-0">
			<p><textarea id="all0" name="all[]" value="55555 " style="width:80px;height:20px;background-color:#c4e2ec;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="all1" name="all[]" value="55555 " style="width:80px;height:20px;background-color:#e9dbaa;"/></textarea></p>
		</td>
		<td class="table-col-2">
			<p><textarea id="all2" name="all[]" value="55555 " style="width:80px;height:20px;background-color:#e9bfbf;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="all3" name="all[]" value="55555 " style="width:80px;height:20px;background-color:#d4e0a9;"/></textarea></p>
		</td>
		<td class="table-col-4">
			<p><textarea id="all4" name="all[]" value="55555 " style="width:80px;height:20px;background-color:#d7c4ed;"/></textarea></p>
		</td>
	</tr>
 
	<tr class="even">
		<td class="left-col-captions">ETC</td>
		<td class="table-col-0">
			<p><textarea id="etc0" name="etc[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="etc1" name="etc[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td> 
		<td class="table-col-2">
			<p><textarea id="etc2" name="etc[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="etc3" name="etc[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td> 
		<td class="table-col-4">
			<p><textarea id="etc4" name="etc[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
	</tr>
 
	<tr class="odd">
		<td class="left-col-captions">Remaining,Open/Dev</td>
		<td class="table-col-0">
			<p><textarea id="remain0" name="remain[]" value="55555 " style="width:80px;height:20px;background-color:#c4e2ec;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="remain1" name="remain[]" value="55555 " style="width:80px;height:20px;background-color:#e9dbaa;"/></textarea></p>
		</td>
		<td class="table-col-2">
			<p><textarea id="remain2" name="remain[]" value="55555 " style="width:80px;height:20px;background-color:#e9bfbf;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="remain3" name="remain[]" value="55555 " style="width:80px;height:20px;background-color:#d4e0a9;"/></textarea></p>
		</td>
		<td class="table-col-4">
			<p><textarea id="remain4" name="remain[]" value="55555 " style="width:80px;height:20px;background-color:#d7c4ed;"/></textarea></p>
		</td>
	</tr>


	<tr class="even">
		<td class="left-col-captions">Meeting</td>
		<td class="table-col-0">
			<p><textarea id="meeting0" name="meeting[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="meeting1" name="meeting[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td> 
		<td class="table-col-2">
			<p><textarea id="meeting2" name="meeting[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="meeting3" name="meeting[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td> 
		<td class="table-col-4">
			<p><textarea id="meeting4" name="meeting[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
	</tr>


	<tr class="odd">
 
	<td class="left-col-captions">General Management</td>
 
	<td class="table-col-0">
			<p><textarea id="general0" name="general[]" value="55555 " style="width:80px;height:20px;background-color:#c4e2ec;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="general1" name="general[]" value="55555 " style="width:80px;height:20px;background-color:#e9dbaa;"/></textarea></p>
		</td>
		<td class="table-col-2">
			<p><textarea id="general2" name="general[]" value="55555 " style="width:80px;height:20px;background-color:#e9bfbf;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="general3" name="general[]" value="55555 " style="width:80px;height:20px;background-color:#d4e0a9;"/></textarea></p>
		</td>
		<td class="table-col-4">
			<p><textarea id="general4" name="general[]" value="55555 " style="width:80px;height:20px;background-color:#d7c4ed;"/></textarea></p>
		</td>
	</tr>


	<tr class="even" style="height:100px;font-weight:bold;">
	<td class="left-col-captions">Total</td>
	<td class="table-col-0">
			<p><textarea id="total0" name="total[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="total1" name="total[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td> 
		<td class="table-col-2">
			<p><textarea id="total2" name="total[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="total3" name="total[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td> 
		<td class="table-col-4">
			<p><textarea id="total4" name="total[]" value="" style="width:80px;height:20px;background-color:#e5e5e5;"/></textarea></p>
		</td>
 
	</tr>


	<tr class="odd">
	<td class="left-col-captions">Comment</td>
	<td class="table-col-0">
			<p><textarea id="comment0" name="comment[]" value="55555 " style="width:80px;height:20px;background-color:#c4e2ec;"/></textarea></p>
		</td>
		<td class="table-col-1">
			<p><textarea id="comment1" name="comment[]" value="55555 " style="width:80px;height:20px;background-color:#e9dbaa;"/></textarea></p>
		</td>
		<td class="table-col-2">
			<p><textarea id="comment2" name="comment[]" value="55555 " style="width:80px;height:20px;background-color:#e9bfbf;"/></textarea></p>
		</td>
		<td class="table-col-3">
			<p><textarea id="comment3" name="comment[]" value="55555 " style="width:80px;height:20px;background-color:#d4e0a9;"/></textarea></p>
		</td>
		<td class="table-col-4">
			<p><textarea id="comment4" name="comment[]" value="55555 " style="width:80px;height:20px;background-color:#d7c4ed;"/></textarea></p>
		</td>
	</tr>
	<tr class="even">
	<td class="left-col-captions">Total Week</td>
	<td class="table-col-0" id="totalweek"></td>
	<input type="hidden" name="datepost[]" id="datepost0" value="0" />
	<input type="hidden" name="datepost[]" id="datepost1" value="0" />
	<input type="hidden" name="datepost[]" id="datepost2" value="0" />
	<input type="hidden" name="datepost[]" id="datepost3" value="0" />
	<input type="hidden" name="datepost[]" id="datepost4" value="0" />
	<input type="hidden" name="pe" id="pe2" value="" />
	</tbody>
	</table>
	<center><input type="submit" value="save" class="submit"></center> 
</form>
	<script type="text/javascript"> 
	


	</script>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="tables.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.2.custom.min.js"></script>
	