<?php
//acts on string in schedule.txt to change state
$timeMargin = 5;
$filename = 'gs://simplehomecontrolauto.appspot.com/schedule.txt';
$schedules = array();

$schedules_data = file($filename);
foreach($schedules_data as $schedule)
{
    $temp = explode('-',$schedule);
    $schedules[] = array('time' => $temp[0],'new_status' => $temp[1]);
}

if (abs($schedules[0]['time'] - time()) <= $timeMargin) {
    if ($schedules[0]['new_status'] == 'on'){
        $url = 'https://simplehomecontrolauto.appspot.com/homeauto.php?switch1=on';
        makeCurl($url);
    } elseif ($schedules[0]['new_status'] == 'off'){
        $url = 'https://simplehomecontrolauto.appspot.com/homeauto.php?switch1=off';
        makeCurl($url);
    }
}

function makeCurl ($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

?>