<?php require_once 'app/Views/partials/html.boilerplate.php';?>

    <body>
    <h1>Products</h1> (<a href="/products/create">Add</a>)
    <div class="d-flex p-2">
    <ul class="list-group">
        <div class="d-flex">
        <?php foreach ($products->getProducts() as $product): ?>

            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Model-<?php echo $product->getMake(); ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><Model-<?php echo $product->getModel(); ?></h6>
                    <p class="card-text">Price-<?php echo $product->getPrice(); ?> and Type - <?php echo $product->getCategory(); ?></p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
            </div>
        <li>
            <form action="/products/<?php echo $product->getProductId() ?>/edit" method="get">
                <button type="submit" class="btn btn-secondary">Edit</button>
            </form>
        </li>
            <li>
                <form action="/products/<?php echo $product->getProductId() ?>/delete" method="post"
                      onSubmit="return confirm('Are you sure about deleting this?');">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
        </div>
    </ul>
    </body>

<?php require_once 'app/Views/partials/html.closing.php';?>