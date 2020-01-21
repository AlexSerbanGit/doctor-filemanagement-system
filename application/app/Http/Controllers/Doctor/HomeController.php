<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Document;
use Auth;

class HomeController extends Controller
{
    
    public function index(){
        $documents = Document::where('doctor_code', '=', Auth::user()->name)->sortable()->paginate(15);
        $total = Document::where('doctor_code', '=', Auth::user()->name)->get()->count();

        return view('convenant.home')->with([
            'documents' => $documents,
            'total' => $total,
        ]);
    }

}
