<?php
namespace App\Actions\Tag;

use App\Models\Tag;

class UpdateTag
{
    public function handle($tagData, $id)
    {
        return Tag::where('id', $id)->update(['name' => $tagData['name']]);
    }
}