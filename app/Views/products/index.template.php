<?php require_once 'app/Views/partials/html.boilerplate.php';?>
<?php require_once 'app/Models/Collections/ProductsCollection.php';?>

    <body>
    <h1>Products</h1> (<a href="/products/create">Add</a>)
    <ul>
        <?php foreach ($products->getProducts() as $product): ?>
            <li>
                <a href="/products/<?php echo $product->getProductId(); ?>">
                    <?php echo $product->getModel(); ?>
                </a>
                <small>
                    (<?php echo $product->getCategory(); ?>)
                </small>
            </li>
        <?php endforeach; ?>
    </ul>
    </body>


<?php require_once 'app/Views/partials/html.closing.php';?>