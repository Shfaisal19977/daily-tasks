<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cover extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'book_id',
        'color',
        'format',
    ];

    /**
     * A cover belongs to one book.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
