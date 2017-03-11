<?php

$filename = 'state.txt';
$states = array();

$states_data=file($filename);
foreach($states_data as $state)
{
    $states[] = $state;
}

if (isset($_GET['switch1'])){
    $command =  $_GET['switch1'];
    if ($command != "toggle"){
        $states[0] = $_GET['switch1'];
    }
    elseif ($command == "toggle") {
        if ($states[0] == "on"){
            $states[0] = "off";
        } else {
            $states[0] = "on";
        }
    }
    // $states[0] = $_GET['switch1'] . PHP_EOL;
}

if (isset($_GET['message'])){
    $message = $_GET['message'];
    if ((stripos($message, 'Chotu') !== false) && (stripos($message, 'on') !== false) && (stripos($message, 'off') === false)){
        $states[0] = 'on';
    }
    elseif ((stripos($message, 'Chotu') !== false) && (stripos($message, 'on') === false) && (stripos($message, 'off') !== false)){
        $states[0] = 'off';
    }
    // $states[0] = $_GET['switch1'] . PHP_EOL;
}



$file = fopen($filename, 'w');

foreach ($states as $index => $state){
    fwrite($file, $state);
}
fclose($file);

?>