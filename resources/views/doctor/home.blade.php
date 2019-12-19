@extends('layouts.doctor')

@section('content')

<div class="container-fluid">

    <div class="table-responsive">
        <div class="alert alert-primary">
            <h1>Your documents</h1>
        </div>
        <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Auth::user()->documents as $document)                
            <tr>
            <th scope="col">#</th>
            <th scope="col">{{$document->title}}</th>
            <td>
                <a download="{{$document->id.'.'.$document->extension}}" href="{{ url('/gg/'.$document->id.'.'.$document->extension) }}"><button class="btn btn-success"><i class="fas fa-download"></i></button></a>                {{-- <button class="btn btn-danger"><i class="fas fa-trash"></i></button> --}}
            </td>            
            </tr>
            @endforeach
        </tbody>
        </table>

        {{-- <a href="{{ url('/document-search') }}"><button class="btn btn-success"><i class="fas fa-eye"></i> See document </button></a> --}}
    
        <!-- Modal -->
        <div class="modal fade" id="viewDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal view document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Document protocol:</label>
                    <input type="text" placeholder="protocol" name="protocol" required class="form-control">
                </div>
                <div class="form-group">
                    <label>Document password:</label>
                    <input type="text" placeholder="password" name="password" required class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Search <i class="fas fa-search"></i></button>
            </div>
            </div>
        </div>
        </div>
        
    </div>

</div>

@endsection