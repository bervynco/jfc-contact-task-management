<?php
namespace App\Actions\TagMapping;

use App\Models\TagMapping;

class DeleteTagMappingPerBusinessId
{
    public function handle($id)
    {
        return TagMapping::where('business_id', $id)->delete();
    }
}