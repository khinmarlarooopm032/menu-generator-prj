<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div id="box">
	
</div>
<script src="js/jquery-1.5.2.min.js"></script>
<script>
if(localStorage){
	$(document).ready(function(){
		var menu_list =  JSON.parse(localStorage.getItem("list"));
		$("#box").html(localStorage.getItem("list"));

	});
}
</script>
</body>
</html>