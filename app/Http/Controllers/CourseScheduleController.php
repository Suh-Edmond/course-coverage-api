<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseSchedule;
use App\Lecturer;
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
                    ->select( 'courses.course_code', 'course_schedules.day', 'course_schedules.period', 'course_schedules.venue')
                    ->orderBy('course_schedules.created_at', 'desc')
                    ->get();
        return response()->json(['data'=>$schedules, 'status'=>200]);
    }
    //display schedule by lecturer's course
    public function getCourseSchedulesByLecturer()
    {
        //$lect_id = Auth::user()->id
        $lect_id =21; //will have to get the lecturer's id
        $schedules =DB::table('course_schedules')
                        ->join('courses', 'courses.id', '=', 'course_schedules.course_id')
                        ->join('teaches', 'courses.id', '=', 'teaches.course_id')
                        ->join('users', 'users.id', '=', 'teaches.user_id')
                        ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
                        ->select( 'courses.id','courses.course_code', 'course_schedules.day', 'course_schedules.period', 'course_schedules.venue')
                        ->where('users.id', '=', $lect_id)
                        ->where('user_types.type', '=', 'Lecturer')
                        ->orderBy('course_schedules.created_at', 'desc')
                        ->get();
        return response()->json(['data'=>$schedules, 'status'=>200]);
                   
    }
     //display schedule by course_delegate course
     public function getCourseSchedulesByCourseDelegate()
     {
         $id =47; //will have to get the course delegate id
         $schedules =DB::table('course_schedules')
                         ->join('courses', 'courses.id', '=', 'course_schedules.course_id')
                         ->join('attends', 'courses.id', '=', 'attends.course_id')
                         ->join('users', 'users.id', '=', 'attends.user_id')
                         ->join('user_types','users.user_type_id','=', 'user_types.id')
                         ->select( 'courses.course_code', 'course_schedules.day', 'course_schedules.period', 'course_schedules.venue')
                         ->where('users.id', '=', $id)
                         ->where('user_types.type', '=','Course Delegate')
                         ->orderBy('course_schedules.created_at', 'desc')
                         ->get();
         return response()->json(['data'=>$schedules, 'status'=>200]);
                    
     }
    //store schedules
    public function store(Request $request)
    {
        $data  = $request->validate([
            'day' =>'required',
            'course_id'=>'required',
             'period'=>'required',
             'venue'=>'required'
        ]);
         CourseSchedule::create($data);
         //$schedules = $this->index();
        return response()->json(['data'=>$schedules, 'message'=>"Schedule has been Sucessfully Created", 'status'=>201]);
    }

    //update schedule method
    public function update(Request $request, CourseSchedule $course_schedule)
    {
        $course_schedule->update($request->all());
        return response()->json(['data'=>$course_schedule, 'message'=>'Course Schedule has be Updated Sucessfully','status'=>200]);
    }

    public function destroy(CourseSchedule $course_schedule)
    {
        $course_schedule->delete();
        return response()->json(['data'=>null, 'message'=>'Course Schedule has been deleted Sucessfully', 'status'=>204]);
    }

}
