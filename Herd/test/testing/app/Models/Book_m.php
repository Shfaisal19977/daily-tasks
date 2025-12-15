<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book_m extends Model
{
   protected $fillable =
   ['title',
    'author',
    'is_available',
    'published_year'];

}
