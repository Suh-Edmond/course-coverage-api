<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AttendsController extends Controller
{
    //get all courses for a course delegate 
        //names of all courses for a particular course delegate

        public function getAttendCourse(Request $request)
        {
            $id =1;
            //I have to pass the id of the current authenticated course delegates to get all the courses fr the course delegate
            $request->all();
            $attend_course = DB::table('attends')
            ->join('courses', 'courses.id', '=', 'attends.course_id')
            ->join('course_delegates', 'course_delegates.id', '=', 'attends.course_delegate_id')
            ->where('course_delegates.id', '=', $id)
            ->select('courses.id','courses.course_code', 'courses.title', 'courses.credit_value'
            ,'courses.type','courses.semester')->get();
            return response()->json($attend_course, 200);
        }
}
