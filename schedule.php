<?php
// $file = fopen("test.txt", 'a');

// fwrite($file, "Hello\n");

// fclose($file);

$lookBackTime = 30;
$filename = 'schedule.txt';
$schedules = array();

$schedules_data = file($filename);
foreach($schedules_data as $schedule)
{
    $temp = explode('-',$schedule);
    $schedules[] = array('time' => $temp[0],'new_status' => $temp[1]);
}

if (($schedules[0]['time'] <= time()) &&  (time() - $schedules[0]['time'] < $lookBackTime)){
    if ($schedules[0]['new_status'] == 'on'){
        $url = 'localhost/HomeAuto/homeauto.php?switch1=on';
        makeCurl($url);
    } elseif ($schedules[0]['new_status'] == 'off'){
        $url = 'localhost/HomeAuto/homeauto.php?switch1=off';
        makeCurl($url);
    }
}

function makeCurl ($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

?>