<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    //set user type
    public function setUserType(Request $request)
    {
        $type = $request->all();
        return response()->json($type);
    }
   public function getType(Request $request)
   {
       $type = Auth::user()->user_type;
       return response()->json($type);
   }
    //add user
    public function addLecturer(Request $request) {
        $user_details= $request->all()[0];
        $user_type = $request->all()[1];
        $data =[
              'user_name' =>$user_details['user_name'],
              'matricule_number' => $user_details['matricule_number'],
              'email' =>$user_details['email'],
             'telephone' => $user_details['telephone'],
             'password' => Hash::make($user_details['password']),
             'created_at' =>(DB::raw('CURRENT_TIMESTAMP')),
             'updated_at' =>(DB::raw('CURRENT_TIMESTAMP')),
         ];
        $res = DB::table($user_type[0])->insertGetId($data);
                DB::table('users')->insert([
                    'user_id' =>$res,
                    'user_type' => $user_type[0],
                    'identified' => $user_details['email'],
                    'password' => Hash::make($user_details['password']),
                ]);
        return response()->json($res, 201);
        
    }
    //add course delegate
    public function addCourseDelegate(Request $request) {
        $user_details= $request->all()[0];
        $user_type = $request->all()[1];
        $verify = DB::table('course_dele_access_id')
                ->where('course_dele_access_id.access_id', '=', $user_details['access_id'] )
                ->select('course_dele_access_id.id')->get();
        if($verify == '[]'){
            $code = 0;
            return response()->json($code, 200);
        }
        else{
            $data =[
                'access_id' =>$user_details['access_id'],
                 'user_name' =>$user_details['user_name'],
                 'matricule_number' => $user_details['matricule_number'],
                 'email' =>$user_details['email'],
                'telephone' => $user_details['telephone'],
                'password' => Hash::make($user_details['password']),
                'created_at' =>(DB::raw('CURRENT_TIMESTAMP')),
                'updated_at' =>(DB::raw('CURRENT_TIMESTAMP')),
            ];
           $res = DB::table($user_type[0])->insertGetId($data);
                  DB::table('users')->insert([
                      'user_id' =>$res,
                      'user_type' => $user_type[0],
                      'identified' =>$user_details['email'],
                      'password' => Hash::make($user_details['password']),
                  ]);
           return response()->json($res, 201);
        }
    }

    //login user
    public function loginUser(Request $request)
    {
        $entered_user_type = $request->all();
        return response()->json( $entered_user_type,200);
    }
    //get user details
    public function getUserDetails(Request $request){
        
        $type = Auth::user()->user_type;
        $id =Auth::user()->user_id;
        $user_details = DB::table($type)
                    ->where($type.'.id', '=', $id)
                        ->select($type.'.user_name', $type.'.matricule_number', $type.'.email', $type.'.telephone')->get();
        
            
        return response()->json($user_details,  200);
    }
}
