<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
    ];

    /**
     * A student belongs to one user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A student belongs to many courses.
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_student')
            ->withTimestamps();
    }

    /**
     * Get the medical file for the student.
     */
    public function medicalFile(): HasOne
    {
        return $this->hasOne(MedicalFile::class);
    }
}
