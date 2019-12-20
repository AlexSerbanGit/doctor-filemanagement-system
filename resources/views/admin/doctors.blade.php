@extends('layouts.admin')

@section('content')

<div class="container-fluid">
<div class="alert alert-primary">
    <h1>
        Doctors
    </h1>
</div>
<div class="table-responsive">  
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Reports</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $key=>$user)
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>0</td>
      <td>
        <button class="btn btn-warning" data-toggle="modal" data-target="#editUser{{$user->id}}"><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteUser{{$user->id}}"><i class="fas fa-trash"></i></button>
      </td>
    </tr>

    <div class="modal fade" id="editUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit doctor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ url('admin/edit_doctor/'.$user->id) }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="{{$user->name}}" placeholder="name" required class="form-control">
            </div>
            {{-- <div class="form-group">
                <label>Email:</label>
                <input type="text" name="email" value="{{$user->email}}" placeholder="email" required class="form-control">
            </div> --}}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Edit doctor</button>
        </div>
        </form>
        </div>
    </div>
    </div>

    <!-- Modal delete -->
    <div class="modal fade" id="deleteUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete doctor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Are you sure you want to <tag-random class="text-danger">delete</tag-random> this doctor?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="{{ url('admin/delete_doctor/'.$user->id) }}">
                <button type="button" class="btn btn-danger">Delete doctor</button>
            </a>
            </div>
        </div>
        </div>
    </div>
    @endforeach
  </tbody>
</table>
{{$users->render()}}
</div>  
<button class="btn btn-primary" data-toggle="modal" data-target="#addPatient">Add doctor</button>

<!-- Modal -->
<div class="modal fade" id="addPatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new doctor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="{{ url('admin/add_doctor') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" placeholder="name" required class="form-control">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="text" name="email" placeholder="email" required class="form-control">
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="text" name="password" placeholder="password" required class="form-control">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add doctor</button>
    </div>
    </form>
    </div>
</div>
</div>
</div>

@endsection