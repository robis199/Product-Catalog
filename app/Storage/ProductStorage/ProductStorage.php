<?php
Namespace App\Storage\ProductStorage;

use App\Models\Collections\CategoryCollection;
use App\Models\Collections\ProductsCollection;
use App\Models\Product;

interface ProductStorage
{
    public function getAll(): ProductsCollection;
    public function getOne(Product $product): ?Product;
    public function getCategories(): CategoryCollection;
    public function save(Product $product): void;
    public function delete(Product $product): void;
    public function update(string $productId, string $make, string $model, string $price, string $category, string $updated): void;

}