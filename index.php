<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bulma.css">
	<style>
		h3{
			margin-left:10%;
			font-weight: bold;
		}

/*		.ui-sortable li.ui-state-default { 
		  margin: 0; 
		  height: 45px;
		  line-height: 48px;
		  font-size: 1.4em; 
		  color: #fff;
		  outline: 0;
		  padding: 0;
		  margin: 0;
		  text-indent: 15px;
		  background: rgb(78,82,91);
		  background: -moz-linear-gradient(top,  rgb(78,82,91) 0%, rgb(57,61,68) 100%);
		  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgb(78,82,91)), color-stop(100%,rgb(57,61,68)));
		  background: -webkit-linear-gradient(top,  rgb(78,82,91) 0%,rgb(57,61,68) 100%);
		  background: -o-linear-gradient(top,  rgb(78,82,91) 0%,rgb(57,61,68) 100%);
		  background: -ms-linear-gradient(top,  rgb(78,82,91) 0%,rgb(57,61,68) 100%);
		  background: linear-gradient(to bottom,  rgb(78,82,91) 0%,rgb(57,61,68) 100%);
		  border-top: 1px solid rgba(255,255,255,.2);
		  border-bottom: 1px solid rgba(0,0,0,.5);
		  text-shadow: -1px -1px 0px rgba(0,0,0,.5);
		  font-size: 1.1em;
		  position: relative;
		  cursor: pointer;
		}
		.ui-sortable li.ui-state-default:first-child {
		  border-top: 0; 
		}
		.ui-sortable li.ui-state-default:last-child {
		  border-bottom: 0;
		}*/
	</style>
</head>
<body>
	<h3>Menu Generator</h3><br>

		<div class="container">
			<div id="field" class="field is-grouped">
				<p class="control">
					<input class="input is-primary" type="text" id="menu" placeholder="Adding New Menu">
				</p>

				<button class="button is-primary" id="add">Add</button>
			</div>
			<h5>Menu Items</h5>
			<div class="content">
				<ol class="sort_list">
					<ol id="tasks"></ul>
				</ol>
			</div> 

			    <button class="button is-primary" id="save">Save</button>
			    <button class="button is-primary" id="pre">Preview</button><br><br>

			    <div id="box" class="tabs">
			    	
				</div>
		</div>
		

	<script src="js/jquery-1.5.2.min.js"></script>
	<script src="js/jquery-ui-1.10.4.min.js"></script>
	<script src="js/jquery.mjs.nestedSortable.js"></script>

	<script>

		$('.sort_list').nestedSortable({
			
			items: 'li'
		});

		if(localStorage){
		$(document).ready(function(){
			$("#save").click(function(){
				// alert("save");
			    var count = 0;
				var pages = [];
				var parentStack = [];

	            function createNewLevel(items) {
	                var length = items.length;
	                alert(length);
	                for (var i = 0; i < length; i++) {

	                    if (items[i].tagName == 'OL') {
	                    	alert("if");

	                        parentStack.push(count);
	                        createNewLevel($(items[i]).children().get());
	                        parentStack.pop();

	                    } else {
	                    	alert("else");
	                        ++count;
	                        pages.push({
	                            pId: parentStack[parentStack.length - 1],
	                            urlStr: $(items[i]).attr('id'), myId: count
	                        });
	                    }
	                }

	            }

            createNewLevel($('.sort_list ol').get());

            console.log(pages);
            localStorage.setItem("list", JSON.stringify(pages));

			 
			
			});
			$("#pre").click(function(){
			
	    		alert("preview");
	    		window.location.href = "preview.php" ;
	    		// localStorage.clear();
	    		// $("#box").html(localStorage.getItem("list"));
			});
		});
		} else{
		    alert("Sorry, your browser do not support local storage.");
		}
		

		$(document).ready(function(){
	     	$("#add").click(function(){
	     		var task= $("#menu").val();

	     		buildTask(task).appendTo("#tasks");
	     		$("#menu").val("").focus();
	     		
	     	});
	     	$("#menu").keydown(function(e){
	     		if(e. which == 13)
	     			$("#add").click();
	     	});
     	});

		function buildTask(msg){
			
     	var task=$("<span>").html(msg);
     	var del=$("<a>",{
     		href: "#"
     	}).html("&times;").click(function(){
     		$(this).parent().remove();
     	});
     	return $("<li class='ui-state-default'>").append(task).append(del);
     }

	</script>
</body>
</html>