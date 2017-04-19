<?php
$filename = 'gs://simplehomecontrolauto.appspot.com/health.txt';
$file = fopen($filename, 'w');
$health[0] = time();
foreach ($health as $health_point){
    fwrite($file, $health_point);
}
fclose($file);

$filename = 'gs://simplehomecontrolauto.appspot.com/state.txt';
$file = fopen($filename, 'w');
$states[0] = 'on';
foreach ($states as $index => $state){
    fwrite($file, $state);
}
fclose($file);

$filename = 'gs://simplehomecontrolauto.appspot.com/schedule.txt';
$file = fopen($filename, 'w');
$time = time();
$new_states[0] = $time . '-' . 'on';
foreach ($new_states as $index => $new_state){
    fwrite($file, $new_state);
}
fclose($file);

?>