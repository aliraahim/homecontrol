<?php
// $file = fopen("test.txt", 'a');
// $line = time() . '\n';
// fwrite($file, $line);

// fclose($file);

$timeMargin = 5;
$filename = 'schedule.txt';
$schedules = array();

$schedules_data = file($filename);
foreach($schedules_data as $schedule)
{
    $temp = explode('-',$schedule);
    $schedules[] = array('time' => $temp[0],'new_status' => $temp[1]);
}

if (abs($schedules[0]['time'] - time()) <= $timeMargin) {
    if ($schedules[0]['new_status'] == 'on'){
        $url = 'http://custom-env.kcdbpksuwd.us-west-2.elasticbeanstalk.com/homeauto.php?switch1=on';
        makeCurl($url);
    } elseif ($schedules[0]['new_status'] == 'off'){
        $url = 'http://custom-env.kcdbpksuwd.us-west-2.elasticbeanstalk.com/homeauto.php?switch1=off';
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