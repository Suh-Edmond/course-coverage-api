<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AccessIdController extends Controller
{
    public function generateId(Request $request) {
        $code = $request->all()[0];
           $access_id = str_shuffle($code ."ADFZXDGHBhk1790");
         $return_id= DB::table('course_dele_access_id')
            ->insert(['course_code' => $code, 'access_id' => $access_id]);
        return response()->json($access_id, 200);
    }
}
