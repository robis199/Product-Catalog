<?php

namespace App\Storage\TagStorage;

use App\Models\Collections\TagsCollection;
use App\Models\Tag;
use App\Config\DatabaseConnect;
use PDO;

class MySqlTagsRepository extends DatabaseConnect implements TagsRepository
{


    public function getTags(): TagsCollection
    {
        $collection = new TagsCollection();
        $sql = 'SELECT * FROM tags';
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $databaseRelation = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($databaseRelation as $tag)
        {
            $collection->add(
                new Tag(
                    $tag['id'],
                    $tag['name']
                )
            );
        }

        return $collection;
    }

    public function add(array $tags, string $productId): void
    {
        foreach ($tags as $tag)
        {
            $statement = $this->pdo->prepare('INSERT INTO products_tags (product_id, tag_id) VALUES (?, ?)');
            $statement->execute([$productId, $tag]);
        }
    }
}