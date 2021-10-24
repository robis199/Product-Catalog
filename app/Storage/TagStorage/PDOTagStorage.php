<?php

namespace App\Storage\TagStorage;

use App\Config\DatabaseConnect;
use App\Models\Collections\TagsCollection;
use App\Models\Tag;
use PDO;

class PDOTagStorage extends DatabaseConnect implements TagStorage
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
                    $tag['tag_id'],
                    $tag['tag_name']
                )
            );
        }

        return $collection;
    }

    public function add(array $tags, string $productId): void
    {
        foreach ($tags as $tag)
        {
            $stmt = $this->connect()->prepare('INSERT INTO products_tags (product_id, tag_id) VALUES (?, ?)');
            $stmt->execute([$productId, $tag]);
        }
    }

    public function getTagById(string $tagId): ?Tag
    {
        $stmt = $this->connect()->prepare('SELECT * FROM tags WHERE id = :tagId LIMIT 1');
        $stmt->execute();

        $result = $stmt->fetch();

        if (empty($result)) return null;

        return new Tag(
            $result['tag_id'],
            $result['tag_name']
        );
    }

}