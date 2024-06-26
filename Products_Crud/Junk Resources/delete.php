<?php

/** @var $biney \PDO  */
require_once "database.php";

$id = $_POST['id'] ?? null;

if (!$id){
    header('Location: index.php');
    exit;
}

$statement = $biney->prepare('DELETE FROM products WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: index.php');