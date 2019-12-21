@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-header" style="text-align: center">
                    <i class="fas fa-user" style="font-size: 60px"></i>
                    <h1>Patients: {{$patients}}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-header" style="text-align: center">
                    <i class="fas fa-user-friends" style="font-size: 60px"></i>
                    <h1 style="text-align: center">Convenants: {{$convenants}}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-header" style="text-align: center">
                    <i class="fas fa-user-md" style="font-size: 60px"></i>
                    <h1 style="text-align: center">Doctors: {{$doctors}}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                    <div class="card-header" style="text-align: center">
                        <i class="fas fa-file" style="font-size: 60px"></i>
                        <h1 style="text-align: center">Patient documents: {{$pat_docs}}</h1>
                    </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                    <div class="card-header" style="text-align: center">
                        <i class="fas fa-file" style="font-size: 60px"></i>
                        <h1 style="text-align: center">Convenant documents: {{$conv_docs}}</h1>
                    </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="card">
                    <div class="card-header" style="text-align: center">
                        <i class="fas fa-file" style="font-size: 60px"></i>
                        <h1 style="text-align: center">Doctor documents: {{$doc_docs}}</h1>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection