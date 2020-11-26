<?php
	include("connMysql.php");
	if(!@mysqli_select_db($db_link,"class")) die("資料庫選擇失敗");
	$sql_query = "INSERT INTO `students` (`cName`,`cSex`,`cBirthday`,`cEmail`,`cPhone`,`cAddr`) VALUE(";
	$sql_query .= "'".$_POST["cName"]."',";
	$sql_query .= "'".$_POST["cSex"]."',";
	$sql_query .= "'".$_POST["cBirthday"]."',";
	$sql_query .= "'".$_POST["cEmail"]."',";
	$sql_query .= "'".$_POST["cPhone"]."',";
	$sql_query .= "'".$_POST["cAddr"]."')";
	mysqli_query($db_link,$sql_query);
	$sql_query="SELECT * FROM students";
	$result = mysqli_query($db_link,$sql_query);
	$total_records = mysqli_num_rows($result);
	$total_pages=ceil($total_records/10);
	echo $total_pages;
?>