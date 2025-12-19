<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Actions\ApproveEnrollmentAction;
use Illuminate\Http\JsonResponse;

class EnrollmentController extends Controller
{
    public function store(StoreEnrollmentRequest $request): JsonResponse
    {
        $enrollment = Enrollment::create($request->validated());
        $enrollment['status'] = 'pending';
        return response()->json($enrollment, 201);
    }

    public function approve(Enrollment $enrollment, ApproveEnrollmentAction $action): JsonResponse
    {
        $action->execute($enrollment);
        return response()->json($enrollment);
    }

    public function drop(Enrollment $enrollment): JsonResponse
    {
        abort_if($enrollment->status !== 'approved', 400, 'Only approved enrollments can be dropped');

        $enrollment->update(['status' => 'dropped']);

        return response()->json($enrollment);
    }

    public function index(): JsonResponse
    {
        return response()->json(Enrollment::with('course')->get());
    }
}
