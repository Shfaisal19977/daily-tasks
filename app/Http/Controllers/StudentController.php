<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    /**
     * Store a newly created student in storage.
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        $student = Student::create($request->validated());

        return response()->json($student, 201);
    }

    /**
     * Display the specified student with medical file.
     */
    public function show(Student $student): JsonResponse
    {
        $student->load('medicalFile');

        return response()->json($student);
    }
}
