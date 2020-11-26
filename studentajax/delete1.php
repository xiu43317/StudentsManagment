<?php
	include("connMysql.php");
	if(!@mysqli_select_db($db_link,"class")) die("資料庫選擇失敗");
	$sql_count = "SELECT * FROM `students` WHERE `cID`<".$_GET["id"];
	$number = mysqli_query($db_link,$sql_count);
	$row = mysqli_num_rows($number);
	$sql_query="SELECT * FROM students";
	$result = mysqli_query($db_link,$sql_query);
	$total_records = mysqli_num_rows($result);
//	echo $row."<br>";
//	echo $total_records."<br>";
	$page = ceil(($row+1)/10);
    $sql_query = "DELETE FROM `students` WHERE `cID`=".$_GET["id"];
	mysqli_query($db_link,$sql_query);
	if ($row+1 == $total_records && ($row+1) % 10 == 1) {
		echo ($page-1);
	}else{
		echo $page;
	}
?>