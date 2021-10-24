<?php require_once 'app/Views/partials/html.boilerplate.php' ?>

    <h3 class="m-2">Add a new product to the catalog</h3>

    <form class="w-25 m-4" method="post" action="/products/<?php echo $product->getId() ?>/edit">
        <div class="form-group m-2">
            <label for="title">Model</label>
            <input type="text" class="form-control" id="title" name="title"
                   placeholder="Enter model" required value="<?php echo $product->getModel() ?>">
        </div>

        <div class="form-group m-2 col-md-6">
            <label for="category">Update a Category</label>
            <select class="custom-select d-block" id="category" name="category">
                <option>Choose a car, a plane or a boat</option>
                <?php foreach ($categories as $category): ?>
                    <option <?php if ($product->getCategory()->getProductId() == $category->getCategoryId()): ?>
                        <?php echo "you have picked -" ?>
                    <?php endif; ?>
                            value="<?php echo $category->getCategoryId() ?>">
                        <?php echo $category->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group col-md-4 m-2">
            <label for="amount">Price</label>
            <input type="number" min="0" class="form-control" id="price" name="price"
                   placeholder="Enter price" required value="<?php echo $product->getPrice() ?>">
        </div>
        <button type="submit" class="btn btn-success m-2">Update</button>
    </form>
<?php require_once 'app/Views/partials/html.closing.php'; ?>