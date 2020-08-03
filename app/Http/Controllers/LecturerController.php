<?php

namespace App\Http\Controllers;

use App\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LecturerController extends  Controller
{


    //getting lecturers
    public function index()
    {
        $lecturer = Lecturer::all();
        return response()->json($lecturer, 200);
    }

    //get lecturers for a course
    public function getCourseLecturers(Request $request) 
    {
       $course_id = $request->course_id;
       $lecturer = DB::table('teaches')
                        ->join('lecturers', 'lecturers.id', '=', 'teaches.lecturer_id')
                        ->join('courses', 'courses.id', '=', 'teaches.course_id')
                        ->where('courses.id', '=', $course_id)
                        ->select('lecturers.first_name', 'lecturers.last_name')->get();
        return response()->json($lecturer, 200);
    }
    //add lecturers
    public function store(Request $request)
    {
        $data = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'matricule_number' => 'required|unique:lecturers',
            'email' => 'required|email|max:225',
            'telephone' => 'required|numeric',
            'gender' => 'required',
            'password' => 'required',

        ]);
        $lecturer = Lecturer::create($data);
        return response()->json($lecturer, 201);
    }

    //store lecturers
    public function show(lecturer $lecturer)
    {
        return response()->json($lecturer);
    }

    //updateLecturere
    public function update(lecturer $lecturer)
    {
        $data = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'matricule_number' => 'required',
            'email' => 'required|email|max:225',
            'telephone' => 'required|numeric',
            'gender' => 'required',
            'password' => 'required',

        ]);
        $lecturer->update($data);
        return response()->json($lecturer, 200);
    }


    public function destroy(lecturer $lecturer)
    {
        $lecturer->delete();
        return response()->json(null, 204);
    }
}
