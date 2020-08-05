<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseDelegate;
use Illuminate\Support\Facades\DB;

class CourseDelegateController extends Controller
{


    public function index(){
        $course_del = CourseDelegate::all();
        return response()->json($course_del, 200);
        
    }

    public function store()
    {
        $data = request()->validate([
            'user_name' => 'required',
            'matricule_number' => 'required|unique:course_delegates',
            'email' => 'required|email|max:225',
            'telephone' => 'required|numeric',
            'password' => 'required',
        ]);
        $course_del = CourseDelegate::create($data);
        return response()->json($course_del, 201);
    }


    public function show(CourseDelegate $course_delegate)
    {
        return response()->json($course_delegate);
    }





    public function update(Request $request, CourseDelegate $course_delegate)
    {
        $data = request()->validate([
            'user_name' => 'required',
            'matricule_number' => 'required',
            'email' => 'required|email|max:225',
            'telephone' => 'required|numeric',
            'password' => 'required',
        ]);
        $course_delegate->update($data);
        return response()->json($course_delegate, 200);
    }
    public function destroy(CourseDelegate $courseDelegate)
    {
        $courseDelegate->delete();
        return response()->json(null, 204);
    }


    public function getCourseDelegates(){
        $course_del = DB::table('attends')
                    ->join('courses', 'courses.id', '=', 'attends.course_id')
                    ->join('course_delegates', 'course_delegates.id', '=', 'attends.course_delegate_id')
                    ->select('courses.course_code', 'courses.title', 'course_delegates.user_name'
                    ,'course_delegates.email','course_delegates.telephone')->get();
        return response()->json($course_del, 200);
    }
 
}
