<?php

// DBへの接続情報
define('DB_HOST','localhost');
define('DB_NAME','gyoza');
define('DB_USER','gyozauser');
define('DB_PASS','password');

// DBへ接続する関数
function db_connect()
{
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
    $db = new PDO($dsn, DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    return $db;
}