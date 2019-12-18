<?php

namespace App\Http\Controllers\Convenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index(){
        return view('convenant.home');
    }

}
