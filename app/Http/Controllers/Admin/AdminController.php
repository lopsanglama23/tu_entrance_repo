<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminRegister(Request $request){
        $vals = $request->validate([
            'name' => 'required|string|',
            'email' => 'required|email'       
        ]);
    }
}
