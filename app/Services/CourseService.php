<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Collection;

class CourseService
{
    /**
     * Get all courses.
     *
     * @return Collection
     */
    public function getAllCourses(): Collection
    {
        return Course::with('teacher.user', 'students')->get();
    }

    /**
     * Get a specific course by ID.
     *
     * @param int $id
     * @return Course
     */
    public function getCourse(int $id): Course
    {
        return Course::with('teacher.user', 'students.user')->findOrFail($id);
    }

    /**
     * Create a new course.
     *
     * @param array $data
     * @return Course
     */
    public function createCourse(array $data): Course
    {
        return Course::create($data);
    }

    /**
     * Update a course.
     *
     * @param int $id
     * @param array $data
     * @return Course
     */
    public function updateCourse(int $id, array $data): Course
    {
        $course = Course::findOrFail($id);
        $course->update($data);
        return $course->fresh(['teacher.user', 'students']);
    }

    /**
     * Delete a course.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCourse(int $id): bool
    {
        $course = Course::findOrFail($id);
        return $course->delete();
    }

    /**
     * Get all students enrolled in a specific course.
     *
     * @param int $courseId
     * @return Collection
     */
    public function getStudentsInCourse(int $courseId): Collection
    {
        $course = Course::findOrFail($courseId);
        return $course->students()->with('user')->get();
    }

    /**
     * Sync students to a course (attach/detach as needed).
     *
     * @param int $courseId
     * @param array $studentIds Array of student IDs
     * @return void
     */
    public function syncStudentsInCourse(int $courseId, array $studentIds): void
    {
        $course = Course::findOrFail($courseId);
        $course->students()->sync($studentIds);
    }

    /**
     * Get all teachers with their user information for course assignment.
     *
     * @return Collection
     */
    public function getTeachersForCourse(): Collection
    {
        return Teacher::with('user')->get();
    }
}

