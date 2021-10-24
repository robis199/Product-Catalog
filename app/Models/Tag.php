<?php
namespace App\Models;

class Tag
{
    private string $tagId;
    private string $name;

    public function __construct(string $tagId, string $name)
    {
        $this->tagId = $tagId;
        $this->name = $name;
    }

    public function id(): int
    {
        return $this->tagId;
    }

    public function name(): string
    {
        return $this->name;
    }
}