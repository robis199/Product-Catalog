<?php require_once 'app/Views/partials/html.boilerplate.php';?>

    <body>
    <h1>Products</h1> (<a href="/products/create">Add</a>)
    <div class="d-flex p-2">
    <ul class="list-group">
        <div class="d-flex">
        <?php foreach ($products->getProducts() as $product): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center"><a href="/products/<?php echo $product->getProductId(); ?>">
                    Model-<?php echo $product->getModel(); ?>
                    Price-<?php echo $product->getPrice(); ?>
                </a>
                <span class="badge badge-primary badge-pill"><?php echo $product->getCategory(); ?></span>
            </li>

        <li>
            <form action="/products/<?php echo $product->getProductId() ?>/edit" method="get">
                <button type="submit" class="btn btn-secondary">Edit</button>
            </form>
        </li>

        <?php endforeach; ?>
        </div>
    </ul>
    </body>



<?php require_once 'app/Views/partials/html.closing.php';?>