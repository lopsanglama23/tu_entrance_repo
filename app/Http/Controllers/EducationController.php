<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Education;
use Illuminate\Validation\Rule;


class EducationController extends Controller
{
     public function educations(Request $request, $id){
        $board_name = [
            'Agriculture and Forestry University, Chitwan',
            'Far-western University, Kanchanpur',
            'Kathmandu University, Dhulikhel',
            'Mid Western University, Birendranagar',
            'Nepal Open University, Lalitpur',
            'Pokhara University, Pokhara',
            'Purbanchal University, Biratnagar',
            'Tribhuvan University, Kirtipur',
            'HSEB/NEB',
            'Other'
        ];
        $valids = $request->validate([
            'your_degree' => ['required', Rule::in(['SLC/SEE','+2/PCL','Bachelors','Master','PhD','MPhil'])],
            'board_name' => ['required', 'string', Rule::in($board_name)],
            'major_subject' => 'required',
            'academic_year' => 'required',
            'division_grade' => 'required|string',
            'complete_years' => 'required|string',
        ]);

        $education = Education::create($valids);
         return response()->json([
            'message' => 'Education Details Completed',
            'data' => $education,
         ], $code = 200);       
    }
    public function educationPreview(Request $request, $id){

        $preview  = Education::select(
            'your_degree',
            'board_name',
            'major_subject',
            'academic_year',
            'division_grade',
            'complete_years'
        )->find($id);     
        if(!$preview){
            return response()->json([
                'message' => 'Education details not found',
                'data' => $preview,
            ],404);
        }
        return response()->json([
            'data' => $preview,
        ],200);
    }
    // public function eduadd(Request $request){
    //     $val = $request->validate([
            
    //     ]);

    public function delete(Request $request, $id){
        $del  = Education::destroy($id);
    }
}




