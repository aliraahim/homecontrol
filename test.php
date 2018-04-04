<?php
include 'connect.php';

$identifiers = DB::query("SELECT * FROM states");
var_dump($identifiers);

?>