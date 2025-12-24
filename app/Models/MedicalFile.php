<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalFile extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'student_id',
        'blood_type',
        'emergency_phone_number',
    ];

    /**
     * Get the student that owns the medical file.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
