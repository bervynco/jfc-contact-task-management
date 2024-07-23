<?php
namespace App\Actions\CategoryMapping;

use App\Models\CategoryMapping;

class DeleteCategoryMappingPerBusinessId
{
    public function handle($id)
    {
        return CategoryMapping::where('business_id', $id)->delete();
    }
}