<?php require_once 'app/Views/partials/html.boilerplate.php' ?>

<h3 class="m-2">Add a new product to the catalog</h3>

<form class="w-25 m-4" method="post" action="/products/<?php echo $product->getProductId() ?>/edit">
    <div class="form-group m-2">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title"
               placeholder="Enter vehicle make" required value="<?php echo $product->getMake() ?>">
    </div>

    <div class="form-group m-2 col-md-6">
        <label for="category">Category</label>
        <select class="custom-select d-block" id="category" name="category">
            <option>Choose...</option>
            <?php foreach ($categories as $category): ?>
                <option <?php if ($product->getProductId() == $category->getCategoryId()): ?>
                    <?php echo "selected" ?>
                <?php endif; ?>
                        value="<?php echo $category->getCategoryId() ?>">
                    <?php echo $category->getName() ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group col-md-4 m-2">
        <label for="amount">Price</label>
        <input type="number" min="0" class="form-control" id="amount" name="amount"
               placeholder="Enter price" required value="<?php echo $product->getPrice() ?>">
    </div>
    <button type="submit" class="btn btn-success m-2">Add</button>
</form>

<?php require_once 'app/Views/partials/html.closing.php'; ?>