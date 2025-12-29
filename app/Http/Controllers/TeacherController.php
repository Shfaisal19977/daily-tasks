<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Services\TeacherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function __construct(
        protected TeacherService $teacherService
    ) {
    }

    /**
     * Display a listing of teachers.
     */
    public function index(): JsonResponse|View
    {
        $teachers = $this->teacherService->getAllTeachers();

        if (request()->wantsJson()) {
            return response()->json($teachers);
        }

        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new teacher.
     */
    public function create(): View
    {
        $users = $this->teacherService->getAvailableUsers();

        return view('teachers.create', compact('users'));
    }

    /**
     * Store a newly created teacher in storage.
     */
    public function store(StoreTeacherRequest $request): JsonResponse|RedirectResponse
    {
        $teacher = $this->teacherService->createTeacher($request->validated());

        if ($request->wantsJson()) {
            return response()->json($teacher, 201);
        }

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher created successfully.');
    }

    /**
     * Display the specified teacher.
     */
    public function show(Teacher $teacher): JsonResponse|View
    {
        $teacher = $this->teacherService->getTeacher($teacher->id);

        if (request()->wantsJson()) {
            return response()->json($teacher);
        }

        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified teacher.
     */
    public function edit(Teacher $teacher): View
    {
        $teacher = $this->teacherService->getTeacher($teacher->id);
        // For edit, we don't need users since user_id can't be changed
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified teacher in storage.
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher): JsonResponse|RedirectResponse
    {
        $teacher = $this->teacherService->updateTeacher($teacher->id, $request->validated());

        if ($request->wantsJson()) {
            return response()->json($teacher);
        }

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    /**
     * Remove the specified teacher from storage.
     */
    public function destroy(Teacher $teacher): JsonResponse|RedirectResponse
    {
        $this->teacherService->deleteTeacher($teacher->id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Teacher deleted successfully']);
        }

        return redirect()->route('teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }

    /**
     * Get all courses for a specific teacher.
     */
    public function getCourses(Teacher $teacher): JsonResponse
    {
        $courses = $this->teacherService->getTeacherCourses($teacher->id);

        return response()->json($courses);
    }

    /**
     * Attach courses to a teacher.
     */
    public function attachCourses(Teacher $teacher): JsonResponse
    {
        $coursesData = request()->validate([
            'courses' => 'required|array',
            'courses.*.name' => 'required|string',
        ]);

        $this->teacherService->attachCoursesToTeacher($teacher->id, $coursesData['courses']);

        return response()->json(['message' => 'Courses attached successfully'], 201);
    }
}

