<?php

//Dutch postalcode checker
//Enough plugins to achieve this, but didn't fit my needs
//For https://www.postcode.nl/
//Just post Postalcode, housenumber and addition to this file

$postalcode   = htmlspecialchars($_POST["postalcode"]);
$housenumber  = htmlspecialchars($_POST["housenumber"]);
$addition     = htmlspecialchars($_POST["addition"]); //not needed
$publickey    = 'yourkey';
$privatekey   = 'yourkey';
$type         = 'json'; //json or array

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://api.postcode.nl/rest/addresses/'.$postalcode.'/'.$housenumber.'/'.$addition);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_USERPWD, $publickey . ":" . $privatekey);

$return_data = curl_exec($curl);
curl_close($curl);

if($type == "array"){
return json_decode($return_data, true);
}

return $return_data; //If not an array, return JSON
