<?php
namespace App\Actions\TagMapping;

use App\Models\TagMapping;

class CreateTagMapping
{
    public function handle($tagData)
    {
        return TagMapping::insert($tagData);
    }
}