<?php
namespace App\Actions\Tag;

use App\Models\Tag;

class DeleteTag
{
    public function handle($id)
    {
        return Tag::where('id', $id)->delete();
    }
}