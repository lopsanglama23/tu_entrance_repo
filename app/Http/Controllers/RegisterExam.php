<?php

namespace App\Http\Controllers;

use App\Models\Admin\Subject;
use Illuminate\Http\Request;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class RegisterExam extends Controller
{
    public function registerexam(Request $request)
    {
        $validates = $request->validate([
            'select_semester' => 'required|in:first,second,third,fourth,fifth,sixth,seventh,eight',
            'exam_type' => 'required|in:Regular,Back',
        ]);
        $validates['user_id'] = Auth::id();
        $examregistration = Exam::create($validates);
        return response()->json([
            'message' =>'The Registration for Exam',
            'data' => $examregistration, 
        ],$code = 200);
    }

    public function seesubjects(Request $request, $semester){
        $see = Subject::where('semester',$semester)->first();
        return response()->json([
            'message' => 'subjects',
            'subjects' => $see, 
        ],200);
    }

    public function profile(Request $request){
        
    }
   
}
