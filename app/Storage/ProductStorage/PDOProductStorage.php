<?php

Namespace App\Storage\ProductStorage;

use App\Config\DatabaseConnect;
use App\Models\Collections\ProductsCollection;
use App\Models\Product;
use PDO;

class PDOProductStorage extends DatabaseConnect implements ProductStorage
{

    function getOne(string $productId): ?Product
    {
        $sql = "SELECT * FROM product_transport WHERE product_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$productId]);
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
        $statement = $this->connect()->query("SELECT * FROM product_transport");
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
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
}