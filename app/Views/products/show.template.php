<?php require_once 'app/Views/partials/html.boilerplate.php';?>

<body>
<h1><?php echo $product->getMake(); ?></h1>

<h4><?php echo $product->getCategory(); ?></h4>

<form method="post" action="/products/<?php echo $product->getProductId(); ?>">
    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
</form>

(<a href="/products">Back</a>)


<?php require_once 'app/Views/partials/html.closing.php';?>