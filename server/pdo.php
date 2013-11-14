<?php

$dbms = 'mysql';

$host = 'localhost';
$db = 'rsywx';
$user = 'root';
$pass = 'tr0210';
$dsn = "$dbms:host=$host;dbname=$db";

$cn = new PDO($dsn, $user, $pass);

function setExtraHeader()
{
    header('Access-Control-Allow-Origin: *,');
    header('Access-Control-Allow-Methods: GET');
    header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
    header('Content-Type: text/plain');
}

?>