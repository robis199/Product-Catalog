<?php

namespace App\Storage\ProductStorage;

use App\Config\DatabaseConnect;
use App\Models\Collections\CategoryCollection;
use App\Models\Collections\ProductsCollection;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Storage\TagStorage\PDOTagStorage;
use PDO;

class PDOProductStorage extends DatabaseConnect implements ProductStorage
{
    private PDOTagStorage $tagsStorage;

    public function __construct()
    {
        $this->tagsStorage = new PDOTagStorage();
    }

    public function getAll(string $id, string $category): ProductsCollection
    {
        {
            $collection = new ProductsCollection();

            if (empty($category)) {
                $stmt = $this->connect()->prepare('SELECT * FROM product_transport WHERE id = ? ORDER BY created_at DESC');
            } else {
                $stmt = $this->connect()->prepare('SELECT * FROM product_transport WHERE id = ? AND category = ? ORDER BY created_at DESC');
            }

            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($data as $product) {
                $tags = $this->tagsStorage->productTag($product['product_id']);

                $collection->add(new Product(
                    $product['product_id'],
                    $product['make'],
                    $product['model'],
                    $product['price'],
                    $this->getCategoryById($product['category']),
                    $product['created_at'],
                    $product['updated'],
                    $tags
                ));
            }
            return $collection;
        }
    }

    public function save(Product $product): void
    {
        $sql = 'INSERT INTO product_transport (product_id, make, model, price, category, created_at, updated) VALUES (?, ?, ?, ?,?,?,?)';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            $product->getProductId(),
            $product->getMake(),
            $product->getModel(),
            $product->getPrice(),
            $product->getCategory(),
            $product->getCreationTime(),
            $product->getUpdated()
        ]);
    }

    public function delete(Product $product): void
    {
        $sql = 'DELETE FROM product_transport WHERE product_id = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$product->getProductId()]);
    }

    public function update(string $productId, string $make, string $model, string $price, string $category, string $updated): void
    {
        $stmt = $this->connect()->query('UPDATE product_transport SET make = ?, model = ?, category = ?, price = ?, updated = ? WHERE product_id = ?');
        $stmt->execute([$productId, $make, $model, $price, $category, $updated]);
    }

    public function getCategories(): CategoryCollection
    {
        $collection = new CategoryCollection();

        $sql = 'SELECT * FROM product_category';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($categories as $category) {
            $collection->add(new ProductCategory(
                $category['category_id'],
                $category['category_name']
            ));
        }

        return $collection;
    }

    public function getCategoryById(string $categoryId): ?ProductCategory
    {
        $sql = 'SELECT * FROM product_category WHERE category_id = ?';
        $statement = $this->connect()->prepare($sql);
        $statement->execute([$categoryId]);

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) return null;

        return new ProductCategory(
            $result['category_id'],
            $result['category_name']
        );
    }

    function getOne(Product $product): ?Product
    {
        $sql = 'SELECT * FROM product_transport WHERE product_id = ?';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$product->getProductId()]);
        $product = $stmt->fetch();

        return new Product(
            $product['product_id'],
            $product['make'],
            $product['model'],
            $product['price'],
            $this->getCategoryById($product['category']),
            $product['created_at'],
            $product['updated'],
        );
    }
}