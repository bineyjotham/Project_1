<?php if (!empty($errors)): ?>
    <div class="alert">
        <?php foreach ($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <form action="create.php" method="POST" enctype="multipart/form-data">
        <?php if ($product['image']): ?>
            <img src="../<?php echo $product['image'] ?>"> 
        <?php endif; ?>
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