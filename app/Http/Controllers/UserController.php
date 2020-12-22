<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
class UserController extends Controller
{
    //set user type during resgistration
    public function setUserType(Request $request)
    {
        $type = $request->all();
        return response()->json($type);
    }
    //get the type for authenticated users during login
   public function getType(Request $request)
   {
       $type = Auth::user()->user_type;
       return response()->json($type);
   }
    

    // // login user
    // public function loginUser(Request $request)
    // {
    //     $entered_user_type = $request->all();
    //     return response()->json($entered_user_type,200);
    // }
    //get user details
    public function getUserDetails(){
        
        //$id =Auth::user()->user_id;
        $user_details = DB::table('users')
                    ->where('users.id', '=', 151)
                    ->select('users.id','users.first_name','users.last_name', 'users.registration_number', 'users.email', 'users.telephone')->get();
        
            
        return response()->json($user_details,  200);
    }

    //update user details
    public function update(Request $request)
    {
        //need to get the current authenticated user id
        $updated = User::findOrFail(1);
        $updated->update((array)$request->all());
        return response()->json(['data'=>$updated,'message'=>"User details has been Successfully updated",'status'=>200]);
    }
    //get the number of course delegates for all course of a lecturer
    public function getNumberCourseDelegates(){
        //$lecturer_id = Auth::user()->user_id;
        $lecturer_id =3; //fake lecturer id
    // $type = Auth::user()->user_type;
        $course_del_number = DB::table('attends')
                    ->join('courses', 'courses.id', '=', 'attends.course_id')
                    ->join('teaches', 'courses.id', '=', 'teaches.course_id')
                    ->join('users', 'users.id', '=', 'teaches.user_id')
                    ->join('user_types', 'users.user_type_id', '=', 'user_types.id')
                    ->where('users.id', '=', $lecturer_id)
                    ->where('user_types.type','=','Course Delegate')
                    ->select('users.id')
                    ->count();
                    
        return response()->json(["data" =>$course_del_number, "status"=>200]);
    }
}
