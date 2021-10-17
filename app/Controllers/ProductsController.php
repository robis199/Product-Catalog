<?php
namespace App\Controllers;


use App\Models\Product;
use App\Repos\PDOProductsRepo;
use App\Repos\ProductsRepo;
use Ramsey\Uuid\Uuid;

class ProductsController
{

    private Products $productsRepository;

    public function __construct()
    {
        $this->productsRepository = new PDOProductsRepo();

    }


    public function index()
    {
        $tasks = $this->productsRepository->getAll();

        require_once 'App/Views/products/index.template.php';
    }


    public function create()
    {
        require_once 'App/Views/products/create.template.php';
    }


    public function store()
    {


        $task = new Product(
            Uuid::uuid4(),
            $_POST['product'],
            Product::STATUS_STARTED
        );

        $this->productsRepository->save($product);


        header('Location: /products');
    }

    public function delete(array $vars)
    {

        $id = $vars['id'] ?? null;

        if ($id == null) header('Location: /');

        $task = $this->productsRepository->getOne($id);

        if ($task !== null) {
            $this->productsRepository->delete($task);
        }

        header('Location: /');
    }


    public function show(array $vars)
    {


        $id = $vars['id'] ?? null;

        if ($id == null) header('Location: /');

        $task = $this->productsRepository->getOne($id);

        if ($task === null) header('Location: /');

        require_once 'app/Views/products/show.template.php';
    }

}