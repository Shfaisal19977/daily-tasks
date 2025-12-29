<?php

namespace App\Services;

use App\Models\Teacher;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class TeacherService
{
    /**
     * Get all teachers.
     *
     * @return Collection
     */
    public function getAllTeachers(): Collection
    {
        return Teacher::with('user', 'courses')->get();
    }

    /**
     * Get a specific teacher by ID.
     *
     * @param int $id
     * @return Teacher
     */
    public function getTeacher(int $id): Teacher
    {
        return Teacher::with('user', 'courses')->findOrFail($id);
    }

    /**
     * Create a new teacher.
     *
     * @param array $data
     * @return Teacher
     */
    public function createTeacher(array $data): Teacher
    {
        return Teacher::create($data);
    }

    /**
     * Update a teacher.
     *
     * @param int $id
     * @param array $data
     * @return Teacher
     */
    public function updateTeacher(int $id, array $data): Teacher
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update($data);
        return $teacher->fresh(['user', 'courses']);
    }

    /**
     * Delete a teacher.
     *
     * @param int $id
     * @return bool
     */
    public function deleteTeacher(int $id): bool
    {
        $teacher = Teacher::findOrFail($id);
        return $teacher->delete();
    }

    /**
     * Get all courses for a specific teacher.
     *
     * @param int $teacherId
     * @return Collection
     */
    public function getTeacherCourses(int $teacherId): Collection
    {
        $teacher = Teacher::findOrFail($teacherId);
        return $teacher->courses;
    }

    /**
     * Attach multiple courses to a teacher using createMany().
     *
     * @param int $teacherId
     * @param array $coursesData Array of course data arrays
     * @return void
     */
    public function attachCoursesToTeacher(int $teacherId, array $coursesData): void
    {
        $teacher = Teacher::findOrFail($teacherId);
        $teacher->courses()->createMany($coursesData);
    }

    /**
     * Get available users (not assigned as teacher or student) for creating new teachers.
     *
     * @return Collection
     */
    public function getAvailableUsers(): Collection
    {
        return User::whereDoesntHave('teacher')
            ->whereDoesntHave('student')
            ->get();
    }
}

