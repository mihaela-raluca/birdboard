<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Allow mass assignment
    protected $guarded = [];

    protected $fillable = [
        'title',
        'description',
        'owner_id'
    ];

    public function path()
    {
        return "/projects/{$this->id}";
    }
}
