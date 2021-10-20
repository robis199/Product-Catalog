<?php


namespace App\Models;

class ProductCategory
{
    private int $categoryId;
    private string $name;

    public function __construct(int $categoryId, string $name)
    {
        $this->categoryId = $categoryId;
        $this->name = $name;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getName(): string
    {
        return $this->name;
    }
}