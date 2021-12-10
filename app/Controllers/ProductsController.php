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
use DI\Container;
use Carbon\Carbon;
use Twig\Environment;

class ProductsController
{
    private Environment $twig;
    private ProductStorage $productStorage;
    private TagStorage $tagStorage;

    public function __construct(Container $container)
    {
        $this->productStorage = $container->get(PDOProductStorage::class);
        $this->tagStorage= $container->get(PDOTagStorage::class);
    }

    public function index(): void
    {
        $categories = $this->productStorage->getCategories()->getAll();
        $categoryId = $_GET['category'] ?? null;
        $products = $this->productStorage->getAll($_SESSION['userId'], $categoryId)->getProducts();

        require_once 'App/Views/products/index.template.php';
    }

    public function create(): void
    {
        $categories = $this->productStorage->getCategories()->getAll();
        $tags = $this->tagStorage->getTags()->allTags();

        require_once 'App/Views/products/create.template.php';
    }

    public function store()
    {
        $productTags = $_POST['tags'] ?? null;

        $product = new Product(
            Uuid::uuid4(),
            $_POST['make'],
            $_POST['model'],
            $_POST['price'],
            $this->productStorage->getCategoryById($_POST['category']),
            $_POST['created_at'],
            Carbon::now()->toDateTimeString('minute')
        );

        $this->productStorage->save($product);

        if (!is_null($productTags)) {
            $this->tagStorage->add($productTags, $product->getProductId());
        }

        Redirect::redirect("/");
    }

    public function delete(array $vars): void
    {

        $productId = $vars['product_id'] ?? null;

        if ($productId == null) Redirect::redirect("/");

        $product = $this->productStorage->getOne($productId);

        if ($product !== null) {
            $this->productStorage->delete($product);
        }
        Redirect::redirect("/");
    }

    public function update(): void
    {
        $this->productStorage->update(
            Uuid::uuid4(),
            $_POST['make'],
            $_POST['model'],
            $_POST['price'],
            $this->productStorage->getCategoryById($_POST['category']),
            Carbon::now()->toDateTimeString('minute')
        );
        Redirect::redirect("/");
        }

    public function show(array $vars)
    {
        $productId = $vars['product_id'] ?? null;

        if ($productId == null) Redirect::redirect("/");;

        $product = $this->productStorage->getOne($productId);

        if ($product === null) {
            $categories = $this->productStorage->getCategories()->getAll();
            require_once 'app/Views/Products/update.template.php';
        } else {
            Redirect::redirect("/");
        }
    }
}