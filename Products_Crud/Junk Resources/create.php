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
require_once "database.php";
require_once "functions.php";

$errors = [];
$title = '';
$price = '';
$description = '';
$product = [
    'image' => ''
];

#echo $_SERVER['REQUEST_METHOD'].'<br>';
if ($_SERVER['REQUEST_METHOD']==='POST') {

    require_once "validate_product.php";

if (empty($errors)){

$sub_statement = $biney->prepare("INSERT INTO products (title, image, description, price, crerate_date)
              VALUES(:title, :image, :description, :price, :date) ");
$sub_statement->bindValue(':title', $title);
$sub_statement->bindValue(':image', $imagePath);
$sub_statement->bindValue(':description', $description);
$sub_statement->bindValue(':price', $price);
$sub_statement->bindValue(':date', date('Y-m-d H:i:s'));
$sub_statement->execute();

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

<?php include_once "views/partials/header.php"; ?>
    <!--lwjhdl-->
   <!--<div class="main-body">-->
   <p>
        <a href="index.php"> Go Back to Products page</a>
    </p>

    <h1>CREATE NEW PRODUCT</h1>

    <?php include_once "views/products/form.php"; ?>

</body>
</html>