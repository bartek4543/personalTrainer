<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function registerPage(){
        if(session('user_id') == null){
        return view('register');
        }
        else{
            return redirect('/');
        }
    }
    public function home(){
        return view('home');
    }
    public function loginPage(){
        if(session('user_id') == null){
        return view('login');
        }
        else{
            return redirect('/');
        }
    }
        public function profile(){
        if(session('user_id') != null){
        $user = DB::table('uzytkownicy')->select('*')->where('id', session('user_id'))->first();
        return view('profile', [
            'login' => $user->login,
            'email' => $user->email,
            'imie' =>  $user->imie,
            'wiek' => $user->wiek,
            'nazwisko' => $user->nazwisko,
            'status' => $user->status
        ]);
        
    }
    else{
        return redirect('/loginPage');
    }
    
    }
        public function editProfile(){
        if(session('user_id') != null){
        $user = DB::table('uzytkownicy')->select('imie', 'nazwisko', 'wiek')->where('id', session('user_id'))->first();
        return view('editProfile', [
            'imie' =>  $user->imie,
            'wiek' => $user->wiek,
            'nazwisko' => $user->nazwisko
        ]);
        
    }
    else{
        return redirect('/loginPage');
    }
    
    }
    public function editPassword(){
        if(session('user_id')!= null){
            return view('editPassword');
        }
        else{
            return redirect('loginPage');
        }
    }
    public function showProgress(){
        if(session('user_id') != null){
        return view('progress');
        }
        else{
            return redirect('/loginPage');
        }
    }
    public function addProgress(){
             if(session('user_id') != null){
                 return view('addProgress');
             }
             else{
            return redirect('/loginPage');
        }
    }
    public function trainerList(){
       
        if(session('user_id') != null){
            if(session('status') == 'Podopieczny'){
                $akceptacja = DB::table('prosby')->select('akceptacja')->where('id_uzytkownik', session('user_id'))->value('akceptacja');
                if($akceptacja == null){
                   return view('trainerList'); 
                }
                else if($akceptacja == 'nie'){
                    return view('trainerWaiting');
                }
                else{
                    return view('yourTrainer');
                }
                
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/loginPage');
        }
    }
    public function proteges(){
        if(session('user_id') != null){
            if(session('status') == 'Trener'){
                return view('proteges');
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/loginPage');
        }
    }
    public function addDish(){
        if(session('user_id') != null){
            if(session('status') == 'Trener'){
                return view('addDish');
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/loginPage');
        }
    }
     public function dishes(){
               if(session('user_id') != null){
            if(session('status') == 'Trener'){
                return view('yourDishes');
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/loginPage');
        }
    }
    public function exercises(){
        if(session('user_id') != null){
            if(session('status') == 'Trener'){
                return view('yourExercises');
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/loginPage');
        }
    }
        public function addExercise(){
        if(session('user_id') != null){
            if(session('status') == 'Trener'){
                return view('addExercise');
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/loginPage');
        }
    }
    public function createSchedule($protege_id){
        if(session('user_id') != null){
            if(session('status') == 'Trener'){
                return view('createDaySchedule', ['protege_id'=>$protege_id]);
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/loginPage');
        }
    }
    public function daySchedule(){
        if(session('user_id') != null){
        return view('daySchedule');
        }
        else{
            return redirect('/loginPage');
        }
    }
    public function messages(){
        if(session('user_id') != null){
            if(session('status') == 'Podopieczny'){
            $status = DB::table('prosby')->where([
                ['id_uzytkownik','=', session('user_id')],
                ['akceptacja', '=', 'tak']])->value('id_trener');
            if($status != null){
                return view('messages');
            }
            else{
                return view('messagesNoTrainer');
            }
            }
            return view('messages');
        }
    }
        
}
  

