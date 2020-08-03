<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseScheduleController extends Controller
{
    //display all schedules
    public function index()
    {
        $schedules = DB::table('course_schedules')
                    ->join('courses', 'courses.id', '=', 'course_schedules.course_id')
                    ->select('courses.id', 'courses.course_code','courses.title', 'course_schedules.day','course_schedules.period','course_schedules.venue')->get();
        return response()->json($schedules, 200);
    }

    //store schedules
    public function store()
    {
        $data = request()->validate([
            'course_id'=>'required',
            'period'=>'required|string',
            'day'=>'required|string',
            'venue'=>'required|string'
        ]);
        $schedule = CourseSchedule::create($data);
        return response()->json($schedule, 201);
    }

    //show method for  schedules
    public function show(CourseSchedule $course_schedule)
    {
        return response()->json($course_schedule);
    }

    //update schedule method
    public function update(Request $request, CourseSchedule $course_schedule)
    {
        $course_schedule->update($request->all());
        return response()->json($course_schedule, 200);
    }

    //delete schedule method
    public function destroy(CourseSchedule $course_schedule)
    {
        $course_schedule->delete();
        return response()->json(null, 204);
    }
}
