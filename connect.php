<?php

require_once 'helpers/meekrodb.2.3.class.php';

if (!(getenv("amazon")))
{
    DB::$host = 'localhost';
    DB::$user = 'root';
    DB::$password = 'confidential';
    DB::$dbName = 'HomeAuto';  
} else {
    $url = parse_url(getenv("DATABASE_URL"));
    DB::$host = 'aa1ddbvkbc8llo3.cbqsmthb1xxp.us-west-2.rds.amazo.com:3306';
    DB::$user = 'homeauto';
    DB::$password = 'homeautodbpassword';
    DB::$dbName = 'HomeAuto';
}

?>