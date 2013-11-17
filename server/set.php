<?php

require_once 'pdo.php';

//Get the input parameters
$id=filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$q=filter_input(INPUT_GET, 'q');
$yanimal=filter_input(INPUT_GET,'animal1');
$nanimal=filter_input(INPUT_GET,'animal2');

//Get the max id
$res = $cn->query('select count(id) from animal');
$r = $res->fetch();

$ret = array();
$mid = $r[0];
$ybranch=$mid+1;
$nbranch=$mid+2;

//Create the y branch animal
$res=$cn->prepare('insert into animal values(:id, :q, -1, -1)');
$res->bindParam(':id', $ybranch);
$res->bindParam(':q', $yanimal);
$res->execute();

//Create the n branch animal
$res=$cn->prepare('insert into animal values(:id, :q, -1, -1)');
$res->bindParam(':id', $nbranch);
$res->bindParam(':q', $nanimal);
$res->execute();

//Split the current node
$res=$cn->prepare('update animal set question=:q, y_branch=:y, n_branch=:n where id=:id');
$res->bindParam(':id', $id);
$res->bindParam(':q', $q);
$res->bindParam(':y', $ybranch);
$res->bindParam(':n', $nbranch);
$res->execute();

setExtraHeader();
echo json_encode($mid+2);
?>





