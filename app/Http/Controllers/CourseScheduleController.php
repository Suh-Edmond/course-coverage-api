<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
    public function store(Request $request)
    {
        $data  = $request->all();
        $schedule_data = [
            'day' => $data['day'],
            'period' => $data['period'],
            'course_id' => $data['course_id']['value'],
            'venue' => $data['venue']
        ];
         CourseSchedule::create($schedule_data);
         $schedules = $this->index();
        return $schedules;
    }

    //update schedule method
    public function update(Request $request, CourseSchedule $course_schedule)
    {
        $course_schedule->update($request->all());
        return response()($course_schedule, 200);
    }

}
