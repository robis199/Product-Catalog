<?php require_once 'app/Views/partials/html.boilerplate.php';?>

<body>
<h1><?php echo $product->getMake(); ?></h1>

<h4><?php echo $product->getCategory(); ?></h4>

<form action="/products/<?php echo $product->getProductId() ?>/delete" method="post"
      onSubmit="return confirm('Are you sure?');">
    <button type="submit" class="btn btn-danger">Delete</button>
</form>

(<a href="/products">Back</a>)


<?php require_once 'app/Views/partials/html.closing.php';?>