<?php
namespace App\Actions\Category;

use App\Models\Category;

class GetCategory
{
    public function handle($id)
    {
        return Category::where('id', $id)->get();
    }
}