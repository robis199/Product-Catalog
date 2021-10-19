<?php
Namespace App\Storage\ProductStorage;

use App\Models\Collections\ProductsCollection;
use App\Models\Product;

interface ProductStorage
{
    public function getAll(): ProductsCollection;
    public function getOne(Product $product): ?Product;

    public function save(Product $product): void;
    public function delete(Product $product): void;
    //public function edit():
    //public function search
}