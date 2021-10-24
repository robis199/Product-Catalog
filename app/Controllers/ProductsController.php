<?php
namespace App\Controllers;

use App\Models\Product;
use App\Models\Collections\CategoryCollection;
use App\Storage\ProductStorage\PDOProductStorage;
use App\Storage\ProductStorage\ProductStorage;
use Ramsey\Uuid\Uuid;
use App\Storage\TagStorage\PDOTagStorage;
use App\Storage\TagStorage\TagStorage;
use App\Redirect;

class ProductsController
{
    private ProductStorage $productStorage;
    private TagStorage $tagStorage;
    private CategoryCollection $categoryCollection;
    private array $categories = [];

    public function __construct()
    {
        $this->productStorage = new PDOProductStorage();
        $this->tagStorage = new PDOTagStorage();
        $this->categoryCollection = $this->productStorage->getCategories();

        foreach ($this->categoryCollection->getAll() as $category) {
            $this->categories[$category->getName()] = $category->getCategoryId();
        }

    }

    public function index(): void
    {
        $categoryId = $_GET['category'] ?? null;
        $categories = $this->categoryCollection->getAll();
        $products = $this->productStorage->getAll();

        require_once 'App/Views/products/index.template.php';
    }

    public function create(): void
    {
        $categories = $this->categoryCollection->getAll();
        $tags = $this->tagStorage->getTags()->allTags();

        require_once 'App/Views/products/create.template.php';
    }

    public function store()
    {
        $categories = $this->productStorage->getCategories()->getAll();
        $tags = $this->tagStorage->getTags()->allTags();

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

    public function delete(array $vars): void
    {

        $productId = $vars['product_id'] ?? null;

        if ($productId == null) header('Location: /');

        $product = $this->productStorage->getOne($productId);

        if ($product !== null) {
            $this->productStorage->delete($product);
        }
        Redirect::redirect("/");
    }

    public function update(array $vars): void
    {
        $productId = $vars['product_id'] ?? null;

        if ($productId == null) header('Location: /');

        $product = $this->productStorage->getOne($productId);

        if ($product !== null)
        {
            $categories = $this->categoryCollection->getAll();
            require_once 'app/Views/Products/update.template.php';
        }
        else {
            Redirect::redirect("/");
        }
        }

    public function show(array $vars)
    {
        $productId = $vars['product_id'] ?? null;

        if ($productId == null) Redirect::redirect("/");;

        $product = $this->productStorage->getOne($productId);

        if ($product === null) Redirect::redirect("/");;

        require_once 'app/Views/products/show.template.php';
    }
}