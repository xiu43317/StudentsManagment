<?php
include("connMysql.php");
if(!@mysqli_select_db($db_link,"class")) die("資料庫選擇失敗");
	$sql_query = "UPDATE `students` SET ";
	$sql_query .= "`cName`='".$_POST["cName"]."',";
	$sql_query .= "`cSex`='".$_POST["cSex"]."',";
	$sql_query .= "`cBirthday`='".$_POST["cBirthday"]."',";
	$sql_query .= "`cEmail`='".$_POST["cEmail"]."',";
	$sql_query .= "`cPhone`='".$_POST["cPhone"]."',";
	$sql_query .= "`cAddr`='".$_POST["cAddr"]."'";
	$sql_query .= "WHERE `cID`=".$_POST["cID"];
	mysqli_query($db_link,$sql_query);
	$pageRow_records = 10;
	//預設頁數
	$num_pages = $_POST["page"];
	//本頁開始記錄筆數　= (頁數-1)*每頁紀錄筆數
	$startRow_records =($num_pages-1)*$pageRow_records;
	//未加限制顯示筆數的SQL敘述句
    $sql_query="SELECT * FROM students";
	//加上限制顯示筆數的SQL敘述句　由本頁開始紀錄筆數開始
	$sql_query_limit=$sql_query." LIMIT ".$startRow_records.", ".$pageRow_records;
	//以加上限制顯示筆數的SQL敘述句查詢資料到$result
	$result = mysqli_query($db_link,$sql_query_limit);
	$show_results = "";
	while($row_result=mysqli_fetch_assoc($result)){
	$show_results .= "<tr>";
	$show_results .="<td>".$row_result["cID"]."</td>";
	$show_results .="<td>".$row_result["cName"]."</td>";
	$show_results .="<td>".$row_result["cSex"]."</td>";
	$show_results .="<td>".$row_result["cBirthday"]."</td>";
	$show_results .="<td>".$row_result["cEmail"]."</td>";
	$show_results .="<td>".$row_result["cPhone"]."</td>";
	$show_results .="<td>".$row_result["cAddr"]."</td>";
	$show_results .="<td><button onclick='update(".$row_result["cID"].")'>修改</button>";
	$show_results .="<button onclick='showalert(".$row_result["cID"].")'>刪除</button></td>";
	$show_results .="</tr>";
		}
	echo $show_results;
?>