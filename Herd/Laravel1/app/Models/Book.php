<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'author',
        'publication_year',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'publication_year' => 'integer',
        ];
    }
}
