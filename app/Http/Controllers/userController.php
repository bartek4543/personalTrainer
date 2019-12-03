<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
 
    function editProfile(Request $request){
            $validator = Validator::make($request->all(),[
                'id' => 'exists:uzytkownicy,id',
                'imie' => 'nullable|alpha',
                'nazwisko' => 'nullable|alpha',
                'wiek' => 'nullable|date'
                
            ]);
            if($validator->fails()){
                return response()->json($validator->messages(), 200);
            }
            else{
                DB::table('uzytkownicy')->where('id', $request->input('id'))->update([
                    'imie' => $request->input('imie'),
                    'nazwisko' => $request->input('nazwisko'),
                    'wiek' => $request->input('wiek')
                        
                        ]);
                return response()->json([
                    'success' => 'true'
                ]);
            }
    }
    function editPassword(Request $request){
        $user = DB::table('uzytkownicy')->select('haslo')->where('id', $request->input('id'))->first();
        if(Hash::check($request->input('stareHaslo'), $user->haslo)){
            $validator = Validator::make($request->all(),[
                'haslo' => 'required|min:6|max:20|alpha_dash',
            ]);
            if($validator->fails()){
                return resposne()->json($validator->messages(), 200);
            }
            else{
                DB::table('uzytkownicy')->where('id', $request->input('id'))->update([
                    'haslo' => Hash::make($request->input('haslo'))
                      
                ]);
                return response()->json([
                    'success' => 'true'
                ]);
            }
        }
        else{
            return response()->json([
                'stareHaslo' => 'Nieprawidłowe hasło'
            ], 200);
        }
    }
    function showProgress(Request $request){
        $wymiary = DB::table('wymiary')->select('id','waga', 'wzrost', 'obwod_biceps', 'obwod_klatka', 'data')->where('id_uzytkownik', $request->input('id'))->orderBy('data', 'desc')->get();
        return response()->json($wymiary, 200);
    }
    function addProgress(Request $request){
        $validator = Validator::make($request->all(), [
           'id' => 'required|exists:uzytkownicy,id',
            'wzrost' => 'nullable|numeric',
            'waga' => 'nullable|numeric',
            'obwod_biceps' => 'nullable|numeric',
            'obwod_klatka' => 'nullable|numeric',
            'data' => 'required|date'
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), 200);
        }
        else{
            DB::table('wymiary')->insert([
                'id_uzytkownik' => $request->input('id'),
                'wzrost' => $request->input('wzrost'),
                'waga' => $request->input('waga'),
                'obwod_klatka' => $request->input('obwod_klatka'),
                'obwod_biceps' => $request->input('obwod_biceps'),
                'data' => $request->input('data')
            ]);
            return response()->json([
                'success' => 'true'
            ]);
        }
    }
    function deleteProgress(Request $request){
        DB::table('wymiary')->where('id', $request->input('id'))->delete();
    }
    function trainerList(Request $request){
        if($request->input('szukanie') == 'brak'){
        $trainerList = DB::table('uzytkownicy')->select('id', 'login', 'imie', 'nazwisko', 'wiek')->where('status', 'Trener')->orderBy($request->input('pole'), $request->input('kolejnosc'))->get();
        }
        else{
         $trainerList = DB::table('uzytkownicy')->select('id', 'login', 'imie', 'nazwisko', 'wiek')->whereRaw('`status` like "Trener" AND ( LOWER(`login`) LIKE ? OR LOWER(`imie`) LIKE ? OR LOWER(`nazwisko` LIKE ? ))', [$request->input('szukanie'), $request->input('szukanie'), $request->input('szukanie')])->
                orderBy($request->input('pole'), $request->input('kolejnosc'))->get();   
          //  $trainerList = DB::select(DB::raw('SELECT id, login, imie, nazwisko, wiek FROM `uzytkownicy` WHERE status LIKE "Trener" AND ( LOWER(`login`) LIKE ? OR LOWER(`imie`) LIKE ? OR LOWER(`nazwisko`) LIKE ? ))', [$request->input('szukanie')]));
        }
        return response()->json($trainerList, 200);
    }
    function sendRequest(Request $request){
       
        DB::table('prosby')->insert([
           'id_uzytkownik' => $request->input('id'),
           'id_trener' => $request->input('trainer'),
           'akceptacja' => 'nie'
        ]);
        return response()->json([
           'success' => 'true' 
        ]);
    }
    function cancelRequest(Request $request){
        DB::table('prosby')->where('id_uzytkownik', $request->input('id'))->delete();
        if($request->input('second_id') == 0){
            $rozmowa = DB::table('rozmowy')->where('id_uzytkownik', $request->input('id'))->value('id');
        }
        else{
            $rozmowa = DB::table('rozmowy')->where([
                ['id_uzytkownik','=', $request->input('id')],
                ['id_trener', '=', $request->input('second_id')]])
                    ->value('id');
            }
        DB::table('wiadomosci')->where('id_rozmowa', $rozmowa)->delete();
        DB::table('rozmowy')->where('id', $rozmowa)->delete();
    }
    function proteges(Request $request){
       $users_id = DB::table('prosby')->select('id_uzytkownik')->where('id_trener', $request->input('id'))->where('akceptacja', $request->input('akceptacja'))->get();
       $users_id = json_decode(json_encode($users_id), true);
       $result = DB::table('uzytkownicy')->select('id','login', 'imie', 'nazwisko', 'wiek')->whereIn('id', $users_id)->get();
       return response()->json($result, 200);
    }
    function acceptRequest(Request $request){
        DB::table('prosby')->where('id_uzytkownik', $request->input('id'))->update([
            'akceptacja' => 'tak'
        ]);
        $id_trener = DB::table('prosby')->where('id_uzytkownik', $request->input('id'))->value('id_trener');
        DB::table('rozmowy')->insert([
           'id_uzytkownik' => $request->input('id'),
           'id_trener' => $id_trener
        ]);
    }
    function showDishes(Request $request){
        $dania = DB::table('dania')->select('id','nazwa', 'kalorycznosc', 'opis')->where('id_trener', $request->input('id'))->orderBy('nazwa', 'asc')->get();
        return response()->json($dania, 200);
    }
    function addDish(Request $request){
        $validator = Validator::make($request->all(), [
           'id' => 'required|exists:uzytkownicy,id',
            'nazwa' => 'required',
            'kalorycznosc' => 'nullable|numeric',
            'opis' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), 200);
        }
        else{
            DB::table('dania')->insert([
                'id_trener' => $request->input('id'),
                'nazwa' => $request->input('nazwa'),
                'kalorycznosc' => $request->input('kalorycznosc'),
                'opis' => $request->input('opis'),

            ]);
            return response()->json([
                'success' => 'true'
            ]);
        }
    }
    function deleteDish(Request $request){
        DB::table('dania')->where('id', $request->input('id'))->delete();
    }
    function showExercises(Request $request){
        $cwiczenia = DB::table('cwiczenia')->select('id','nazwa', 'opis')->where('id_trener', $request->input('id'))->orderBy('nazwa', 'asc')->get();
        return response()->json($cwiczenia, 200);
    }
    function addExercise(Request $request){
        $validator = Validator::make($request->all(), [
           'id' => 'required|exists:uzytkownicy,id',
            'nazwa' => 'required',
            'opis' => 'required'
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), 200);
        }
        else{
            DB::table('cwiczenia')->insert([
                'id_trener' => $request->input('id'),
                'nazwa' => $request->input('nazwa'),
                'opis' => $request->input('opis')

            ]);
            return response()->json([
                'success' => 'true'
            ]);
        }
    }
    function deleteExercise(Request $request){
        DB::table('cwiczenia')->where('id', $request->input('id'))->delete();
    }
    function getDishes(Request $request){
        $dania = DB::table('dania')->select('id', 'nazwa')->where('id_trener', $request->input('id'))->get();
        if(isset($dania)){
            return response()->json($dania, 200);
        }
    }
    function getExercises(Request $request){
        $cwiczenia = DB::table('cwiczenia')->select('id', 'nazwa')->where('id_trener', $request->input('id'))->get();
        if(isset($cwiczenia)){
            return response()->json($cwiczenia, 200);
        } 
    }
    function createSchedule(Request $request){
        $schedule = $request->all();
       $id = DB::table('plany_dnia')->insertGetId([
          'id_trener' => $request->input('id_trener'),
           'id_uzytkownik' => $request->input('id_uzytkownik'),
          'data' => $request->input('data')
      ]);
       $dania = $schedule['dania'];

      foreach($dania as $value){
           DB::table('diety')->insert([
              'dania_id' => $value,
              'plany_dnia_id' => $id
           ]);
       }
       $cwiczenia = $schedule['cwiczenia'];
       foreach($cwiczenia as $value){
           DB::table('treningi')->insert([
               'plany_dnia_id' => $id,
               'cwiczenia_id' => $value[0],
               'liczba_serii' => $value[1],
               'liczba_powtorzen' => $value[2],
               'obciazenie' => $value[3]
            ]);
       }
       
    }
    function showSchedules(Request $request){
        $arr = array();
        $plany = DB::table('plany_dnia')->select('id', 'data')->where('id_uzytkownik', $request->input('id'))->orderBy('data', 'desc')->get();
        foreach($plany as $plan){
            $arr[]=$plan->id;
        }
        $dania = DB::table('dania')->join('diety','dania.id', '=', 'diety.dania_id')->select('nazwa', 'kalorycznosc', 'opis', 'plany_dnia_id')->whereIn('plany_dnia_id', $arr)->get();
        $cwiczenia = DB::table('cwiczenia')->join('treningi','cwiczenia.id', '=', 'treningi.cwiczenia_id')->select('nazwa', 'opis', 'liczba_serii', 'liczba_powtorzen', 'obciazenie', 'plany_dnia_id')->whereIn('plany_dnia_id', $arr)->get();
        return response()->json([
            'plany' => $plany,
            'dania' => $dania,
            'cwiczenia' => $cwiczenia
        ], 200);
        }
        function getMessages(Request $request){
            if($request->input('second_id') == 0){
                $wiadomosci = DB::table('wiadomosci')->join('rozmowy', 'wiadomosci.id_rozmowa', '=', 'rozmowy.id')->select('wiadomosci.id_uzytkownik', 'tresc', 'data')->where('rozmowy.id_uzytkownik', $request->input('id'))->orderBy('data', 'asc')->get();
                $rozmowa = DB::table('rozmowy')->where('id_uzytkownik', $request->input('id'))->value('id');
            }
            else{
                $wiadomosci = DB::table('wiadomosci')->join('rozmowy', 'wiadomosci.id_rozmowa', '=', 'rozmowy.id')->select('wiadomosci.id_uzytkownik', 'tresc', 'data')->where([
                    ['rozmowy.id_trener', '=', $request->input('id')],
                    ['rozmowy.id_uzytkownik', '=', $request->input('second_id')]])
                    ->orderBy('data', 'asc')->get();
                    $rozmowa = DB::table('rozmowy')->where([
                        ['id_trener', $request->input('id')],
                        ['id_uzytkownik', $request->input('second_id')]
                            ])->value('id');
            }
            DB::table('wiadomosci')->where([
                   ['id_rozmowa', '=', $rozmowa],
                    ['id_uzytkownik', '!=', $request->input('id')],
                    ['przeczytane', '=', 'nie']
                ])->update([
                    'przeczytane' => 'tak'
                ]);
            return response()->json($wiadomosci, 200);
        }
        function sendMessage(Request $request){
            date_default_timezone_set('CET');
            if($request->input('second_id') == 0){
                DB::table('wiadomosci')->join('rozmowy', 'wiadomosci.id_rozmowa', '=', 'rozmowy.id')->where('rozmowy.id_uzytkownik', $request->input('id'))->insert([
                   'wiadomosci.id_uzytkownik' => $request->input('id'),
                    'tresc' => $request->input('tresc'),
                    'data' => date('Y-m-d H:i:s'),
                    'id_rozmowa' => DB::table('rozmowy')->where('id_uzytkownik', $request->input('id'))->value('id')
                ]);
            }
            else{
                   DB::table('wiadomosci')->join('rozmowy', 'wiadomosci.id_rozmowa', '=', 'rozmowy.id')->where([
                    ['rozmowy.id_trener', '=', $request->input('id')],
                       ['rozmowy.id_uzytkownik', '=', $request->input('second_id')]
                       ])->insert([
                   'wiadomosci.id_uzytkownik' => $request->input('id'),
                    'tresc' => $request->input('tresc'),
                    'data' => date('Y-m-d H:i:s'),
                    'id_rozmowa' => DB::table('rozmowy')->where([
                        ['id_trener', $request->input('id')],
                        ['id_uzytkownik', $request->input('second_id')]
                            ])->value('id')
                ]);
            }
        }
        function getConversations(Request $request){
            $rozmowy = DB::table('rozmowy')->join('uzytkownicy', 'rozmowy.id_uzytkownik', '=', 'uzytkownicy.id')->select('uzytkownicy.id', 'login')->where('rozmowy.id_trener', $request->input('id'))->get();
            return response()->json($rozmowy, 200);
        }
        function getNewMessages(Request $request){
                if($request->input('second_id') == 0){
                $wiadomosci = DB::table('wiadomosci')->join('rozmowy', 'wiadomosci.id_rozmowa', '=', 'rozmowy.id')->select('wiadomosci.id_uzytkownik', 'tresc', 'data')->where([
                    ['rozmowy.id_uzytkownik', '=', $request->input('id')],
                    ['przeczytane', '=', 'nie'],
                    ['wiadomosci.id_uzytkownik','!=', $request->input('id')]])
                        ->orderBy('data', 'asc')->get();
                $rozmowa = DB::table('rozmowy')->where('id_uzytkownik', $request->input('id'))->value('id');
            }
            else{
                $wiadomosci = DB::table('wiadomosci')->join('rozmowy', 'wiadomosci.id_rozmowa', '=', 'rozmowy.id')->select('wiadomosci.id_uzytkownik', 'tresc', 'data')->where([
                    ['rozmowy.id_trener', '=', $request->input('id')],
                    ['rozmowy.id_uzytkownik', '=', $request->input('second_id')],
                    ['przeczytane', '=', 'nie'],
                    ['wiadomosci.id_uzytkownik','!=', $request->input('id')]])
                    ->orderBy('data', 'asc')->get();
                    $rozmowa = DB::table('rozmowy')->where([
                        ['id_trener', $request->input('id')],
                        ['id_uzytkownik', $request->input('second_id')]
                            ])->value('id');
            }
            DB::table('wiadomosci')->where([
                   ['id_rozmowa', '=', $rozmowa],
                    ['id_uzytkownik', '!=', $request->input('id')],
                    ['przeczytane', '=', 'nie']
                ])->update([
                    'przeczytane' => 'tak'
                ]);
            return response()->json($wiadomosci, 200);
        }
}

