<?php
namespace App\Actions\Tag;

use App\Models\Tag;

class GetAllTag
{
    public function handle()
    {
        return Tag::get();
    }
}