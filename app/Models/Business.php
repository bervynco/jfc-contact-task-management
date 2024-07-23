<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $table = 'businesses';
    protected $fillable = [
        'name',
        'email'
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'categories_mapping');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tags_mapping');
    }

    public function people()
    {
        return $this->hasMany(People::class, 'business_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
