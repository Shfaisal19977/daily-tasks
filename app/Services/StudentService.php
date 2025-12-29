<?php

namespace App\Services;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class StudentService
{
    /**
     * Get all students.
     *
     * @return Collection
     */
    public function getAllStudents(): Collection
    {
        return Student::with('user', 'courses')->get();
    }

    /**
     * Get a specific student by ID.
     *
     * @param int $id
     * @return Student
     */
    public function getStudent(int $id): Student
    {
        $student = Student::with('user', 'courses')->findOrFail($id);
        $student->load('medicalFile');
        return $student;
    }

    /**
     * Create a new student.
     *
     * @param array $data
     * @return Student
     */
    public function createStudent(array $data): Student
    {
        return Student::create($data);
    }

    /**
     * Update a student.
     *
     * @param int $id
     * @param array $data
     * @return Student
     */
    public function updateStudent(int $id, array $data): Student
    {
        $student = Student::findOrFail($id);
        $student->update($data);
        return $student->fresh(['user', 'courses']);
    }

    /**
     * Delete a student.
     *
     * @param int $id
     * @return bool
     */
    public function deleteStudent(int $id): bool
    {
        $student = Student::findOrFail($id);
        return $student->delete();
    }

    /**
     * Get available users (not assigned as teacher or student) for creating new students.
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

