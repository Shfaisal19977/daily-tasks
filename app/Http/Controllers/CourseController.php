<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Courses',
    description: 'Course management endpoints (School Management System)'
)]
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

    #[OA\Get(
        path: '/api/courses/{course}/students',
        summary: 'Get all students enrolled in a specific course',
        tags: ['Courses'],
        parameters: [
            new OA\Parameter(
                name: 'course',
                in: 'path',
                required: true,
                description: 'Course ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of students enrolled in the course',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Student')
                )
            ),
            new OA\Response(response: 404, description: 'Course not found'),
        ]
    )]
    /**
     * Get all students enrolled in a specific course.
     */
    public function getStudents(Course $course): JsonResponse
    {
        $students = $this->courseService->getStudentsInCourse($course->id);

        return response()->json($students);
    }

    #[OA\Post(
        path: '/api/courses/{course}/students/sync',
        summary: 'Sync students to a course',
        description: 'Synchronizes the list of students enrolled in a course. This will replace the existing student list with the provided one.',
        tags: ['Courses'],
        parameters: [
            new OA\Parameter(
                name: 'course',
                in: 'path',
                required: true,
                description: 'Course ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Student IDs to sync',
            content: new OA\JsonContent(
                ref: '#/components/schemas/SyncStudentsRequest',
                example: [
                    'student_ids' => [1, 2, 3],
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Students synced successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Students synced successfully'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Course not found'),
            new OA\Response(
                response: 422,
                description: 'Validation error',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'The given data was invalid.'),
                        new OA\Property(property: 'errors', type: 'object', example: ['student_ids' => ['The student ids field is required.']]),
                    ]
                )
            ),
        ]
    )]
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

