<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  min-width: 250px;
}

//Code Derived From: https://www.w3schools.com/howto/howto_js_todolist.asp

/* Include the padding and border in an element's total width and height */
* {
  box-sizing: border-box;
}

/* Remove margins and padding from the list */
ul {
  margin: 0;
  padding: 0;
}

/* Style the list items */
ul li {
  cursor: pointer;
  position: relative;
  padding: 12px 8px 12px 40px;
  list-style-type: none;
  background: #eee;
  font-size: 18px;
  transition: 0.2s;
  
  /* make the list items unselectable */
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Set all odd list items to a different color (zebra-stripes) */
ul li:nth-child(odd) {
  background: #f9f9f9;
}

/* Darker background-color on hover */
ul li:hover {
  background: #ddd;
}

/* When clicked on, add a background color and strike out text */
ul li.checked {
  background: #7CFC00;
  color: #000;
 font-weight: bold;
}

/* Add a "checked" mark when clicked on */
ul li.checked::before {
  content: '';
  position: absolute;
  border-color: #fff;
  border-style: solid;
  border-width: 0 2px 2px 0;
  top: 10px;
  left: 16px;
  transform: rotate(45deg);
  height: 15px;
  width: 7px;
}


</style>
</head>
<body>

<div id="myDIV" class="header">
  <h2 style="margin:5px">Fighter Selection</h2>
</div>

<ul id="myUL">
</ul>

<?php

if (!$continue)
{
	echo "Debug Exit Message";
	exit();
}
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "Default Register Message";
}

$request = array();
$request['type'] = "getFighters";
$response = $client->send_request($request);
//$response = $client->publish($request);

echo "client received response: ".PHP_EOL;
//print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;

if ($response["returnCode"] == '0')
{
        echo "Grabbed Fighters".PHP_EOL;
}
else
{
        echo "Grab Fighters Fail".PHP_EOL;
}
echo  htmlspecialchars($response);

?>

//Gets the data from the php
<script>
/*Code Derived in part from : https://stackoverflow.com/questions/23740548/how-do-i-pass-variables-and-data-from-php-to-javascript */
<div id="dom-target" style="display: none;">


var div = document.getElementById("dom-target");
var fighterList = div.textContent;

var singleFighter = '';
var indexFighter = 0;
//Loop that takes cuts every 18th Comma makes a new fighter Element with the data

for(i = 0;i =< 5; i++)
{
//singleFighter = fighterList[i].string;
singleFighter =  fighterList.replace(/([^\,]*\,){18*i}/, '');
newElement(singleFighter);
}


//Count Variable for Selection

var countery = 0;

// Add a "checked" symbol when clicking on a list item
var list = document.querySelector('ul');
list.addEventListener('click', function(ev) {
  if (ev.target.tagName === 'LI' && countery < 3 && !ev.target.classList.contains('checked')) {
    ev.target.classList.toggle('checked');
    countery++;
  }
  else if(ev.target.classList.contains('checked'))
  {
  ev.target.classList.toggle('checked');
  countery--;
  }

}, false);

//IMPORANT : When new query is done, make sure to store all checked fighters before, 
//This will allow the user to keep note of what fighters they already chosen


// Create a new list item when clicking on the "Add" button
function newElement(data) {
	
  var ul = document.getElementById("myUL");
  var li = document.createElement("li");
  li.appendChild(document.createTextNode(data));
  ul.appendChild(li);
}
</script>


</body>
</html>

