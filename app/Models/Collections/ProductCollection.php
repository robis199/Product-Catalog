<?php

namespace App\Collections;

use App\Models\Product;

class ProductCollection
{
        private array $products = [];

        public function __construct(array $products = [])
        {

            foreach ($products as $product)
            {
                $this->add($product);
            }

        }

        public function add(Product $product)
        {
            $this->products[$product->getId()] = $product;
        }


    public function getProducts(): array
    {
        return $this->products;
    }

}