<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class loginController extends Controller
{
      public function login(Request $request)
    {
        
        
       $usr = $request->all();
       $user = DB::table('uzytkownicy')->select('id', 'login', 'haslo', 'status')->where('login', $usr['login'])->first();
       if(!isset($user)){
           return response()->json([
               'success' => 'false',
               ]);
       }
       else{
           if(Hash::check($usr['haslo'], $user->haslo )){
               session([
                   'user_id' => $user->id,
                   'status' => $user->status
                   ]);
               return response()->json([
               'success' => 'true',
               ]);
           }
           else {
               return response()->json([
               'success' => 'false',
               ]);
           }
       }   
    }
    public function logOut(){
        session()->forget('user_id');
        return redirect('/');
    }
}
