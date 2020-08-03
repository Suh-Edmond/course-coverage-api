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
                          ->select('lecturers.id','lecturers.first_name', 'lecturers.last_name')->get();
          return response()->json($lecturer, 200);
      }

      //add lecturer courses
      public function addLecturerCourse(Request $request) {
          $lecturer_id = $request->all()[1];
          $course_id = $request->all()[0];
          $lect_course = DB::table('teaches')->insert(['lecturer_id' => $lecturer_id,  'course_id'=> $course_id['value']]);
           return response()->json($lect_course, 201);
      }

      //get all course  for a lecturer
      public function getCourseOfLecturer(Request $request) 
      {
        $lecturer_id =  $request->lecturer_id;
        $course = DB::table('teaches')
                          ->join('lecturers', 'teaches.lecturer_id', '=', 'lecturers.id')
                          ->join('courses', 'teaches.course_id', '=', 'courses.id')
                          ->where('lecturers.id', '=', $lecturer_id)
                          ->select('courses.id','courses.course_code', 'courses.title','courses.credit_value','courses.type','courses.semester')->get();
          return response()->json($course, 200);
      }
}
