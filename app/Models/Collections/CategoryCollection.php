<?php
namespace App\Models\Collections;

use App\Models\ProductCategory;

class CategoryCollection
{
    private array $categories = [];

    public function __construct(array $categories = [])
    {
        foreach ($categories as $category) $this->add($category);
    }

    public function add(ProductCategory $category): void
    {
        $this->categories[$category->getCategoryId()] = $category;
    }

    public function getAll(): array
    {
        return $this->categories;
    }
}