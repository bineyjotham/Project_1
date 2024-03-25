<?php
/*Setting the connection with the database*/
/*echo '<pre>';
var_dump($_POST);
echo '</pre>';*/
/*echo '<pre>';
var_dump($_SERVER);
echo '<pre>';
exit;*/

/** @var $biney \PDO  */
$pdo = require_once "../../database.php";
require_once "../../functions.php";

$id = $_GET['id'] ?? null;

if (!$id){
    header('Location: index.php');
    exit;
}

$statement = $biney->prepare('SELECT * FROM products WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);


$errors = [];
$title = $product['title'];
$price = $product['price'];
$description = $product['description'];

#echo $_SERVER['REQUEST_METHOD'].'<br>';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once "../../validate_product.php";

 if (empty($errors)){
    

//$sub_statement = $biney->prepare("UPDATE products SET title = :title, image = :image, description = :description, price = :price");

$statement = $biney->prepare("UPDATE products SET title = :title, image = :image, description = :description, price = :price, WHERE id = :id");
$statement->bindValue(':title', $title);
$statement->bindValue(':image', $imagePath);
$statement->bindValue(':description', $description);
$statement->bindValue(':price', $price);
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: index.php');

}
}

/*function randomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    $maxVariable = strlen($characters);
    for($i = 0; $i < $n; $i++)
    {
        #$index = rand(0, strlen($characters));
        $str = $characters[random_int(0, strlen($characters))];
    }
    return $str;
}
randomString(8);*/

// function generateRandomString($length){
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $randomString = substr(str_shuffle($characters), 0, $length);
//     return $randomString;
// }
// ?>

<?php include_once "../../views/partials/header.php"; ?>
    <!--lwjhdl-->
   <!--<div class="main-body">-->
    <p>
        <a href="index.php"> Go Back to Products page</a>
    </p>
    <h1>UPDATE PRODUCT: <?php echo $product['title'] ?></h1>

    <?php include_once "../../views/products/form.php"; ?>
    
</body>
</html>