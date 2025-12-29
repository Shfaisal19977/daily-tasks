<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

#[OA\Tag(
    name: 'Students',
    description: 'Student management endpoints (School Management System)'
)]
class StudentController extends Controller
{
    public function __construct(
        protected StudentService $studentService
    ) {
    }

    #[OA\Get(
        path: '/api/students',
        summary: 'Get all students',
        tags: ['Students'],
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
                description: 'Paginated list of students',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'data', type: 'array', items: new OA\Items(ref: '#/components/schemas/Student')),
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

    #[OA\Post(
        path: '/api/students',
        summary: 'Create a new student',
        description: 'Creates a new student profile associated with a user. The user must not already be associated with a teacher or student.',
        tags: ['Students'],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Student data',
            content: new OA\JsonContent(
                ref: '#/components/schemas/StoreStudentRequest',
                example: [
                    'user_id' => 1,
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Student created successfully',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Student',
                    example: [
                        'id' => 1,
                        'user_id' => 1,
                        'user' => [
                            'id' => 1,
                            'name' => 'John Doe',
                            'email' => 'john@example.com',
                        ],
                        'created_at' => '2025-01-02T00:00:00.000000Z',
                        'updated_at' => '2025-01-02T00:00:00.000000Z',
                    ]
                )
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property: 'message', type: 'string', example: 'The user id field is required.'),
                        new OA\Property(property: 'errors', type: 'object', example: ['user_id' => ['The user id field is required.']]),
                    ]
                )
            ),
        ]
    )]
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

    #[OA\Get(
        path: '/api/students/{student}',
        summary: 'Get a specific student',
        description: 'Retrieves a student by ID, including associated user and medical file information',
        tags: ['Students'],
        parameters: [
            new OA\Parameter(
                name: 'student',
                in: 'path',
                required: true,
                description: 'Student ID',
                schema: new OA\Schema(type: 'integer')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Student details',
                content: new OA\JsonContent(ref: '#/components/schemas/Student')
            ),
            new OA\Response(response: 404, description: 'Student not found'),
        ]
    )]
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
