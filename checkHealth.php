<?php
/**
 * Created by PhpStorm.
 * User: Raahim
 * Date: 4/22/17
 * Time: 6:46 PM
 */
$timeMargin = 2000000000; //seconds
$filename = 'gs://simplehomecontrolauto.appspot.com/health.txt';
$health = array();
$health_data=file($filename);
foreach($health_data as $health_point)
{
    $health[] = trim($health_point);
}
$lastSeen = time() - $health[0];
if ((time() - $health[0] < $timeMargin)){
    $success = true;
} else {
    $success = false;
}

$response = ["success" => $success, "lastSeen" => $lastSeen];

echo json_encode($response);