<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function __construct(
        protected CourseService $courseService
    ) {
    }

    /**
     * Display a listing of courses.
     */
    public function index(): JsonResponse|View
    {
        $courses = $this->courseService->getAllCourses();

        if (request()->wantsJson()) {
            return response()->json($courses);
        }

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create(): View
    {
        $teachers = $this->courseService->getTeachersForCourse();

        return view('courses.create', compact('teachers'));
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(StoreCourseRequest $request): JsonResponse|RedirectResponse
    {
        $course = $this->courseService->createCourse($request->validated());

        if ($request->wantsJson()) {
            return response()->json($course, 201);
        }

        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified course.
     */
    public function show(Course $course): JsonResponse|View
    {
        $course = $this->courseService->getCourse($course->id);

        if (request()->wantsJson()) {
            return response()->json($course);
        }

        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course): View
    {
        $course = $this->courseService->getCourse($course->id);
        $teachers = $this->courseService->getTeachersForCourse();

        return view('courses.edit', compact('course', 'teachers'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course): JsonResponse|RedirectResponse
    {
        $course = $this->courseService->updateCourse($course->id, $request->validated());

        if ($request->wantsJson()) {
            return response()->json($course);
        }

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course): JsonResponse|RedirectResponse
    {
        $this->courseService->deleteCourse($course->id);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Course deleted successfully']);
        }

        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }

    /**
     * Get all students enrolled in a specific course.
     */
    public function getStudents(Course $course): JsonResponse
    {
        $students = $this->courseService->getStudentsInCourse($course->id);

        return response()->json($students);
    }

    /**
     * Sync students to a course.
     */
    public function syncStudents(Course $course): JsonResponse
    {
        $data = request()->validate([
            'student_ids' => 'required|array',
            'student_ids.*' => 'required|integer|exists:students,id',
        ]);

        $this->courseService->syncStudentsInCourse($course->id, $data['student_ids']);

        return response()->json(['message' => 'Students synced successfully'], 200);
    }
}

