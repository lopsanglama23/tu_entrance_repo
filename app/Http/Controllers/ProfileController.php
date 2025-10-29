<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile(Request $request){

        // use of findOrfail and append------------>

        // $user = User::findOrFail(9);
        // return response()->json([
        //     'data' => $user->append('full_name'),
        // ],200);

        // append method------------> 

        // $user  = User::all();
        // return response()->json([
        //     'data ' => $user->append('full_name'),
        // ],200);     
        
        //contains methods-------------> 

        $user  = User::all();
        $exits= $user->contains('id', 4);
        // debug($user)->suggest();
        return response()->json([
            'data' => $exits,
        ],200);

        //diff methods------------>

        // $user = User::all();
        // $users = User::whereIn('id',[5,6,7])->get();
        // $result = $user->diff($users);
        // return response()->json([
        //     'data' => $result,
        // ],200);

        // except method------------> 

        // $user  = User::all();
        // $users = $user->except([5,6]);
        // return response()->json([
        //     'data' => $users,
        // ],200);

        //find method----------------->

        // $user = User::find(9);
        //  return response()->json([
        //     'data' => $user,
        //  ],200);     
        
        //fresh methods--------------->


    }
}
