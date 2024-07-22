<?php
namespace App\Actions\Tag;

use App\Models\Tag;

class GetTag
{
    public function handle($id)
    {
        return Tag::where('id', $id)->get();
    }
}