<?php
//writes the schedule file with timestamp provided by user
$filename = 'gs://simplehomecontrolauto.appspot.com/schedule.txt';
$new_states = array();

$new_states_data=file($filename);
foreach($new_states_data as $new_state)
{
    $new_states[] = $new_state;
}


$current_time = time();
if (isset($_POST['units']) && isset($_POST['number']) && isset($_POST['new_state'])){
    if ($_POST['units'] == 'minutes'){
        $new_time = $current_time + $_POST['number']*60;
    } elseif ($_POST['units'] == 'hours') {
        $new_time = $current_time + $_POST['number']*60*60;
    }
    $action = $_POST['new_state'];
    $new_time = 60 - $new_time % 60 + $new_time;
    $new_states[0] = $new_time.'-'.$action;
}
$file = fopen($filename, 'w');

foreach ($new_states as $index => $new_state){
    fwrite($file, $new_state);
}
fclose($file);
echo json_encode($new_states[0]);
?>