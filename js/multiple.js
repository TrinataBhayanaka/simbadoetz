$(document).ready(function() {
$('#btnAdd').click(function() {
var num		= $('.clonedInput').length;	// how many "duplicatable" input fields we currently have
var newNum	= new Number(num + 1);		// the numeric ID of the new input field being added

// create the new element via clone(), and manipulate it's ID using newNum value
var newElem = $('#input' + num).clone().attr('id', 'input' + newNum);

// manipulate the name/id values of the input inside the new element
newElem.find('#label_fn label').attr('for', 'first_name' + newNum);
newElem.find('#input_fn input').attr('id', 'first_name' + newNum).attr('name', 'first_name' + newNum).val('');
newElem.find('#label_ln label').attr('for', 'last_name' + newNum);
newElem.find('#input_ln input').attr('id', 'last_name' + newNum).attr('name', 'last_name' + newNum).val('');
newElem.find('#label_ttl label').attr('for', 'title' + newNum);
newElem.find('#select_ttl select').attr('id', 'title' + newNum).attr('name', 'title' + newNum).val('');
newElem.find('#label_cat label').attr('for', 'category' + newNum);
newElem.find('#select_cat select').attr('id', 'category' + newNum).attr('name', 'category' + newNum).val('');
newElem.find('#label_eao label').attr('for', 'email_address_officer' + newNum);
newElem.find('#input_eao input').attr('id', 'email_address_officer' + newNum).attr('name', 'email_address_officer' + newNum).val('');

// insert the new element after the last "duplicatable" input field
$('#input' + num).after(newElem);

// enable the "remove" button
$('#btnDel').attr('disabled','');

// business rule: you can only add 5 names
if (newNum == 5)
$('#btnAdd').attr('disabled','disabled');
});

$('#btnDel').click(function() {
var num	= $('.clonedInput').length;	// how many "duplicatable" input fields we currently have
$('#input' + num).remove();		// remove the last element

// enable the "add" button
$('#btnAdd').attr('disabled','');

// if only one element remains, disable the "remove" button
if (num-1 == 1)
$('#btnDel').attr('disabled','disabled');
});

$('#btnDel').attr('disabled','disabled');
});
