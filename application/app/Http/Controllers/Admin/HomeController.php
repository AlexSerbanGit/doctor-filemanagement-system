<?php

namespace App\Http\Controllers\Admin;

use App\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\User;
use App\Charts\DocumentsChart;
use Carbon\Carbon;

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
        $today = Carbon::now();
        
        $this_doc = Document::where('created_at', '>', Carbon::now()->subMonths(1))->get()->count();
        $last_doc = Document::where('created_at', '>', Carbon::now()->subMonths(2))->get()->count();
        $last2_doc = Document::where('created_at', '>', Carbon::now()->subMonths(3))->get()->count();

        $last_doc -= $this_doc;
        $last2_doc -= $last_doc + $this_doc;

        $val_this = $this_doc/$doctors;
        $val_last = $last_doc/$doctors;
        $val_last2 = $last2_doc/$doctors;

        $chart = new DocumentsChart;
        $chart->labels(['Two months ago', 'One month ago', 'This month']);
        $chart->dataset('Documents per doctor', 'line', [$val_last2, $val_last , $val_this]);

        return view('admin.home')->with([
            'admins' => $admins,
            'patients' => $patients, 
            'convenants' => $convenants,
            'doctors' => $doctors,
            'pat_docs' => $pat_docs,
            'conv_docs' => $conv_docs,
            'doc_docs' => $doc_docs,
            'chart' => $chart,
        ]);
    }

    public function cronJob(){
        Artisan::call('demo:cron');

        return redirect()->back()->with('success', 'Cron job done!');
    }

}
