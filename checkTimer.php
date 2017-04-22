<?php
/**
 * Created by PhpStorm.
 * User: Raahim
 * Date: 4/22/17
 * Time: 7:39 PM
 */

$filename = 'gs://simplehomecontrolauto.appspot.com/schedule.txt';
$new_states = array();
$new_states_data=file($filename);
foreach($new_states_data as $new_state)
{
    $new_states[] = $new_state;
}

$timerSet = false;
$time = null;
$newState = null;

if ($new_states[0] > time()){
    date_default_timezone_set("Asia/Karachi");
    $new_state = explode('-',$new_states[0]);
    $timerSet = true;
    $time = date("F j, Y, g:i a", $new_state[0]);
    $newState = $new_state[1];
}

$response = ["timerSet" => $timerSet, "time" => $time, "new_state" => $newState];

echo json_encode($response);