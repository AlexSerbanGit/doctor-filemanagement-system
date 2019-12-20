@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        
        <div class="alert alert-primary">
            <h1>
                Documents
            </h1>
        </div>

        <div class="table-responsive">
            <form action="{{ url('/zip_files') }}" method="POST">
            @csrf
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($documents as $key=>$document)
                <tr>
                    <th><input type="checkbox" name="check[{{$document->id}}]"></th>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$document->title}}</td>
                    <td>@if($document->role_id == 2) Patient @elseif($document->role_id == 3) Convenant @elseif($document->role_id == 4) Doctor @endif</td>
                    <td>    
                        <a download="{{$document->id.'.'.$document->extension}}" href="{{ url('/gg/'.$document->id.'.'.$document->extension) }}"><button type="button" class="btn btn-success"><i class="fas fa-download"></i></button></a>  
                        <a href="{{ url('admin/delete_document/'.$document->id) }}"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                    </td>
                </tr>
                @endforeach
                
                </tbody>
            </table>
            <button class="btn btn-success" style="margin-bottom: 10px"><i class="fas fa-download"></i> Download as zip file</button>
            </form>
            <a href="{{ url('/admin/run_cron_job') }}">
                <button class="btn btn-warning" style="color: white"><i class="fas fa-redo"></i> Run Cron Job NOW</button>
            </a>
        </div>

    </div>

@endsection