<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'teacher_id',
    ];

    /**
     * A course belongs to one teacher.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * A course belongs to many students.
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'course_student')
            ->withTimestamps();
    }
}
