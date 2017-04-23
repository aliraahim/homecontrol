<?php
$filename = 'gs://simplehomecontrolauto.appspot.com/settings.txt';
$settings = array();
$settings_data=file($filename);
foreach($settings_data as $index => $setting)
{
    $settings[$index] = trim($setting);
}

echo json_encode($settings);