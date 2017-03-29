<?php
$file = fopen("test.txt", 'a');

fwrite($file, "Hello\n");

fclose($file);

?>