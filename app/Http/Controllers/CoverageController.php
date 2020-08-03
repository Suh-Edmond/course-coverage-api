<?php

namespace App\Http\Controllers;

use App\coverage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Coverage as XmlCoverage;

class CoverageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $course_id = $request->course_id;
        $coverage = DB::table('coverages')
            ->join('courses', 'coverages.course_id', '=', 'courses.id')
            ->join('topics', 'coverages.topic_id', '=', 'topics.id')
            ->join('activities', 'coverages.activity_id', '=', 'activities.id')
            ->join('lecturers', 'coverages.lecturer_id', '=', 'lecturers.id')
            ->where('courses.id', '=', $course_id)
            ->select('coverages.day','coverages.period','coverages.week_number', 'topics.name', 
            'activities.type', 'lecturers.first_name','lecturers.last_name')
            ->orderBy('coverages.week_number', 'asc')->get();
        return response()->json($coverage, 200);
    }

    public function getNumberOfCoveredTopics(Request $request)
    {
        $course_id = $request->course_id;
        $coverage = DB::table('coverages')
            ->join('courses', 'coverages.course_id', '=', 'courses.id')
            ->join('topics', 'coverages.topic_id', '=', 'topics.id')
            ->join('activities', 'coverages.activity_id', '=', 'activities.id')
            ->join('lecturers', 'coverages.lecturer_id', '=', 'lecturers.id')
            ->where('courses.id', '=', $course_id)
            ->select('coverages.topic_id')->count();  
        return response()->json($coverage, 200);
    }

//record coverage
    public function store(Request $request)
    {
        $data = $request->all();
        $coverage_data =[
            'course_id' => $data['course_id']['value'],
            'week_number' => $data['week_number'],
            'day' => $data['day'],
            'period' => $data['period'],
            'activity_id' => $data['activity_id']['value'],
            'topic_id' => $data['topic_id']['value'],
            'lecturer_id' => $data['lecturer_id']['value']
        ]; 
        $result = DB::table('coverages')
                    ->insert($coverage_data);
        // print_r($result);
        // return;
        return response()->json($result, 201);
    }

    public function show(Coverage $coverage)
    {
        return response()->json($coverage, 201);
    }




    public function destroy(coverage $coverage)
    {
        //
    }
}
