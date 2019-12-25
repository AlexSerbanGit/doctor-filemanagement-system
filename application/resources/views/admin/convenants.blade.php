@extends('layouts.admin')

@section('content')

<div class="container-fluid">
<div class="alert alert-primary">
    <h1>
        Convenants
    </h1>
</div>
<div class="table-responsive">  
    <div class="container">
        <div class="form-group">
            <input placeholder="Search by name, email or phone number" type="text" id="mySearch" name="name" class="form-control">
        </div>
    </div>
<table class="table">
  <thead>
    <tr>
      <th scope="col">@sortablelink('id', 'Id')</th>
      <th scope="col">@sortablelink('name')</th>
      <th scope="col">@sortablelink('email')</th>
      <th>Phone number</th>
      <th scope="col">Reports</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody id="docscontainer">
    @foreach ($users as $key=>$user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->phone_number}}</td>
      <td>{{$user->documents->count()}}</td>
      <td>
        <button class="btn btn-warning" data-toggle="modal" data-target="#editUser{{$user->id}}"><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteUser{{$user->id}}"><i class="fas fa-trash"></i></button>
      </td>
    </tr>

    <div class="modal fade" id="editUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit convenant</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ url('admin/edit_convenant/'.$user->id) }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="{{$user->name}}" placeholder="name" required class="form-control">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="{{$user->email}}" placeholder="email" required class="form-control">
            </div>
            <div class="form-group">
                <label>Phone number:</label>
                <input type="text" name="phone_number" value="{{$user->phone_number}}" placeholder="phone number" required class="form-control">
            </div>
            <div class="form-group">
                <label>Password: (optional)</label>
                <input type="password" name="password" placeholder="password" class="form-control">
            </div>
            {{-- <div class="form-group">
                <label>Email:</label>
                <input type="text" name="email" value="{{$user->email}}" placeholder="email" required class="form-control">
            </div> --}}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Edit convenant</button>
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
            <h5 class="modal-title" id="exampleModalLabel">Delete convenant</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Are you sure you want to <tag-random class="text-danger">delete</tag-random> this convenant?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="{{ url('admin/delete_convenant/'.$user->id) }}">
                <button type="button" class="btn btn-danger">Delete convenant</button>
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
<button class="btn btn-primary" data-toggle="modal" data-target="#addPatient">Add convenant</button>

<!-- Modal -->
<div class="modal fade" id="addPatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new convenant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="{{ url('admin/add_convenant') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" placeholder="name" required class="form-control">
        </div>
        <div class="form-group">
            <label>Phone number:</label>
            <input type="text" name="phone_number" placeholder="phone number" required class="form-control">
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="text" name="email" placeholder="email" required class="form-control">
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" placeholder="password" required class="form-control">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add convenant</button>
    </div>
    </form>
    </div>
</div>
</div>
</div>

<script src="{{ asset('js/core/jquery.min.js')}}"></script>

<script>
nottt = 0;
let myData = 0;

$(document).ready(function(){

    // Get results function
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
    type:'GET',
    url:"{{ url('/api/get_users/3') }}",
    success:function(data){
        // alert(data);
        myData = data;
    }
    });
});
baseUrl = "{{ url('/') }}";
$("#mySearch").on("paste keyup", function() {
    document.getElementById('docscontainer').innerHTML = '';
    console.log(myData);
    numm = 0;

    for(let i=0;i < myData.documents.length;i++){
            console.log(myData.documents[i]);
            name = myData.documents[i].name.toUpperCase();
            email = myData.documents[i].email.toUpperCase();
            if($(this).val() && (name.includes($(this).val().toUpperCase()) || email.includes($(this).val().toUpperCase()))){
                numm++;

                tr = document.createElement('tr');
                document.getElementById('docscontainer').appendChild(tr);

                td = document.createElement('td');
                td.innerHTML = numm;
                td.className = 'text-center';
                tr.appendChild(td);

                td = document.createElement('td');
                td.innerHTML = myData.documents[i].name;
                tr.appendChild(td);

                td = document.createElement('td');
                td.innerHTML = myData.documents[i].email;
                tr.appendChild(td);

                td = document.createElement('td');
                td.innerHTML = myData.documents[i].phone_number;
                tr.appendChild(td);

                td = document.createElement('td');
                td.innerHTML = myData.documents[i].docs;
                tr.appendChild(td);

                td = document.createElement('td');
                tr.appendChild(td);
                button = document.createElement('button');
                button.setAttribute('type', 'button');
                button.setAttribute('class', 'btn btn-warning');
                button.setAttribute('data-toggle', 'modal');
                button.setAttribute('data-target', '#editUser'+myData.documents[i].id);
                td.appendChild(button);
                itag = document.createElement('i');
                itag.setAttribute('class', 'fas fa-edit');
                button.appendChild(itag);

                button = document.createElement('button');
                button.setAttribute('type', 'button');
                button.setAttribute('class', 'btn btn-danger');
                button.setAttribute('data-toggle', 'modal');
                button.setAttribute('data-target', '#deleteUser'+myData.documents[i].id);
                td.appendChild(button);
                itag = document.createElement('i');
                itag.setAttribute('class', 'fas fa-trash');
                button.appendChild(itag);
            }
        }
    });
</script>

@endsection