
<?php require_once 'app/Views/partials/html.boilerplate.php'; ?>


<a href = "/products">Return</a>
<br/>

<h1>Yes, our products come in the form of an automobile, airplane or boat.</h1>
<h2>Add a transportation unit to our super safe database</h2>
<br>
<form action="/products" method="post" class="row g-3">
  <div class="col-auto">
    <label for="make" class="visually-hidden">Make</label>
    <input type="text" name="make" class="form-control-plaintext" id="make" placeholder="make">
  </div>
  <div class="col-auto">
    <label for="model" class="visually-hidden">Model</label>
    <input type="text" name="model" class="form-control" id="model" placeholder="model">
  </div>
    <div class="col-auto">
        <label for="price" class="visually-hidden">Price</label>
        <input type="text" name="price" class="form-control" id="price" placeholder="price">
    </div>
    <br>

    <div class="form-check">
        <input class="category" name="category" type="checkbox" value="car" id="category">
        <label class="category" for="car">
            Car
        </label>
    </div>

    <div class="form-check">
        <input class="category" name="category" type="checkbox" value="boat" id="category">
        <label class="category" for="boat">
            Boat
        </label>
    </div>

    <div class="form-check">
        <input class="category" name="category" type="checkbox" value="airplane" id="category">
        <label class="category" for="airplane">
            Airplane
        </label>
    </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Confirm</button>
  </div>
</form>
</div>


<div class="form-group m-2 col-md-6">
    <label for="category">Category</label>
    <select class="custom-select d-block" id="category" name="category">
        <option selected>Choose...</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category->getCategoryId() ?>">
                <?php echo $category->getName() ?></option>
        <?php endforeach; ?>
    </select>
</div>

<?php require_once 'app/Views/partials/html.closing.php'; ?>