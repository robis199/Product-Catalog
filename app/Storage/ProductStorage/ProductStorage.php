<?php
Namespace App\Storage\ProductStorage;

use App\Models\Collections\CategoryCollection;
use App\Models\Collections\ProductsCollection;
use App\Models\Product;
use App\Models\ProductCategory;

interface ProductStorage
{
    public function getAll(string $id, string $category): ProductsCollection;
    public function getOne(Product $product): ?Product;
    public function getCategoryById(string $categoryId): ?ProductCategory;
    public function getCategories(): CategoryCollection;
    public function save(Product $product): void;
    public function delete(Product $product): void;
    public function update(string $productId, string $make, string $model, string $price, string $category, string $updated): void;
}