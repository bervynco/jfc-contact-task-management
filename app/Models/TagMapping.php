<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagMapping extends Model
{
    use HasFactory;
    protected $table = 'tags_mapping';
    protected $fillable = [
        'tag_id',
        'business_id',
        'people_id'
    ];
}
