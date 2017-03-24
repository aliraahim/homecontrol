<?php

$filename = 'health.txt';
$health = array();

$health_data=file($filename);
foreach($health_data as $health_point)
{
    $health[] = $health_point;
}
if (isset($_GET['time'])){
    $health[0] = $_GET['time'];
}

$file = fopen($filename, 'w');

foreach ($health as $health_point){
    fwrite($file, $health_point);
}
fclose($file);

date_default_timezone_set("Asia/Karachi");
echo 'Last active on: ' . date("F j, Y, g:i:s a", $health[0]);

?>

