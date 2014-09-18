/*
 * code edited by ovancop heheheeee.....
 * sat, june 23-06-2012
 */

// browser config
isOPERA = (navigator.userAgent.indexOf('Opera') >= 0)? true : false;
isIE = (document.all && !isOPERA)? true : false;
isDOM = (document.getElementById && !isIE && !isOPERA)? true : false;

// definisi array untuk menu skpd
// aturan penulisan data (index, id span, skpdID, unitID)

var menuParent = new Array(0, 0, 0);
var menuSubParent = new Array(1, 1, 0);
var menuSubSubParent = new Array(2, 1, 1);

// definisi content
content = new Array ();
content [1] = new Array (false, new Array('sub_1_2'));
content [2] = new Array (false, new Array('sub_1_2_1'));
content [3] = new Array (false, new Array('sub_3_4'));
content [4] = new Array (false, new Array('sub_3_4_5'));
content [5] = new Array (false, new Array('sub_1_5_1'));
content [6] = new Array (false, new Array('sub_1_6_2'));


function showSpoiler(obj)
{
	var inner = obj.parentNode.getElementsByTagName("div")[0];
	if (inner.style.display == "none")
		inner.style.display = "";
	else
		inner.style.display = "none";
}

function processTree (data)
{
	
	id = data;
	alert(content[id]);
	if (content [id][0])
	{
		for (i = 0; i < content [id][1].length; i++)
		hide (content [id][1][i]);
		content [id][0] = false;
		
	}
	else
	{
		for (i = 0; i < content [id][1].length; i++)
		show (content [id][1][i], 'table-row');
		
		content [id][0] = true;
		
	}
	
	return false;
}

function show (id, displayValue)
{
	if (isDOM)
		document.getElementById(id).style.display = (displayValue)? displayValue : "block";
	else if (isIE)
		document.all[id].style.display = "block";
}




function hide (id)
{
	if (isDOM)
		document.getElementById(id).style.display = "none";
	else if (isIE)
		document.all[id].style.display = "none";
}
if (isDOM || isIE)
{
	document.writeln('<style type="text/css">');
	document.writeln('.SubItemRow \{ display: none; \}');
	document.writeln('</style>');
}

function getID(input)
{
	id = input.id;
	nilai = input.value;
	
	//alert(nilai);
	document.getElementById('tes').value = id;
	document.getElementById('user_satker').value = nilai;
	
}