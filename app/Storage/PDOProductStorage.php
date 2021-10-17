<?php

Namespace App\Storage;

use config\databaseConnect;
use App\Collections\ProductCollection;
use App\Models\Product;
use PDO;

class PDOProductStorage extends databaseConnect implements ProductStorage
{
    function getOne(string $id): ?Product
    {
        $sql = "SELECT * FROM product WHERE product_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $product = $stmt->fetch();

        return new Product(
            $product['id'],
            $product['name'],
            $product['amount'],
            $product['category']
        );
    }

    public function getAll(array $filters = []): ProductCollection
    {
        $statement = $this->connect()->query("SELECT * FROM product");
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
        $collection = new ProductCollection();

        foreach ($products as $product) {
            $collection->add(new Product(
                $product['id'],
                $product['name'],
                $product['amount'],
                $product['category']
            ));
        }
        return $collection;
    }

    function save(Product $product): void
    {
        $sql = "INSERT INTO product (product_id, name, category, amount) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            $product->getId(),
            $product->getName(),
            $product->getAmount(),
            $product->getCategory(),

        ]);
    }

    function delete(Product $product): void
    {
        $sql = "DELETE FROM product WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$product->getId()]);
    }
}