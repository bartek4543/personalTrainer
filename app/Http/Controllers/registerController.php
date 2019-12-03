<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class registerController extends Controller



{
        public function register(Request $request){
            $validator = Validator::make($request->all(),[
                'login' => 'required|alpha_num|min:4|max:20|unique:uzytkownicy,login',
                'email' => 'required|email|unique:uzytkownicy,email',
                'haslo' => 'required|min:6|max:20|alpha_dash',
                'imie' => 'nullable|alpha',
                'nazwisko' => 'nullable|alpha',
                'wiek' => 'nullable|date',
                'status' => 'required|alpha'
                
            ]);
            if($validator->fails()){
                return response()->json($validator->messages(), 200);
            }
            else{
                DB::table('uzytkownicy')->insert([
                    'login' => $request->input('login'),
                    'email' => $request->input('email'),
                    'haslo' => Hash::make($request->input('haslo')),
                    'imie' => $request->input('imie'),
                    'nazwisko' => $request->input('nazwisko'),
                    'status' => $request->input('status'),
                    'wiek' => $request->input('wiek')
                ]);
                return response()->json([
                'success' => 'true'
            ]);
            }
}
}

