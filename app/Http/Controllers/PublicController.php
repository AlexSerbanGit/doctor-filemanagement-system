<?php

namespace App\Http\Controllers;

use App\Document;
use App\UserHasDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PublicController extends Controller
{
    
    public function searchDocument(Request $request){

        $validator = Validator::make($request->all(), [
            'protocol' => 'required|string|max:191',
            'password' => 'required|string|max:191',
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error', 'Invalid data');
        }

        $documents = Document::where('patient_protocol', '=', $request->protocol)
                            ->where('patient_password', '=', $request->password)
                            ->get();

        if($documents && $documents->count() > 0){
            return view('document-search')->with([
                'documents' => $documents,
            ]);
        }

        return redirect()->back()->with('error', 'There are no documents with these credentials');

    }

    public function addToAcc($patient_protocol, $patient_password){

        if(Auth::user()->role_id != 2){
            return redirect('/document-search')->with('error', 'You are not a patient');        
        }

        $documents = Document::where('patient_protocol', '=', $patient_protocol)
                            ->where('patient_password', '=', $patient_password)
                            ->get();

        foreach($documents as $document){
            $ok = 1;
            foreach(Auth::user()->documents as $doc){
                if($doc->id == $document->id){
                    $ok = 0; break;
                }
            }

            if($ok == 1){
                $userHasDocument = new UserHasDocument;
                $userHasDocument->user_id = Auth::user()->id;
                $userHasDocument->document_id = $document->id;
                $userHasDocument->save();
            }
          
        }

        return redirect('/patient/home')->with('success', 'Documents added!');

    }

}
