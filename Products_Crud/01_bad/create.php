<?php
/*Setting the connection with the database*/
/*echo '<pre>';
var_dump($_POST);
echo '</pre>';*/
/*echo '<pre>';
var_dump($_SERVER);
echo '<pre>';
exit;*/
$biney = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
$biney->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$errors = [];
$title = '';
$price = '';
$description = '';

#echo $_SERVER['REQUEST_METHOD'].'<br>';
if ($_SERVER['REQUEST_METHOD']==='POST') {
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$date = date('Y-m-d H:i:s');

if (!$title){
    $errors[] = 'Product title is required';
}


if (!$price){
    $errors[] = 'Product price is required';
}

if (!is_dir('images')){
    mkdir('images');
}

if (empty($errors)){
    $image = $_FILES['image'] ?? null;
    $imagePath = '';
    if ($image && $image['tmp_name']){

        $imagePath = 'images/'.generateRandomString($length = 8).'/'.$image['name'];
        mkdir(dirname($imagePath));

        /*echo '<pre>';
        var_dump($imagePath);
        echo '</pre>';
        exit;*/

        move_uploaded_file($image['tmp_name'], $imagePath);
    }

$sub_statement = $biney->prepare("INSERT INTO products (title, image, description, price, crerate_date)
              VALUES(:title, :image, :description, :price, :date) ");
$sub_statement->bindValue(':title', $title);
$sub_statement->bindValue(':image', $imagePath);
$sub_statement->bindValue(':description', $description);
$sub_statement->bindValue(':price', $price);
$sub_statement->bindValue(':date', $date);
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

function generateRandomString($length){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = substr(str_shuffle($characters), 0, $length);
    return $randomString;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Products CRUD</title>
<link rel="stylesheet" href="index.css">
</head>
<body>
    <!--lwjhdl-->
   <!--<div class="main-body">-->
    <h1>CREATE NEW PRODUCT</h1>
    <?php if (!empty($errors)): ?>
    <div class="alert">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <form action="create.php" method="POST" enctype="multipart/form-data">
    <div class="form_group">
        <label >Product Image</label><br>
        <input type="file" name="image" class="form_control"><br>
    </div>
    <div class="form_group">
        <label >Product Title</label><br>
        <input type="text" name="title" class="form-control" value="<?php echo $title; ?>"><br>
    </div>
    <div class="form_group">
        <label >Product Description</label><br>
        <textarea type="text" name="description" class="form-control1"><?php echo $description; ?></textarea><br>
    </div>
    <div class="form_group">
        <label >Product Price</label><br>
        <input type="number" step=".01" name="price" value= "<?php echo $price; ?>"class="form-control"><br>
    </div>
    <button type="submit" class="btn">Submit</button>
    </form>
</body>
</html>