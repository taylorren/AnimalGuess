<?php

require_once 'pdo.php';

$res=$cn->query('select count(id) from animal');
$r=$res->fetch();

$ret=array();
$ret['mid']=$r[0];

setExtraHeader();

echo json_encode($ret);
?>





