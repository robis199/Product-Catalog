<?php
namespace App\ProductStorage;

use App\Collections\ProductCollection;
use App\Models\Product;

interface ProductStorage
{
    public function getAll(): ProductCollection;
    public function getOne(string $id): ?Product;

    public function save(Product $product): void;
    public function delete(Product $product): void;
    //public function edit():
    //public function search
}