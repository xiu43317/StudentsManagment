<?php
header("Content-Type:text/html;charest=utf-8");
include("connMysql.php");
$seldb = @mysqli_select_db($db_link,"class");
if(!$seldb) die("資料庫選擇失敗");
$sql_query="SELECT * FROM students";
$result = mysqli_query($db_link,$sql_query);
$total_records = mysqli_num_rows($result);
$show_results = "";
$pageRow_records = 10;
//預設頁數
$num_pages = 1;
//若有翻頁　將頁數更新
if (isset($_GET['page'])) {
	$num_pages = $_GET['page'];
}
$item_start = ($num_pages-1)*10;
//本頁開始記錄筆數　= (頁數-1)*每頁紀錄筆數
$startRow_records=($num_pages-1)*$pageRow_records;
//未加限制顯示筆數的SQL敘述句
//$sql_query="SELECT * FROM students";
//加上限制顯示筆數的SQL敘述句　由本頁開始紀錄筆數開始
$sql_query_limit=$sql_query." LIMIT ".$startRow_records.", ".$pageRow_records;
//以加上限制顯示筆數的SQL敘述句查詢資料到$result
$result = mysqli_query($db_link,$sql_query_limit);
//以未加上限制顯示筆數的SQL敘述句查詢資料到$all_result中
$all_result = mysqli_query($db_link,$sql_query);
//計算總筆數
$total_records = mysqli_num_rows($all_result);
//計算總頁數=(總筆數/每頁筆數)後無條件進位
$total_pages= ceil($total_records/$pageRow_records);
?>