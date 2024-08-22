<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_firstname',
        'author_surname',
        'company',
        'position',
        'content',
        'rating',
        'image_url'
    ];
}
