<?php

namespace App\Storage\TagStorage;

use App\Models\Collections\TagsCollection;

interface TagsRepository
{
    public function getTags(): TagsCollection;
    public function add(array $tags, string $productId): void;
}