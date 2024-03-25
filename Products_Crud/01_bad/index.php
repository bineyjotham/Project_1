<?php
/*Setting the connection with the database*/
$biney = new PDO('mysql:host=localhost;port=3306;dbname=products_crud', 'root', '');
$biney->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$search = $_GET['search'] ?? '';
if ($search){
    $statement = $biney->prepare('SELECT * FROM products WHERE title LIKE :title ORDER BY crerate_date DESC');
    $statement->bindValue(':title', "%$search%");
} else {
    $statement = $biney->prepare('SELECT * FROM products ORDER BY crerate_date DESC');
}
/*$statement = $biney->prepare('SELECT * FROM products ORDER BY crerate_date DESC');*/
$statement->execute();
$product=$statement->fetchAll(PDO::FETCH_ASSOC);

/*$time = $biney->prepare('SELECT crerate_date FROM products');
$time->execute();
$minute = $time->fetchAll(PDO::FETCH_ASSOC);

echo '<pre>';
var_dump($minute);
echo '</pre>';*/

/*echo '<pre>';
var_dump($product);
echo'</pre>';
/*$doc = new DOMDocument("1.0");
$node = $doc->createElement("para");
$newnode = $doc->appendChild($node);
$newnode->setAttribute("align","left");*/

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
<div class="table1">
    <!--lwjhdl-->
   <h1>PRODUCTS CRUD</h1>
   <p>
       <a href="create.php" class="create">Create Product</a>
   </p>
   
   <form>
   <div class="search_form">
       <input type="text" class="search" placeholder="Search for products" name="search" value = "<?php echo $search?>">
       <div class="input-group-append">
           <button class="search_btn" type="submit">Search</button>
       </div>
   </div>
   </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Price</th>
                <th scope="col">Title</th>
                <th scope="col">Create Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
           <?php foreach($product as $i => $products): ?>
            <tr>
                <th scope="row"><?php echo $i + 1 ?></th>
                <td><img src="<?php echo $products['image'] ?>"></td>
                <td><?php echo $products['price'] ?></td>
                <td><?php echo $products['title'] ?></td>
                <td><?php echo $products['crerate_date'] ?></td>
                <td class="align">
                <a href="update.php?id=<?php echo $products['id'] ?>" class="edit"> Edit </a>
                <form style="display: inline-block" method = "post" action="delete.php">
                    <input type="hidden" name="id" value="<?php echo $products['id'] ?>">
                    <button type="submit" class="delete"> Delete </button>
                </form>
                </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>