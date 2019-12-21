@extends('layouts.app')

@section('content')
    
@include('parts/success')
@include('parts/error')

<div class="container">
<button class="btn btn-success" data-toggle="modal" data-target="#viewDocument"><i class="fas fa-eye"></i> See document </button>
    
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
    <form action="{{ url('/search-document') }}" method="POST">
    @csrf
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
        <button type="submit" class="btn btn-success">Search <i class="fas fa-search"></i></button>
    </div>
    </form>
    </div>
</div>
</div>



@if(isset($documents))

@foreach ($documents as $document)

<div class="alert alert-success" style="margin-top: 10px">
    {{$document->title}} <a  style="position: absolute;right: 10px; top: 5px" download="{{$document->id.'.'.$document->extension}}" href="{{ url('/gg/'.$document->id.'.'.$document->extension) }}"><button class="btn btn-success"><i class="fas fa-download"></i></button></a>
</div>

@endforeach

@auth
<a href="{{ url('/add_to_your_account/'.$document->patient_protocol.'/'.$document->patient_password) }}">
<button style="color: white" class="btn btn-warning">
    <i class="fas fa-plus"></i> Save files on your account
</button>
</a>
@endauth
@endif
</div>

@endsection