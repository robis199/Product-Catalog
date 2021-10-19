<?php
namespace App\Models;


class Product
{
    private string $productId;
    private string $make;
    private string $model;
    private string $price;
    private string $category;


    public function __construct(
        string $productId,
        string $make,
        string $model,
        string $price,
        string $category )
    {
        $this->productId = $productId;
        $this->make = $make;
        $this->model = $model;
        $this->price = $price;
        $this->category = $category;

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



    public function toArray(): array
    {
        return [
            'product_id'=> $this->getProductId(),
            'make'=> $this->getMake(),
            'model'=> $this->getModel(),
            'price'=> $this->getPrice(),
            'category'=> $this->getCategory(),
        ];
    }
}