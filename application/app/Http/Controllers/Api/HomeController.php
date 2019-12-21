<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Document;

class HomeController extends Controller
{
    
    public function documents(){
        $documents = Document::all();

        return response()->json([
            'documents' => $documents,
        ]);
    }

}
