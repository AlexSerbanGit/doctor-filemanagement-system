<?php

namespace App\Http\Controllers\Convenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Document;
use Auth;

class HomeController extends Controller
{
    
    public function index(){
        $documents = Document::where('agreement_code', '=', Auth::user()->name)->paginate(15);
        $total = Document::where('agreement_code', '=', Auth::user()->name)->get()->count();

        return view('convenant.home')->with([
            'documents' => $documents,
            'total' => $total,
        ]);
    }

}
