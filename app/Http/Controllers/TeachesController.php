<?php

namespace App\Http\Controllers;

use App\Teaches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeachesController extends Controller
{
    public function index() 
    {
        $course_lecturer = Teaches::all();
        return response()->json($course_lecturer, 200);
    }

      //get lecturers for a course
      public function getCourseLecturers(Request $request) 
      {
       // $lecturer_id = $request->all()[1];
        $course_id = $request->all();
        $lecturer = DB::table('teaches')
                          ->join('lecturers', 'teaches.lecturer_id', '=', 'lecturers.id')
                          ->join('courses', 'teaches.course_id', '=', 'courses.id')
                          ->where('courses.id', '=', $course_id['value'])
                          ->select('lecturers.id','lecturers.user_name')->get();
          return response()->json($lecturer, 200);
      }

      //add lecturer courses
      public function addLecturerCourse(Request $request) {
          $lecturer_id =1;
          $course_id = $request->all();
          $lect_course = DB::table('teaches')->insert([
            'lecturer_id' => $lecturer_id,  
            'course_id'=> $course_id['value'],
            'created_at' =>(DB::raw('CURRENT_TIMESTAMP')),
            'updated_at' =>(DB::raw('CURRENT_TIMESTAMP')),
            ]);
            $selectedCourses = $this->getSelectedCourses($request);
           return $selectedCourses;
      }

      //get all course  for a lecturer
      public function getSelectedCourses(Request $request) 
      {
        $lecturer_id =  1;
        $course = DB::table('teaches')
                        ->join('courses', 'courses.id', '=', 'teaches.course_id')
                          ->join('lecturers', 'lecturers.id', '=', 'teaches.lecturer_id')
                          ->where('lecturers.id', '=', $lecturer_id)
                          ->select('courses.id','courses.course_code', 'courses.title','courses.credit_value','courses.type','courses.semester')->get();
         
        return response()->json($course, 200);
      }
      //get course number for a lecturer
      public function getCourseNumber(Request $request)
      {
        $lecturer_id =  1;
        $course = DB::table('teaches')
                        ->join('courses', 'courses.id', '=', 'teaches.course_id')
                          ->join('lecturers', 'lecturers.id', '=', 'teaches.lecturer_id')
                          ->where('lecturers.id', '=', $lecturer_id)
                          ->select('courses.id')->distinct()->count();
         
        return response()->json($course, 200);
      }
}
