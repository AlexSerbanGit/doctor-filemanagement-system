<?php

namespace App\Http\Controllers\Admin;

use App\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\User;

class HomeController extends Controller
{
    
    public function index(){
        $admins = User::where('role_id', '=', 1)->get()->count();
        $patients = User::where('role_id', '=', 2)->get()->count();
        $convenants = User::where('role_id', '=', 3)->get()->count();
        $doctors = User::where('role_id', '=', 4)->get()->count();

        $pat_docs = Document::where('role_id', '=', 2)->get()->count();
        $conv_docs = Document::where('role_id', '=', 3)->get()->count();
        $doc_docs = Document::where('role_id', '=', 4)->get()->count();


        return view('admin.home')->with([
            'admins' => $admins,
            'patients' => $patients, 
            'convenants' => $convenants,
            'doctors' => $doctors,
            'pat_docs' => $pat_docs,
            'conv_docs' => $conv_docs,
            'doc_docs' => $doc_docs,
        ]);
    }

    public function cronJob(){
        Artisan::call('demo:cron');

        return redirect()->back()->with('success', 'Cron job done!');
    }

}
