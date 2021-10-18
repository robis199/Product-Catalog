<?php
namespace App\Controllers;


use App\Models\Product;
use App\ProductStorage\PDOProductStorage;
use App\ProductStorage\ProductStorage;
use Ramsey\Uuid\Uuid;

class ProductsController
{

    private ProductStorage $productsStorage;

    public function __construct()
    {
        $this->productsStorage = new PDOProductStorage();

    }


    public function index()
    {
        $tasks = $this->productsStorage->getAll();

        require_once 'App/Views/products/index.template.php';
    }


    public function create()
    {
        require_once 'App/Views/products/create.template.php';
    }


    public function store()
    {


        $product = new Product(
            $_POST['car'],
            $_POST['boat'],
            $_POST['airplane'],

        );

        $this->productsStorage->save($product);


        header('Location: /products');
    }

    public function delete(array $vars)
    {

        $id = $vars['id'] ?? null;

        if ($id == null) header('Location: /');

        $product = $this->productsStorage->getOne($id);

        if ($product !== null) {
            $this->productsStorage->delete($product);
        }

        header('Location: /');
    }


    public function show(array $vars)
    {


        $id = $vars['id'] ?? null;

        if ($id == null) header('Location: /');

        $product = $this->productsStorage->getOne($id);

        if ($product === null) header('Location: /');

        require_once 'app/Views/products/show.template.php';
    }

}