<?php
$debug=true;
$filename = 'gs://simplehomecontrolauto.appspot.com/state.txt';
$states = array();
$states_data=file($filename);
foreach($states_data as $state)
{
    $states[] = trim($state);
}

$currentState = $states[0];

$response = ['state' => $currentState];

echo json_encode($response);