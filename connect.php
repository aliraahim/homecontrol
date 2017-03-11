<?php

require_once 'helpers/meekrodb.2.3.class.php';

if (!(getenv("DATABASE_URL")))
{
    DB::$host = 'localhost';
    DB::$user = 'root';
    DB::$password = 'confidential';
    DB::$dbName = 'LocalLeadGen';  
} else {
    $url = parse_url(getenv("DATABASE_URL"));
    DB::$host = $url["host"];
    DB::$user = $url["user"];
    DB::$password = $url["pass"];
    DB::$dbName = substr($url["path"], 1);
}


?>