<?php
namespace App\Controllers;


use App\Models\Product;
use App\Storage\ProductStorage\PDOProductStorage;
use App\Storage\ProductStorage\ProductStorage;
use Ramsey\Uuid\Uuid;

class ProductsController
{

    private ProductStorage $productStorage;

    public function __construct()
    {
        $this->productStorage = new PDOProductStorage();

    }

    public function index()
    {
        $products = $this->productStorage->getAll();

        require_once 'App/Views/products/index.template.php';
    }

    public function create()
    {
        require_once 'App/Views/products/create.template.php';
    }


    public function store()
    {
        $product = new Product(
            Uuid::uuid4(),
            $_POST['make'],
            $_POST['model'],
            $_POST['price'],
            $_POST['category'],
            $_POST['created_at'],
        );

        $this->productStorage->save($product);


        header('Location: /products');
    }

    public function delete(array $vars)
    {

        $productId = $vars['product_id'] ?? null;

        if ($productId == null) header('Location: /');

        $product = $this->productStorage->getOne($productId);

        if ($product !== null) {
            $this->productStorage->delete($product);
        }

        header('Location: /');
    }

    public function update(array $vars): void
    {
        $productId = $vars['id'] ?? null;


        if ($productId == null) header('Location: /');

        $product = $this->productStorage->getOne($productId);


        if ($product !== null)
        {

            $categories = $this->productStorage->getAll();
            require_once 'app/Views/Products/update.template.php';
        }
        else {
            header('Location: /');
        }
        }


    public function show(array $vars)
    {


        $productId = $vars['product_id'] ?? null;

        if ($productId == null) header('Location: /');

        $product = $this->productStorage->getOne($productId);

        if ($product === null) header('Location: /');

        require_once 'app/Views/products/show.template.php';
    }

}