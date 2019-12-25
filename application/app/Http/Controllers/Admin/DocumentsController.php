<?php

namespace App\Http\Controllers\Admin;

use App\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    
    public function index(){

        $documents = Document::sortable()->paginate(15);

        return view('admin.documents')->with([
            'documents' => $documents,
        ]);

    }

    public function delete($id){

        $document = Document::find($id);

        if($document){
            $document->delete();

            return redirect()->back()->with('success', 'Document deleted');
        }

        return redirect()->back()->with('error','This document was not found');

    }

}
