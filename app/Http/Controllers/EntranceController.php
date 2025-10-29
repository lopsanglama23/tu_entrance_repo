<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntranceController extends Controller
{
    
    private $programOptions = [
        'Bachelor' => ['BCA', 'BSW', 'BBA'],
        'Master'   => ['MCA', 'MBA'],
        'M.Phil'   => ['MPhil-IT', 'MPhil-Management'],
        'Ph.D'     => ['PhD-CS', 'PhD-Education'],
        'PGD'      => ['PGD-IT', 'PGD-HRM'],
    ];

 
    public function getPrograms(Request $request)
    {
        $level = $request->query('level');

        if (!$level || !array_key_exists($level, $this->programOptions)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or missing level.',
                'programs' => []
            ], 400);
        }

        return response()->json([
            'success' => true,
            'programs' => $this->programOptions[$level]
        ]);
    }

    public function registerEntrance(Request $request)
    {
        $request->validate([
            'level' => 'required|in:Bachelor,Master,M.Phil,Ph.D,PGD',
            'program' => 'required|string',
            'name' => 'required|string|max:100'
        ]);

        $level = $request->level;
        $program = $request->program;

        if (!in_array($program, $this->programOptions[$level] ?? [])) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid program for the selected level.'
            ], 422);
        }
        return response()->json([
            'success' => true,
            'message' => 'Entrance registration successful.',
            'data' => [
                'name' => $request->name,
                'level' => $level,
                'program' => $program,
            ]
        ]);
    }
}
