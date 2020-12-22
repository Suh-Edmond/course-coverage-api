<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AccessIdController extends Controller
{
    //generate access id for a course delegate registration
    public function generateId(Request $request) {
            $code =  $request->all();
            $access_id = str_shuffle($code['course_code'] ."ADFZXDGHBhk1790");
            $return_id= DB::table('course_dele_access_id')
                        ->insert(['course_code' => $code['course_code'], 'access_id' => $access_id]);
        return response()->json($access_id);
    }
}
