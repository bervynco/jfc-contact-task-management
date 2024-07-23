<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = [
        'name',
        'business_id',
        'people_id',
        'status'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
    
    public function people()
    {
        return $this->belongsTo(People::class, 'people_id');
    }
}
