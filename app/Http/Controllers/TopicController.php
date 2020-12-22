<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 

class TopicController extends Controller
{
     
    //display all topics
    public function index(Request $request)
    {
        $course = (array) $request->all(); 
        $topics = DB::table('outlines')
                    ->join('courses', 'outlines.course_id', '=', 'courses.id')
                    ->join('topics', 'outlines.id', '=', 'topics.outline_id')
                    ->where('courses.id',  '=', $course['course_id'])
                    ->where('outlines.year', '=', $course['year'])
                    ->select('topics.id', 'topics.name', 'topics.week_number')
                    ->orderBy('topics.week_number','asc')
                    ->get();
        return response()->json($topics, 200);
    }
 
//get number of topics for a course
    public function getTopicNumber(Request $request) {  

        $course = (array) $request->all(); 
        $id =  $course['course_id'];
        $year = $course['year'];
        $topicNumber = DB::table('outlines')
                    ->join('courses', 'outlines.course_id', '=', 'courses.id')
                    ->join('topics', 'outlines.id', '=', 'topics.outline_id')
                     ->where('courses.id',  '=', $id)
                     ->where('outlines.year', '=', $year)
                    ->select('topics.id')->count();          
        return response()->json($topicNumber, 200);
    }
//update a topic
    public function update(Request $request, $id)
    {
        $data = (array) $request->all();
        $updated = Topic::findOrFail($id)->update($data);
        return response()->json(['data'=>$updated, 'message'=>'Topic was Successfully updated', 'status'=>200]);
    }

    //get activities for a particular topic
    public function getTopicActivity(Request $request, $id)
    {
        //$topic_id = $request->all();
        $topic_activity = DB::table('has_activities')
                            ->join('topics', 'topics.id', '=', 'has_activities.topic_id')
                            ->join('activities', 'activities.id', '=', 'has_activities.activity_id')
                            ->where('topics.id', '=', $id)
                            ->select('activities.*')->get();    
        return response()->json(['data' => $topic_activity,  'status'=>200]);
    }
    //delete a topic
    public function destroy($id)
    {
        $deleted = Topic::findOrFail($id)->delete();
        return response()->json([$deleted, 'message'=>'Topic was Successfully deleted', 'status'=>204]);
    }
}
