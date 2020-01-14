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

        // TOTAL CHART CALCULATIONS

        // current month starting day (01 jan for example)
        $start = new Carbon('last day of last month');
        $this_doc = Document::where('created_at', '>', $start)->get()->count();
        // current month name (Jan, Feb)
        $start_name = $start->format('M');

        // last month starting day
        $last = $start;
        $last->subMonths(1);
        $last_doc = Document::where('created_at', '>', $last)->get()->count();
        // last month name (Jan, Feb)
        $last_name = $last->format('M');

        // the month before last month starting day
        $last2 = $last;
        $last2->subMonths(1);
        $last2_doc = Document::where('created_at', '>', $last2)->get()->count();
        // the month before last month name
        $last2_name = $last2->format('M'); 

        // 2 months before last month starting day
        $last3 = $last2;
        $last3->subMonths(1);
        $last3_doc = Document::where('created_at', '>', $last3)->get()->count();
        // 2 months before last month name
        $last3_name = $last3->format('M'); 

        $admins = User::where('role_id', '=', 1)->get()->count();
        $patients = User::where('role_id', '=', 2)->get()->count();
        $convenants = User::where('role_id', '=', 3)->get()->count();
        $doctors = User::where('role_id', '=', 4)->get()->count();

        $pat_docs = Document::where('role_id', '=', 2)->get()->count();
        $conv_docs = Document::where('role_id', '=', 3)->get()->count();
        $doc_docs = Document::where('role_id', '=', 4)->get()->count();

        // Fixing the numbers
        $last_doc -= $this_doc;
        $last2_doc -= $last_doc + $this_doc;
        $last3_doc -= $last2_doc + $last_doc + $this_doc;

        // Calculation per doctor chart
        $docs = User::where('role_id', '=', 4)->get();
        $names[0] = '0';
        $docs_array[0] = 0;
        foreach($docs as $i=>$doc){

            // starting date of docs >= first date of current month
            $start = new Carbon('last day of last month');
            
            // get doctor docs in current month
            // $doctor_docs = Document::where('doctor_code', '=', $doc->name)->where('created_at', '>', $start)->get()->count();
            $doctor_docs = Document::where('doctor_code', '=', $doc->name)->get()->count();

            $names[$i] = $doc->name;
            $docs_array[$i] = $doctor_docs;

        }


        // Chart total
        $chart = new DocumentsChart;
        $chart->labels([$start_name, $last_name , $last2_name, $last3_name]);
        $chart->dataset('Total documents per months', 'line', [$this_doc, $last_doc , $last2_doc, $last3_doc])->color('yellow')->fill(1)->backgroundColor('#1073CB');

        // Chart with details for each doctor in current month
        $chart2 = new DocumentsChart;
        $chart2->labels($names);
        $chart2->dataset('Documents per doctor this month', 'line', $docs_array)->color('yellow')->fill(1)->backgroundColor('#1073CB');

        return view('admin.home')->with([
            'admins' => $admins,
            'patients' => $patients, 
            'convenants' => $convenants,
            'doctors' => $doctors,
            'pat_docs' => $pat_docs,
            'conv_docs' => $conv_docs,
            'doc_docs' => $doc_docs,
            'chart' => $chart,
            'chart2' => $chart2,
        ]);
    }

    public function cronJob(){
        Artisan::call('demo:cron');

        return redirect()->back()->with('success', 'Cron job done!');
    }

}
