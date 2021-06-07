<?php

$myObj = new stdClass();
$myObj->name = "John";
$myObj->age = 30;
$myObj->city = "New York";

$jsonObject = json_encode($myObj);	//

echo $jsonObject;	//send JSON object to RegisterValidation.js
?>