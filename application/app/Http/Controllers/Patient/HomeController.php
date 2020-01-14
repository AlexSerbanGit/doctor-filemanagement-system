<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{

    public function index(){
        $documents = Auth::user()->documents()->paginate(15);
        $total = Auth::user()->documents()->get()->count();

        return view('patient.home')->with([
            'documents' => $documents,
            'total' => $total,
        ]);
    }

}
