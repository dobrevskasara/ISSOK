<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Models\Course;


use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        return response()->json($query->get(['title', 'level', 'start_date', 'seats']));
    }

    public function show(Course $course)
    {
        return response()->json($course->load('enrollments'));
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());
        return response()->json($course, 201);
    }

    public function update(StoreCourseRequest $request, Course $course)
    {
        $course->update($request->validated());
        return response()->json($course);
    }

    public function destroy(Course $course)
    {
        $hasApproved = $course->enrollments()->where('status', 'approved')->exists();

        abort_if($hasApproved, 400, 'Cannot delete course with approved enrollments.');

        $course->delete();
        return response()->json(null, 204);
    }
}
