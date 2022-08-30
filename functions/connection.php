<?php

define('DB_HOST','iqraa05yi.ddns.net');
define('DB_USER','PC2');
define('DB_PASSWORD','');
define('DB_NAME','ecole');


function connect()
{
    $connect = mysqli_connect(DB_HOST , DB_USER , DB_PASSWORD , DB_NAME);

    mysqli_set_charset($connect,"utf8");

    return $connect;
}

$con = connect();
?>
