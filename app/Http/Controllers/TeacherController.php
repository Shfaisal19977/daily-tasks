<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Services\TeacherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Teachers',
    description: 'Teacher management endpoints (School Management System)'
)]
class TeacherController extends Controller
{
    public function __construct(
        protected TeacherService $teacherService
    ) {
    }

    #[OA\Get(
        path: '/api/teachers',
        summary: 'Get all teachers',
        tags: ['Teachers'],
        parameters: [
            new OA\Parameter(
                name: 'per_page',
                in: 'query',
                required: false,
                description: 'Number of items per page',
                schema: new OA\Schema(type: 'integer', default: 15)
            ),
            new OA\Parameter(
                name: 'page',
                in: 'query',
                required: false,
                description: 'Page number',
                schema: new OA\Schema(type: 'integer', default: 1)
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Paginated list of teachers',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Teacher')),
                        new OA\Property(property: 'current_page', type: 'integer', example: 1),
                        new OA\Property(property: 'per_page', type: 'integer', example: 15),
                        new OA\Property(property: 'total', type: 'integer', example: 100),
                        new OA\Property(property: 'last_page', type: 'integer', example: 7),
                        new OA\Property(property: 'from', type: 'integer', example: 1),
                        new OA\Property(property: 'to', type: 'integer', example: 15),
                    ]
                )
            ),
        ]
    )]
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

    #[OA\Get(
        path: '/api/teachers/{teacher}/courses',
        summary: 'Get all courses for a specific teacher',
        tags: ['Teachers'],
        parameters: [
            new OA\Parameter(
                name: 'teacher',
                in: 'path',
                required: true,
                description: 'Teacher ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'List of courses for the teacher',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Course')
                )
            ),
            new OA\Response(response: 404, description: 'Teacher not found'),
        ]
    )]
    /**
     * Get all courses for a specific teacher.
     */
    public function getCourses(Teacher $teacher): JsonResponse
    {
        $courses = $this->teacherService->getTeacherCourses($teacher->id);

        return response()->json($courses);
    }

    #[OA\Post(
        path: '/api/teachers/{teacher}/courses',
        summary: 'Attach courses to a teacher',
        description: 'Creates and attaches one or more courses to a specific teacher',
        tags: ['Teachers'],
        parameters: [
            new OA\Parameter(
                name: 'teacher',
                in: 'path',
                required: true,
                description: 'Teacher ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Courses data',
            content: new OA\JsonContent(
                ref: '#/components/schemas/AttachCoursesRequest',
                example: [
                    'courses' => [
                        ['name' => 'Mathematics 101'],
                        ['name' => 'Physics 201'],
                    ],
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Courses attached successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'Courses attached successfully'),
                    ]
                )
            ),
            new OA\Response(response: 404, description: 'Teacher not found'),
            new OA\Response(
                response: 422,
                description: 'Validation error',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'The given data was invalid.'),
                        new OA\Property(property: 'errors', type: 'object', example: ['courses' => ['The courses field is required.']]),
                    ]
                )
            ),
        ]
    )]
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

