<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'total_orders',
    ];

    /**
     * A single order belongs to exactly one user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
