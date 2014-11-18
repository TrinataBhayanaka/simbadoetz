function showSpoiler(obj)
{
var inner = obj.parentNode.getElementsByTagName("div")[0];
if (inner.style.display == "none")
inner.style.display = "";
else
inner.style.display = "none";
}

content = new Array ();

content [0] = new Array (
false,
new Array('sub_1_1','sub_1_2')
);

content [1] = new Array (
false,
new Array('sub_1_1_1')
);

content [2] = new Array (
false,
new Array('sub_0_2_1')
);

content [3] = new Array (
false,
new Array('sub_3_1')
);

content [4] = new Array (
false,
new Array('sub_4_1')
);

content [5] = new Array (
false,
new Array('sub_5_3_1')
);
content [6] = new Array (
false,
new Array('sub_6_4_1')
);

content [7] = new Array (
false,
new Array('sub_7_1')
);

content [8] = new Array (
false,
new Array('sub_8_1')
);

content [9] = new Array (
false,
new Array('sub_9_1')
);

content [10] = new Array (
false,
new Array('sub_10_1')
);

content [11] = new Array (
false,
new Array('sub_11_1')
);

content [12] = new Array (
false, 							 
new Array('sub_0_1')   
);
content [13] = new Array (
false, 							 
new Array('sub_0_1_1','sub_0_1_2')   
);
content [14] = new Array (
false, 							 
new Array('sub_0_1_1_1','sub_0_1_1_2','sub_0_1_1_3')   
);

content [15] = new Array (
false, 							 
new Array('sub_0_1_2_1','sub_0_1_2_2','sub_0_1_2_3')   
);

isOPERA = (navigator.userAgent.indexOf('Opera') >= 0)? true : false;
isIE = (document.all && !isOPERA)? true : false;
isDOM = (document.getElementById && !isIE && !isOPERA)? true : false;


function processTree (id)
{
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