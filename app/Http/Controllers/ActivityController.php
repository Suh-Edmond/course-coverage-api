<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $act = Activity::all();
        return response()->json(['data'=>$act, 'status'=>200]);
    }
}
