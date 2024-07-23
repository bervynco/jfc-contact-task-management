<?php
namespace App\Actions\TagMapping;

use App\Models\TagMapping;

class DeleteTagMappingPerPeopleId
{
    public function handle($id)
    {
        return TagMapping::where('people_id', $id)->delete();
    }
}