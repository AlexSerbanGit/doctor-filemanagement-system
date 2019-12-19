<?php

namespace App\Console\Commands;

use App\Document;
use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Storage;
use File;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

        \Log::info("Cron is working fine!");
        $this->info('Demo:Cron Cummand Run successfully!');
        $filess =File::allFiles(public_path('gallery'));
        foreach (File::allFiles(public_path('gallery')) as $key=>$file) {
            
            \Log::info(explode('#', $filess[$key]->getRelativePathname()));

            $strr = explode('#', $filess[$key]->getRelativePathname());

            if(strpos($strr[0], '_T') !== false){
                \Log::info('patient file');
                $document = new Document;
                $document->title = $filess[$key]->getRelativePathname();
                $document->extension = File::extension($file);
                $document->role_id = 2;
                $document->patient_name = $strr[1];
                $document->patient_protocol = $strr[3];
                $last = explode('.', $strr[4]);
                $document->patient_password = $last[0];
                $document->save();
                $move = File::move(public_path('gallery\\'.$filess[$key]->getRelativePathname()), public_path('\gg\\'.$document->id.'.'.File::extension($file)));

            }elseif(strpos($strr[0], '_C') !== false){
                \Log::info('convenant file');
                $document = new Document;
                $document->title = $filess[$key]->getRelativePathname();
                $document->extension = File::extension($file);
                $document->role_id = 2;
                $document->patient_name = $strr[1];
                $last = explode('.', $strr[3]);
                $document->agreement_code = $last[0];
                $document->save();
                $move = File::move(public_path('gallery\\'.$filess[$key]->getRelativePathname()), public_path('\gg\\'.$document->id.'.'.File::extension($file)));

            }elseif(strpos($strr[0], '_M') !== false){
                \Log::info('doctor file');
                $document = new Document;
                $document->title = $filess[$key]->getRelativePathname();
                $document->extension = File::extension($file);
                $document->role_id = 2;
                $document->patient_name = $strr[1];
                $last = explode('.', $strr[3]);
                $document->doctor_code = $last[0];
                $document->save();
                $move = File::move(public_path('gallery\\'.$filess[$key]->getRelativePathname()), public_path('\gg\\'.$document->id.'.'.File::extension($file)));

            }

            // do whatever with $file;
        }

    }
}
