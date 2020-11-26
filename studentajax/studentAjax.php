<?php include("page.php");?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="ajax.js"></script>
	<title>學生資料管理系統</title>
</head>
<body>
	<h1 align="center">學生資料管理系統</h1>
	<div align="center" id="total_number">目前資料筆數:<?php echo $total_records?></div>
	<table border="1" align="center">
		<tr>
			<th>姓名</th>
			<th>性別</th>
			<th>生日</th>
			<th>電子郵件</th>
			<th>電話</th>
			<th>住址</th>
		</tr>
		<tr>
			<th><input type="input" id="cName" name="cName" size="5dp"></th>
			<th><input type="radio" id="cSex" name="cSex" value="M" checked size="5dp">男
				<input type="radio" id="cSex" name="cSex" value="F">女</th>
			<th><input type="input" id="cBirthday" name="cBirthday" size="10dp"></th>
			<th><input type="input" id="cEmail" name="cEmail" size="25dp"></th>
			<th><input type="input" id="cPhone" name="cPhone" size="10dp"></th>
			<th><input type="input" id="cAddr" name="cAddr" size="25dp"></th>
		</tr>
		<tr>
			<td colspan="6" align="center">
				<input name="action" type="hidden" value="add">
				<input type="submit" name="button" id="button" value="新增資料" onclick="waitShow()">
				<input type="submit" name="button" id="button" value="重新填寫"onclick="clean()">
			</td>
		</tr>
	</table>	
	<br>
	<br>
	<table border="1" align="center" cellpadding="4" id="modify">
	<tr>
		<th>欄位</th><th>資料</th>
	</tr>
	<tr>
		<th>第幾筆</th><th><div id="count"></div></th>
	</tr>
	<tr>
		<td>姓名</td><td><input type="text" name="rName" id="rName" value=""></td>
	</tr>
	<tr>
		<td>性別</td><td>
			<input type="radio" name="Sex" id="radioM" value="M">男
			<input type="radio" name="Sex" id="radioF" value="F">女</td>

	</tr>
	<tr>
		<td>生日</td><td><input type="text" name="rBirthday" id="rBirthday" value=""></td>
	</tr>
	<tr>
		<td>電子郵件</td><td><input type="text" name="rEmail" id="rEmail" value=""></td>
	</tr>
	<tr>
		<td>電話</td><td><input type="text" name="rPhone" id="rPhone" value=""></td>
	</tr>
	<tr>
		<td>住址</td><td><input type="text" name="rAddr" id="rAddr" size="40" value=""></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
		<input type="hidden" name="cID" id="cID" value="">
		<input name="action" type="hidden" value="update">
		<input type="submit" name="button" id="button" value="更新資料"onclick="renew()">
		<input type="submit" name="button2" id="button2" value="放棄更新"onclick="hide()">	
		</td>
	</tr>
	</table>
	<table border="1" align="center" id="table">
	<tr>
	<th>項次</th>
	<th>姓名</th>
	<th>性別</th>
	<th>生日</th>
	<th>電子郵件</th>
	<th>電話</th>
	<th>住址</th>
	<th>功能</th>
	</tr>
	<?php 
	while($row_result=mysqli_fetch_assoc($result)){
	$item_start++;
	$show_results .= "<tr>";
	$show_results .="<td>".$item_start."</td>";
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
	</table>
	<table border="0" align="center" id="changepage">
	<tr>
	<?php if ($num_pages>1) { //若不是第一頁則顯示?>
		<td> <a href="studentAjax.php?page=1">第一頁</a></td>
		<td><a href="studentAjax.php?page=<?php echo $num_pages-1;?>">上一頁</a></td>
	<?php } ?>
	<?php if ($num_pages<$total_pages) { //若不是最後一頁則顯示?>
		<td><a href="studentAjax.php?page=<?php echo $num_pages+1;?>">下一頁</a></td>
		<td><a href="studentAjax.php?page=<?php echo $total_pages;?>">最後頁</a></td>
	<?php } ?>
	</tr>
	</table>
	<table align ="center" id="selectpage">
		<td>
		<select id ="current" onchange="currentPage()">
		<?php
		for ($i=0; $i < $total_pages; $i++) {
		if (($i+1) == $num_pages) {
		echo "<option value='".($i+1)."'"." SELECTED>第".($i+1)."頁</option>";
		}else{
		echo "<option value='".($i+1)."'".">第".($i+1)."頁</option>";		
		} 	
		}
		?>
		</select>
		</td>		
	</table>
</body>
</html>

