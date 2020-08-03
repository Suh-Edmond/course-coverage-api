<?php

namespace App\Http\Controllers;

use App\outline;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OutlineController extends Controller
{
    //display outlines
    public function index()
    {
        $outline = Outline::all();
        return response()->json($outline, 200);
    }

    //store outlines
    public function store(Request $request)
    {   
        $outline = $request->all()[0];
        $totalTopics = $request->all()[1];
        //$index;
            $outline_details = [
                  'course_id' => $outline['outline']['course_id']['value'],
                 'year' => $outline['outline']['year']
             ];
            $outline_id = DB::table('outlines')->insertGetId($outline_details);
            for($index  = 0; $index < $totalTopics; $index++)
                 {
                        $topic = [
                             'name' => $outline['topic'][$index]['name'],
                             'week_number'=> $outline['topic'][$index]['week_number'],
                             'outline_id'=> $outline_id
                         ];
                         $topic_id = DB::table('topics')->insertGetId($topic);
                         $topic_act_number = count($outline['topic'][$index]['topic_activity']);
                        for($topic_act_index = 0; $topic_act_index < $topic_act_number; $topic_act_index++){
                            $topic_act = [
                                'topic_id' => $topic_id,
                                'activity_id' => $outline['topic'][$index]['topic_activity'][$topic_act_index]['value']
                            ];
                            $topic_act_id = DB::table('has_activities')->insertGetId($topic_act);
                        }
                 }

        return response()->json($topic_act_id, 201);
    }

    //show outline method
    public function show(outline $outline)
    {
        return response()->json($outline);
    }
}
