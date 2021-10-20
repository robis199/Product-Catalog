<?php
namespace App\Controllers;


use App\Models\Product;
use App\Models\Tag;
use App\Storage\ProductStorage\PDOProductStorage;
use App\Storage\ProductStorage\ProductStorage;
use Ramsey\Uuid\Uuid;
use App\Storage\TagStorage\PDOTagStorage;
use App\Storage\TagStorage\TagStorage;

class ProductsController
{
    private ProductStorage $productStorage;
    private TagStorage $tagStorage;

    public function __construct()
    {
        $this->productStorage = new PDOProductStorage();
        $this->tagStorage = new PDOTagStorage();

    }

    public function index()
    {
        $products = $this->productStorage->getAll();
        $tags = $this->tagStorage->getTags()->allTags();

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

            $categories = $this->ca->getAll();
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