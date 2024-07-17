<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMapping extends Model
{
    use HasFactory;
    protected $table = 'categories_mapping';
    
    protected $fillable = [
        'category_id',
        'business_id',
        'people_id'
    ];
}
