<?php

namespace App\Http\Controllers;

use App\HasActivity;
use Illuminate\Http\Request;

class HasActivityController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'topic_id' => 'required',
            'activity_id' => 'required',
        ]);
        HasActivity::create($data);
    }

    public function index()
    {
        $topicActivity = HasActivity::all();
        return response()->json($topicActivity, 201);
    }
}
