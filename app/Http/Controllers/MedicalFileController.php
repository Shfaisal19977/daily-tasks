<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMedicalFileRequest;
use App\Http\Requests\UpdateMedicalFileRequest;
use App\Models\MedicalFile;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class MedicalFileController extends Controller
{
    /**
     * Store a newly created medical file in storage.
     */
    public function store(StoreMedicalFileRequest $request): JsonResponse
    {
        $student = Student::findOrFail($request->validated()['student_id']);

        // Check if student already has a medical file
        if ($student->medicalFile) {
            return response()->json([
                'message' => 'This student already has a medical file. Each student can have only one medical file.',
            ], 422);
        }

        $medicalFile = MedicalFile::create($request->validated());

        return response()->json($medicalFile, 201);
    }

    /**
     * Display the specified medical file.
     */
    public function show(MedicalFile $medicalFile): JsonResponse
    {
        $medicalFile->load('student');

        return response()->json($medicalFile);
    }

    /**
     * Get medical file by student ID.
     */
    public function getByStudent(Student $student): JsonResponse
    {
        $medicalFile = $student->medicalFile;

        if (!$medicalFile) {
            return response()->json([
                'message' => 'No medical file found for this student.',
            ], 404);
        }

        return response()->json($medicalFile);
    }

    /**
     * Update the specified medical file in storage.
     */
    public function update(UpdateMedicalFileRequest $request, MedicalFile $medicalFile): JsonResponse
    {
        $medicalFile->update($request->validated());
        $medicalFile->refresh();

        return response()->json($medicalFile);
    }
}
