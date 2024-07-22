<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $table = 'people';
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'business_id'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_mapping');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tags_mapping');
    }
    
}
