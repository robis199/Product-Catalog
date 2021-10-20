<?php

Namespace App\Storage\ProductStorage;

use App\Config\DatabaseConnect;
use App\Models\Collections\CategoryCollection;
use App\Models\Collections\ProductsCollection;
use App\Models\Product;
use App\Models\ProductCategory;
use PDO;

class PDOProductStorage extends DatabaseConnect implements ProductStorage
{

    function getOne(Product $product): ?Product
    {
        $sql = "SELECT * FROM product_transport WHERE product_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$product->getProductId()]);
        $product = $stmt->fetch();

        return new Product(
            $product['product_id'],
            $product['make'],
            $product['model'],
            $product['price'],
            $product['category'],

        );
    }

    public function getAll(array $filters = []): ProductsCollection
    {
        $stmt = $this->connect()->query("SELECT * FROM product_transport");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $collection = new ProductsCollection();

        foreach ($products as $product) {
            $collection->add(new Product(
                $product['product_id'],
                $product['make'],
                $product['model'],
                $product['price'],
                $product['category'],
            ));
        }
        return $collection;
    }

    function save(Product $product): void
    {
        $sql = "INSERT INTO product_transport (product_id, make, model, price, category, created_at) VALUES (?, ?, ?, ?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            $product->getProductId(),
            $product->getMake(),
            $product->getModel(),
            $product->getPrice(),
            $product->getCategory(),
            $product->getCreationTime()
        ]);
    }

    function delete(Product $product): void
    {
        $sql = "DELETE FROM product_transport WHERE product_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$product->getProductId()]);
    }


    public function update(string $productId, string $make, string $model, string $price, string $category, string $updated): void
    {
        $stmt = $this->connect()->query('UPDATE product_transport SET make = ?, model = ?, category = ?, 
                    price = ?, updated = ? WHERE product_id = ?');
        $stmt->execute([$productId, $make, $model, $price, $category, $updated]);
    }


    public function getCategories(): CategoryCollection
    {
        $collection = new CategoryCollection();

        $sql = 'SELECT * FROM product_category';
        $stmt = $this->connect()->prepare($sql);

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as $category) {
            $collection->add(new ProductCategory(
                $category['category_id'],
                $category['category_name']
            ));
        }

        return $collection;
    }
}