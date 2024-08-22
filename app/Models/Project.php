<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image_url'];

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'project_feature');
    }
}
