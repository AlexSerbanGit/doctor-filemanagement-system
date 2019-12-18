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
            <tr>
                <th scope="row">1</th>
                <td>image1.png</td>
                <td>
                    <button class="btn btn-success"><i class="fas fa-download"></i></button>
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        </tbody>
        </table>

        <button class="btn btn-success"><i class="fas fa-eye"></i> See document </button>
    </div>

</div>

@endsection