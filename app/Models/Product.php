<?php
namespace App\Models;
use Carbon\Carbon;

class Product
{
    private string $productId;
    private string $make;
    private string $model;
    private string $price;
    private string $category;
    private string $creationTime;


    public function __construct(
        string $productId,
        string $make,
        string $model,
        string $price,
        string $category,
       ?string $creationTime = null)
    {
        $this->productId = $productId;
        $this->make = $make;
        $this->model = $model;
        $this->price = $price;
        $this->category = $category;
        $this->creationTime = $creationTime ?? Carbon::now();

    }

    public function getProductId(): string
    {
        return $this->productId;
    }


    public function getMake(): string
    {
        return $this->make;
    }

    public function getModel(): string
    {
        return $this->model;
    }


    public function getPrice(): string
    {
        return $this->price;
    }


    public function getCategory(): string
    {
        return $this->category;
    }

    public function getCreationTime()
    {
        return $this->creationTime;
    }



    public function toArray(): array
    {
        return [
            'product_id'=> $this->getProductId(),
            'make'=> $this->getMake(),
            'model'=> $this->getModel(),
            'price'=> $this->getPrice(),
            'category'=> $this->getCategory(),
            'time'=> $this->getCreationTime(),
        ];
    }
}