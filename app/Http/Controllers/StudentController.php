<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function __construct(
        protected StudentService $studentService
    ) {
    }

    /**
     * Display a listing of students.
     */
    public function index(): JsonResponse|View
    {
        $students = $this->studentService->getAllStudents();

        if (request()->wantsJson()) {
            return response()->json($students);
        }

        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create(): View
    {
        $users = $this->studentService->getAvailableUsers();

        return view('students.create', compact('users'));
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(StoreStudentRequest $request): JsonResponse|RedirectResponse
    {
        $student = $this->studentService->createStudent($request->validated());

        if ($request->wantsJson()) {
            return response()->json($student, 201);
        }

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student): JsonResponse|View
    {
        $student = $this->studentService->getStudent($student->id);

        if (request()->wantsJson()) {
            return response()->json($student);
        }

        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit(Student $student): View
    {
        $student = $this->studentService->getStudent($student->id);
        // For edit, we don't need users since user_id can't be changed
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student): JsonResponse|RedirectResponse
    {
        $student = $this->studentService->updateStudent($student->id, $request->validated());

        if ($request->wantsJson()) {
            return response()->json($student);
        }

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student): JsonResponse|RedirectResponse
    {
        $this->studentService->deleteStudent($student->id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Student deleted successfully']);
        }

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
