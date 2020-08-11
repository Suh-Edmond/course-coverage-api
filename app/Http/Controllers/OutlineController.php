<?php

namespace App\Http\Controllers;

use App\outline;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutlineController extends Controller
{
    //display outlines
    public function index(Request $request)
    {
        $course_id = $request->all()[0];
        $year      = $request->all()[1];
        $outline = $this->getOutline($course_id, $year)->get();
        return response()->json($outline, 200);
    }
      //show outline method
 public function getOutline($course_id, $year)
      {
          $topics = DB::table('outlines')
                      ->join('courses', 'courses.id' , '=', 'outlines.course_id')
                      ->join('topics', 'outlines.id', '=', 'topics.outline_id')
                      ->where('courses.id', '=', $course_id)
                      ->where('outlines.year', '=', $year)
                      ->select('topics.id','topics.week_number', 'topics.name')
                      ->distinct()
                      ->orderBy('topics.week_number');
          return $topics;
      }

    //store outlines
    public function store(Request $request)
    {   
        
        $outline = $request->all()[0];
        $totalTopics = $request->all()[1];
        $outline_details = [
            'course_id' => $outline['outline']['course_id']['value'],
            'year' => $outline['outline']['year'],
            'created_at' =>(DB::raw('CURRENT_TIMESTAMP')),
            'updated_at' =>(DB::raw('CURRENT_TIMESTAMP')),
            ];
        $outline_id = DB::table('outlines')->insertGetId($outline_details);
        for($index  = 0; $index < $totalTopics; $index++)
                {
                    $topic = [
                            'name' => $outline['topic'][$index]['name'],
                            'week_number'=> $outline['topic'][$index]['week_number'],
                            'outline_id'=> $outline_id,
                            'created_at' =>(DB::raw('CURRENT_TIMESTAMP')),
                            'updated_at' =>(DB::raw('CURRENT_TIMESTAMP')),
                        ];
                        $topic_id = DB::table('topics')->insertGetId($topic);
                        $topic_act_number = count($outline['topic'][$index]['topic_activity']);
                    for($topic_act_index = 0; $topic_act_index < $topic_act_number; $topic_act_index++){
                        $topic_act = [
                            'topic_id' => $topic_id,
                            'activity_id' => $outline['topic'][$index]['topic_activity'][$topic_act_index]['value'],
                            'created_at' =>(DB::raw('CURRENT_TIMESTAMP')),
                            'updated_at' =>(DB::raw('CURRENT_TIMESTAMP')),
                        ];
                        $topic_act_id = DB::table('has_activities')->insertGetId($topic_act);
                    }
            }
           $current_course_id   =  $outline_details['course_id'];
           $current_year  = $outline_details['year'];
           $current_outline = $this->getOutline($current_course_id, $current_year)->get();
           return response()->json($current_outline, 200);
    }

   
    //getting all activities for a topics
    public function getActivities(Request $request)
    {
        $topic_id = $request->topic_id;
        $topic_activity = DB::table('has_activities')
                            ->join('topics', 'topics.id', '=', 'has_activities.topic_id')
                            ->join('activities', 'activities.id', '=', 'has_activities.activity_id')
                            ->where('topics.id', '=', $topic_id)
                            ->select('activities.*')->get();    
        return response()->json($topic_activity, 200);
    }
}
