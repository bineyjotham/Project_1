<?php 
$biney = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
$biney->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>