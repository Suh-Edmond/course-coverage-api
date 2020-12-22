<?php

namespace App\Http\Controllers;

use App\Coverage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use SebastianBergmann\CodeCoverage\Report\Xml\Coverage as XmlCoverage;

class CoverageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    //get coverage details for a particular course for a year
    public function index(Request $request)
    {
        $course_detail = (array) $request->all();
        $coverage = DB::table('coverages')
            ->join('courses', 'courses.id', '=', 'coverages.course_id')
            ->join('users', 'users.id', '=', 'coverages.user_id')
            ->join('user_types', 'user_types.id', '=', 'users.user_type_id')
            ->join('topics', 'topics.id', '=', 'coverages.topic_id')
            ->join('activities', 'activities.id', '=', 'coverages.activity_id')
            ->where('user_types.type', '=', 'Lecturer')
            ->where('courses.id', '=', $course_detail['course_id'])
            ->where('coverages.year', '=', $course_detail['year'])
            ->select('coverages.day','coverages.period','coverages.week_number', 'topics.name', 
            'activities.type', 'users.first_name','users.last_name')
            ->orderBy('coverages.week_number', 'asc')->get();
        
        return response()->json(["data"=>$coverage, "status"=>200]);
    }

 //get total number of topics covered per course
    public function getNumberOfCoveredTopics(Request $request)
    {
        $course_detail = (array)$request->all();
        $coverage = DB::table('coverages')
            ->join('courses', 'coverages.course_id', '=', 'courses.id')
            ->join('topics', 'coverages.topic_id', '=', 'topics.id')
            ->join('activities', 'coverages.activity_id', '=', 'activities.id')
            ->join('users', 'coverages.user_id', '=', 'users.id')
            ->where('courses.id', '=', $course_detail['course_id'])
            ->where('coverages.year', '=', $course_detail['year'])
            ->select('coverages.topic_id')->distinct()->count(); 
        
        return response()->json(["data"=>$coverage, "status"=>200]);
    } 

//record coverage for a particular course
    public function store(Request $request)
    {
        $result = Coverage::create((array) $request->all());
        return response()->json(["data"=>$result, "status"=>201, "message"=>"Coverage has been successfully been record"]);
    }
//get number of topics covered per week
    // public function getCoveredTopicsPerWeeks(Request $request)
    // {
    //     $course_detail = (array) $request->all();
    //     $week_number = DB::table('coverages')
    //                     ->select(DB::raw("coverages.week_number, count(coverages.week_number) as num"))
    //                     ->join('courses', 'courses.id', '=','coverages.course_id')
    //                     ->join('topics', 'topics.id', '=','coverages.topic_id')
    //                 ->where('courses.id', '=', $course_detail['course_id'])
    //                 ->where('coverages.year', '=', $course_detail['year'])
    //                 ->groupBy('coverages.week_number')
    //                 ->get();
    //      return response()->json($week_number, 201);
    // }

    
 
}
