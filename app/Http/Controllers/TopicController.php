<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    //display all topics
    public function index()
    {
        $topics = Topic::all();
        return response()->json($topics, 200);
    }
 
//get number of topics for a course
    public function getTopicNumber(Request $request) {  
        $course_id = $request->course_id; 
        $year = $request->year; 
        $topicNumber = DB::table('outlines')
                    ->join('courses', 'outlines.course_id', '=', 'courses.id')
                    ->join('topics', 'outlines.id', '=', 'topics.outline_id')
                     ->where('courses.id',  '=', $course_id)
                     ->where('year', '=', $year)
                    ->select('topics.id')->count();
                    
        return response()->json($topicNumber, 200);
    }

//get topic names for a course
public function getTopicName(Request $request) {  
    $course_id = $request->all()[0]; 
    $year = $request->all()[1]; 
    $topicName = DB::table('outlines')
                ->join('courses', 'outlines.course_id', '=', 'courses.id')
                ->join('topics', 'outlines.id', '=', 'topics.outline_id')
                 ->where('courses.id',  '=', $course_id['value'])
                 ->where('outlines.year', '=', $year)
                ->select('topics.id', 'topics.name')->get();
    
   // print_r($course_id['value']);         
    return response()->json($topicName, 200);
}
}
