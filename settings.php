<?php
$filename = 'gs://simplehomecontrolauto.appspot.com/settings.txt';
$settings = array();
$settings_data=file($filename);
foreach($settings_data as $index => $setting)
{
    $settings[$index] = trim($setting);
}

if (isset($_GET['googleHome'])){
    if ($_GET['googleHome'] == 'on' || $_GET['googleHome'] == 'off')
        $settings[0] = 'googleHome' . '-' . $_GET['googleHome'];
}

if (isset($_GET['SMS'])){
    if ($_GET['SMS'] == 'on' || $_GET['SMS'] == 'off')
        $settings[1] = 'SMS' . '-' . $_GET['SMS'];
}

$file = fopen($filename, 'w');

foreach ($settings as $index => $setting){
    fwrite($file, $setting.PHP_EOL);
}
fclose($file);

echo json_encode($settings);

?>