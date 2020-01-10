<?php

namespace App\Http\Controllers;

use App\Document;
use App\User;
use App\Zip;
use Illuminate\Http\Request;
use Auth;
use File;
use ZipArchive;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function zipFiles(Request $request){
        if(!isset($request->check)){
            return redirect()->back()->with([
                'error' => 'no items selected',
            ]);
        }
        $headers = ["Content-Type"=>"application/zip"];
        $zip = new Zip;
        $zip->save();
        $fileName = $zip->id.'.zip'; // name of zip
        // $zip =  Zipper::make(public_path('/gg/'.Auth::user()->id.'.zip')); //file path for zip file
        $zip = new ZipArchive;
        if ($zip->open(dirname(dirname(public_path())).$fileName, ZipArchive::CREATE) === TRUE)
        {
            foreach($request->check as $index=>$check){
                $document = Document::find($index);

                // $file = File::get(public_path('/gg/'.$index.'.'.$document->extension));
                // return $index.'.'.$document->extension;
                // return is_file(public_path('3.PNG')) ? 1 : 0;
                // return is_dir(public_path(''))? 1 : 0;
                // $localPath = substr(public_path('3.PNG')), $exclusiveLength);

                // $zip->addFile('3.PNG',public_path(''));
                $zip->addFile('gg/'.$index.'.'.$document->extension);

            }

            $zip->close();

        }
        return response()->download(dirname(dirname(public_path())).$fileName );


    }

    public function download($id){

        $document = Document::find($id);

        if(Auth::user()->role_id == 1){

            return response()->download(dirname(dirname(public_path())).'/gg/'.$document->id.'.'.$document->extension);

        }elseif(Auth::user()->role_id == 2){

            foreach(Auth::user()->documents as $doc){
                if($doc->id == $id){
                    $document->downloaded = 1;
                    $document->save();
                    return response()->download(dirname(dirname(public_path())).'/gg/'.$document->id.'.'.$document->extension);
                }
            }

        }elseif(Auth::user()->role_id == 3){

            if($document->agreement_code == Auth::user()->name){
                $document->downloaded = 1;
                $document->save();
                return response()->download(dirname(dirname(public_path())).'/gg/'.$document->id.'.'.$document->extension);
            }

        }elseif(Auth::user()->role_id == 3){

            if($document->doctor_code == Auth::user()->name){
                $document->downloaded = 1;
                $document->save();
                return response()->download(dirname(dirname(public_path())).'/gg/'.$document->id.'.'.$document->extension);
            }

        }

    }

    public function changeCredentials(Request $request){

        $user = User::find(Auth::user()->id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191', 
            'full_name' => 'required|string|max:191', 
            'email' => 'required|string|max:191|email',
            'phone_number' => ['required', 'string', 'max:20'],
        ]);
    
        if($validator->fails()){
            return redirect()->back()->with('error', 'Invalid data sent');
        }

        if($user){

            if($request->email != $user->email){
                $users = User::where('email', '=', $request->email)->get();

                if($users->count() > 0){
                    return redirect()->back()->with('error', 'There is a user with that email already registered!');
                }
                $user->email = $request->email;

            }

            if($request->name != $user->name){
                $users = User::where('name', '=', $request->name)->get();

                if($users->count() > 0){
                    return redirect()->back()->with('error', 'There is a user with that username already registered!');
                }
                $user->name = $request->name;

            }

            if($request->password){
                $user->password = bcrypt($request->password);
            }

            $user->full_name = $request->full_name;
            $user->phone_number = $request->phone_number;
            $user->save();
            
    
            return redirect()->back()->with('success', 'Patient updated!');
        }

        return redirect()->back()->with('error', 'This user does not exist or its not a patient');

    }

}
