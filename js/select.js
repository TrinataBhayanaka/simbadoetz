function nav(){
	var w = document.myform.mylist.selectedIndex;
	var url_add = document.myform.mylist.options[w].value;
	window.location.href = url_add;
		}
function showMe (it, box) { 
    var vis = (box.checked) ? "block" : "none"; 
	document.getElementById(it).style.display = vis;
			} 
