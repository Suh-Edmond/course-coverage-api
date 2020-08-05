<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //set user type
    public function setUserType(Request $request)
    {
        $type = $request->all();
        return response()->json($type);
    }

    //add user
    public function addUser(Request $request) {
        $user_details= $request->all()[0];
        $user_type = $request->all()[1];
        $data =[
            'user_name' => $user_details['user_name'],
            'matricule_number' => $user_details['matricule_number'],
            'email' =>$user_details['email'],
            'telephone' => $user_details['telephone'],
             'password' => Hash::make($user_details['password'])
        ];
        $res = DB::table($user_type[0])->insert($data);
        return response()->json($res, 201);
        
    }

    //login user
    public function loginUser(Request $request)
    {
        $entered_user_type = $request->all()[0];
        $entered_user_matricule_number = $request->all()[1];
        $entered_user_password = $request->all()[2];
        $store_password = DB::table($entered_user_type)
                ->where($entered_user_type.'.matricule_number', '=', $entered_user_matricule_number)
                ->select( $entered_user_type.'.password')->get();
         if(Hash::check($entered_user_password,  $store_password)){
                print("success");
         }else{
             print("Error");
         }
       
        return;
    }
}
