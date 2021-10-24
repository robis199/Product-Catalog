<?php
namespace App\Models;
use Carbon\Carbon;
use App\Models\Collections\TagsCollection;

class Product
{
    private string $productId;
    private string $make;
    private string $model;
    private string $price;
    private ProductCategory $category;
    private string $creationTime;
    private ?string $updated;
    private ?TagsCollection $tags;

    public function __construct(
        string $productId,
        string $make,
        string $model,
        string $price,
        ProductCategory $category,
        ?string $creationTime = null,
        ?string $updated = null,
        TagsCollection $tags = null)
    {
        $this->productId = $productId;
        $this->make = $make;
        $this->model = $model;
        $this->price = $price;
        $this->category = $category;
        $this->creationTime = $creationTime ?? Carbon::now();
        $this->updated = $updated;
        $this->tags = $tags;
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

    public function getCategory(): ProductCategory
    {
        return $this->category;
    }

    public function getCreationTime()
    {
        return $this->creationTime;
    }

    public function getUpdated(): ?string
    {
        return $this->updated;
    }

    public function getTags(): ?TagsCollection
    {
        return $this->tags;
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
            'update'=> $this->getUpdated(),
            'tag'=> $this->getTags(),
        ];
    }
}