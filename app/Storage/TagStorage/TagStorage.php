<?php

namespace App\Storage\TagStorage;

use App\Models\Collections\TagsCollection;

interface TagStorage
{
    public function getTags(): TagsCollection;
    public function add(array $tags, string $productId): void;
}