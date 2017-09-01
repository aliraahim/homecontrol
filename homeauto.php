<?php

$filename = 'gs://simplehomecontrolauto.appspot.com/settings.txt';
$settings = array();
$settings_data=file($filename);
foreach($settings_data as $index => $setting)
{
    $settings[$index] = trim($setting);
}

$googleHome = substr($settings[0], strpos($settings[0], "-") + 1);
$sms = substr($settings[1], strpos($settings[1], "-") + 1);

$takeAction = true;

if (isset($_GET['client'])){
    $client =  $_GET['client'];
    if (($client == 'googleHome') && ($googleHome != 'on')){
        $takeAction = false;
    } elseif (($client == 'SMS') && ($sms != 'on')){
        $takeAction = false;
    }
}

$filename = 'gs://simplehomecontrolauto.appspot.com/state.txt';
//$filename = 'state.txt';
$states = array();

$states_data=file($filename);
foreach($states_data as $state)
{
    $states[] = $state;
}

if (isset($_GET['switch1'])){
    $command =  $_GET['switch1'];
    if ($command != 'toggle'){
        $states[0] = $_GET['switch1'];
    }
    elseif ($command == 'toggle') {
        if ($states[0] == "on"){
            $states[0] = "off";
        } else {
            $states[0] = "on";
        }
    }
}

if (isset($_GET['message'])){
    $message = $_GET['message'];
    if ((stripos($message, 'Jugnu') !== false) && (stripos($message, 'on') !== false) && (stripos($message, 'off') === false)){
        $states[0] = 'on';
    }
    elseif ((stripos($message, 'Jugnu') !== false) && (stripos($message, 'on') === false) && (stripos($message, 'off') !== false)){
        $states[0] = 'off';
    }
    // $states[0] = $_GET['switch1'] . PHP_EOL;
}


if ($takeAction){
    $file = fopen($filename, 'w');

    foreach ($states as $index => $state){
        fwrite($file, $state);
    }
    fclose($file);
}



?>