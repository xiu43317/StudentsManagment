	var str =
	"<tr>"+
	"<th>座號</th>"+
	"<th>姓名</th>"+
	"<th>性別</th>"+
	"<th>生日</th>"+
	"<th>電子郵件</th>"+
	"<th>電話</th>"+
	"<th>住址</th>"+
	"<th>功能</th>"+
	"</tr>";
	
	function $_xmlHttpRequest(){   
    	if(window.ActiveXObject){
        	xhttp=new ActiveXObject("Microsoft.XMLHTTP");
    	}
    	else if(window.XMLHttpRequest){
      	 	xhttp=new XMLHttpRequest();
    	}
	}
	function waitShow(){
		var name = document.getElementById("cName").value;
		var sex = document.getElementById("cSex").value;
		var birth = document.getElementById("cBirthday").value;
		var email = document.getElementById("cEmail").value;
		var phone = document.getElementById("cPhone").value;
		var addr = document.getElementById("cAddr").value;
		var message = 'cName='+name+'&cSex='+sex+'&cBirthday='+birth+'&cEmail='+email+'&cPhone='+phone+'&cAddr='+addr;
		$_xmlHttpRequest();
		xhttp.open('POST','add1.php');
		xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        xhttp.onreadystatechange=function check_user()
        {
            if(xhttp.readyState == 4)
            {
                if(xhttp.status == 200)
                {
                    var content=xhttp.responseText;              
                    total_number();
                    location.href='studentAjax.php?page='+content;
                }
            }
        }
		xhttp.send(message);
	
	}
	function showalert(x){
		if (confirm("確定要刪除")) {
			$_xmlHttpRequest();
			xhttp.open('GET','delete1.php?id='+x);
        	xhttp.onreadystatechange=function check_user()
        	{
            	if(xhttp.readyState == 4)
            	{
                	if(xhttp.status == 200)
                	{
                 	   var content=xhttp.responseText;
                  	   location.href='studentAjax.php?page='+content;
                  	   total_number();
                	}
            	}
        	}
			xhttp.send();
			alert("資料已經刪除了");
			}else{
			alert("資料並無刪除"); 
		}
	}
	function total_number(){
		$_xmlHttpRequest();
		xhttp.open("GET","total_number.php");
		xhttp.onreadystatechange = function check_user(){
			if (xhttp.readyState == 4) {
				if (xhttp.status == 200) {
					var content = xhttp.responseText;
					document.getElementById("total_number").innerHTML="目前資料筆數:"+content;

				}
			}
		}
		xhttp.send();
		
	}
	function hide(){
		document.getElementById("modify").style.display = "none";
	}
	function update(y){
		$_xmlHttpRequest();
		xhttp.open("GET","show.php?id="+y);
		xhttp.onreadystatechange = function check_user(){
			if (xhttp.readyState == 4) {
				if (xhttp.status == 200) {
					var content = xhttp.responseText;
					var obj = JSON.parse(content);
					document.getElementById("rName").value = obj.name;
					document.getElementById("rBirthday").value = obj.birth;
					if (obj.sex == "M") {
						document.getElementById("radioM").checked=true;
					}else{
						document.getElementById("radioF").checked=true;
					}
				
					document.getElementById("rEmail").value = obj.email;
					document.getElementById("rPhone").value = obj.phone;
					document.getElementById("rAddr").value = obj.addr;
					document.getElementById("cID").value = y;
					document.getElementById("count").innerHTML = obj.number;
					document.getElementById("modify").style.display = "inline";		
				}
			}
		}
		xhttp.send();
	}
	function renew(){
		var id = document.getElementById("cID").value;
		var name = document.getElementById("rName").value;
		var birth = document.getElementById("rBirthday").value;
		var sex="";
		if (document.getElementById("radioM").checked) {
			var sex = "M";
		}else if(document.getElementById("radioF").checked){
			var sex = "F";
		}	
		var email = document.getElementById("rEmail").value;
		var phone = document.getElementById("rPhone").value;
		var addr = document.getElementById("rAddr").value;
		var current = document.getElementById("current").value;
		var message = 'cID='+id+'&cName='+name+'&cSex='+sex+'&cBirthday='+birth+'&cEmail='+email+'&cPhone='+phone+'&cAddr='+addr+'&page='+current;
		$_xmlHttpRequest();
		xhttp.open("POST","update1.php");
		xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xhttp.onreadystatechange = function check_user(){
			if (xhttp.readyState == 4) {
				if (xhttp.status == 200) {
                 	   var content=xhttp.responseText;
                  	   document.getElementById("table").innerHTML=str+content;
                  	   alert("資料已更新");
                  	   hide();
				}
			}
		}
		xhttp.send(message);		
	}
	function currentPage(){
	var z = document.getElementById("current").value;
	location.href='studentAjax.php?page='+z;
	}
	function clean(){
		document.getElementById("cName").value="";
		document.getElementById("cSex").value="";
		document.getElementById("cBirthday").value="";
		document.getElementById("cEmail").value="";
		document.getElementById("cPhone").value="";
		document.getElementById("cAddr").value="";
	}