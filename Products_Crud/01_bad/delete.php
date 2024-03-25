<?php

$biney = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
$biney->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_POST['id'] ?? null;

if (!$id){
    header('Location: index.php');
    exit;
}

$statement = $biney->prepare('DELETE FROM products WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: index.php');