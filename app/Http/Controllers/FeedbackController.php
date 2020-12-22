<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Feedback;

class FeedbackController extends Controller
{
    //get feedback for a course for a particular year
    public function index(Request $request)
    {
        $data = (array) $request->all();
        $feedback = DB::table('feedback')
                    ->join('courses', 'courses.id','=','feedback.course_id')
                    ->join('users', 'users.id', '=', 'feedback.user_id')
                    ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
                    ->where('user_types.type', '=', 'Course Delegate')
                    ->where('feedback.course_id', '=',$data['course_id'])
                    ->where('feedback.year','=',$data['year'])
                    ->select('feedback.id','feedback.year', 'feedback.feedback')
                    ->get();

        return response()->json(['data'=>$feedback, 'status'=>200]);
    }

    //add a feedback for a course
    public function store(Request $request)
    {
        $id = 1; //fake course delegate id.will have to get the current authenticated user
        $feedback = (array) $request->all();
        $created = Feedback::insert([
            'course_id'=>$feedback['course_id'],
            'user_id'=>$id,
            'feedback'=>$feedback['feedback'],
            'year'=>$feedback['year']
        ]);
        return  response()->json(['data'=>$created, 'message'=>'Feedback has been Successfully Created','status'=>201]);
    }

}
