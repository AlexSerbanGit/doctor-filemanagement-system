<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Document;
use App\User;

class HomeController extends Controller
{
    
    public function documents(){
        $documents = Document::all();

        return response()->json([
            'documents' => $documents,
        ]);
    }

    public function getUsers($id){

        if($id >= 1 && $id <= 4){

            $users = User::where('role_id', '=', $id)->get();

            if($id == 2){
                foreach($users as $user){
                    $user->docs = $user->documents->count();
                } 
            }

            if($id == 3){
                foreach($users as $user){
                    $documents = Document::where('agreement_code', '=', $user->name)->get();
                    $user->docs = $documents->count();
                }
            }
           
            if($id == 4){
                foreach($users as $user){
                    $documents = Document::where('doctor_code', '=', $user->name)->get();
                    $user->docs = $documents->count();
                }
            }

            return response()->json([
                'documents' => $users,
            ]);

        }

        return '------';

    }

}
