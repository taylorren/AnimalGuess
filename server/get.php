<?php

require_once 'pdo.php';

$id=filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if(!$id)
    $id=1;

$res=$cn->prepare('select * from animal where id = :id');
$res->bindParam(':id', $id);
$res->execute();
        
$r=$res->fetch();

$ret=array();
$ret['q']=$r[1];
$ret['y']=$r[2];
$ret['n']=$r[3];

setExtraHeader();

echo json_encode($ret);
?>





