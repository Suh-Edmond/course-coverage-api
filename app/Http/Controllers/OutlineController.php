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
        $data = (array) $request->all();
        $outline =   DB::table('outlines')
                        ->join('courses', 'courses.id' , '=', 'outlines.course_id')
                        ->join('topics', 'outlines.id', '=', 'topics.outline_id')
                        ->where('courses.id', '=', $data['course_id'])
                        ->where('outlines.year', '=', $data['year'])
                        ->select('topics.id','topics.week_number', 'topics.name')
                        ->distinct()
                        ->orderBy('topics.week_number');
        return response()->json($outline, 200);
    }


    //store outlines
    public function store(Request $request)
    {   
        
        $outline = (array) $request->all();
        $topics = count($outline['outline_data']['topics']);//count the number of topics for this outline
        //get the course id annd year for the outline
        $details = [
            'course_id' => $outline['outline_data']['details']['course_id'],
            'year' => $outline['outline_data']['details']['year'],
            ];
          $outline_id = DB::table('outlines')->insertGetId($details);//insert the details for the outline and get the last inserted id from table
        //loop through the array of topics to get the details for each topic
        for($index = 0; $index < $topics; $index++)
        {
              $topic = [
                  'name' => $outline['outline_data']['topics'][$index]['name'],
                  'week_number'=> $outline['outline_data']['topics'][$index]['week_number'],
                  'outline_id'=> $outline_id,
              ];
              $topic_id = DB::table('topics')->insertGetId($topic);//insert the topics and get their id from the table
              $topic_act_number = count($outline['outline_data']['topics'][$index]['activity_id']);//count the number of activities for each inserted topic
              //loop through the list of activities for each topic and get their details
              for($i = 0; $i < $topic_act_number; $i++)
              {
                  $topic_activity = [
                        'topic_id' =>$topic_id,
                        'activity_id' => $outline['outline_data']['topics'][$index]['activity_id'][$i]['value']     
                  ];
                  $topic_activity_id = DB::table('has_activities')->insertGetId($topic_activity);//insert the activities for eachtopic and get their id
              }
        }
        return response()->json(['data'=>$current_outline, 'message'=>"Course Outline has been Sucessfully Created", 'status'=>201]);
    }


}
