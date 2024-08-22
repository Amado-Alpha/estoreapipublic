<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
   
    use HasFactory;

    protected $fillable = ['description'];

    
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_feature');
    }
}
