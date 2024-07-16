<?php
namespace App\Actions\Tag;

use App\Models\Tag;

class CreateNewTag
{
    public function handle($tagData)
    {
        return Tag::create($tagData);
    }
}