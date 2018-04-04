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

$debug = false;

if ($debug) {
    if (strpos(getenv('SERVER_SOFTWARE'), 'Development') === 0) {
        DB::$user = getenv('DB_USER_LOCAL');
        DB::$password = getenv('DB_PASSWORD_LOCAL');
        DB::$dbName = getenv('DB_NAME_LOCAL');
        DB::$host = getenv('DB_HOST_LOCAL'); //defaults to localhost if omitted
        DB::$encoding = getenv('DB_ENCODING_LOCAL'); // defaults to latin1 if omitted
    } else {
        DB::$user = getenv('DB_USER');
        DB::$password = getenv('DB_PASSWORD');
        DB::$dbName = getenv('DB_NAME');
        DB::$host = getenv('DB_HOST'); //defaults to localhost if omitted
        DB::$encoding = getenv('DB_ENCODING'); // defaults to latin1 if omitted
    }
} else {
    DB::$user = getenv('DB_USER');
    DB::$password = getenv('DB_PASSWORD');
    DB::$dbName = getenv('DB_NAME');
    DB::$host = getenv('DB_HOST'); //defaults to localhost if omitted
    DB::$encoding = getenv('DB_ENCODING'); // defaults to latin1 if omitted
}

?>