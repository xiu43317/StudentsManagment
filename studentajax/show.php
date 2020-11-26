<?php
include("connMysql.php");
if(!@mysqli_select_db($db_link,"class")) die("資料庫選擇失敗");
$sql_db = "SELECT * FROM `students` WHERE `cID`=".$_GET["id"];
$result = mysqli_query($db_link,$sql_db);
$row_result = mysqli_fetch_assoc($result);
$sql_count = "SELECT * FROM `students` WHERE `cID`<".$_GET["id"];
$number = mysqli_query($db_link,$sql_count);
$row = mysqli_num_rows($number);
$data_array = [
 "name" => $row_result["cName"],
 "sex" => $row_result["cSex"],
 "birth" => $row_result["cBirthday"],
 "email" => $row_result["cEmail"],
 "phone" => $row_result["cPhone"],
 "addr" => $row_result["cAddr"],
 "number" => $row+1, 
];

// 先利用urlencode讓陣列中沒有中文
foreach($data_array as $key => $value){
 $new_data_array[urlencode($key)] = urlencode($value);
}

// 利用json_encode將資料轉成JSON格式
$data_json_url = json_encode($new_data_array);

// 利用urldecode將資料轉回中文

$data_json = urldecode($data_json_url);
echo $data_json;
?>