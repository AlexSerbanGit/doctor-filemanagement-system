@extends('layouts.admin')

@section('content')

<div class="container-fluid">
<div class="alert alert-primary">
    <h1>Patients</h1>
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
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th>Phone number</th>
      <th scope="col">Reports</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody id="docscontainer">
    @foreach ($users as $key=>$user)
    <tr>
      <th scope="row">{{$key+1}}</th>
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
            <h5 class="modal-title" id="exampleModalLabel">Edit patient</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ url('admin/edit_patient/'.$user->id) }}" method="POST">
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
            <button type="submit" class="btn btn-primary">Add patient</button>
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
            <h5 class="modal-title" id="exampleModalLabel">Delete patient</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            Are you sure you want to <tag-random class="text-danger">delete</tag-random> this patient?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <a href="{{ url('admin/delete_patient/'.$user->id) }}">
                <button type="button" class="btn btn-danger">Delete patient</button>
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
<button class="btn btn-primary" data-toggle="modal" data-target="#addPatient">Add patient</button>

<!-- Modal -->
<div class="modal fade" id="addPatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new patient</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form action="{{ url('admin/add_patient') }}" method="POST">
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
        <button type="submit" class="btn btn-primary">Add patient</button>
    </div>
    </form>
    </div>
</div>
</div>
</div>

<script src="{{ asset('js/core/jquery.min.js')}}"></script>

<script>
document.getElementById('mySearch').style.display = 'none';

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
    url:"{{ url('/api/get_users/2') }}",
    success:function(data){
        // alert(data);
        myData = data;
    }
    });
    document.getElementById('mySearch').style.display = 'inline-block';

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
            if(name.includes($(this).val().toUpperCase()) || email.includes($(this).val().toUpperCase())){
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

                // td = document.createElement('td');
                // if(myData.documents[i].role_id == 2){
                //     td.innerHTML = 'Patient';
                // }
                // if(myData.documents[i].role_id == 3){
                //     td.innerHTML = 'Convenant';
                // }
                // if(myData.documents[i].role_id == 4){
                //     td.innerHTML = 'Doctor';
                // }
                // tr.appendChild(td);

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
                
                // aa = document.createElement('a');
                // aa.setAttribute('href', baseUrl+'/admin/delete_document/'+myData.documents[i].id);
                // td.appendChild(aa);
                // button = document.createElement('button');
                // button.setAttribute('type', 'button');
                // button.setAttribute('class', 'btn btn-danger');
                // aa.appendChild(button);
                // itag = document.createElement('i');
                // itag.setAttribute('class', 'fas fa-trash');
                // button.appendChild(itag);

                // td = document.createElement('td');
                // // td.innerHTML = 'Diamante';
                // td.className = 'text-right';
                // tr.appendChild(td);

                // button = document.createElement('button');
                // button.className = 'btn btn-info';
                // button.setAttribute('data-toggle', 'modal');
                // button.setAttribute('data-target', '#addDiamonds'+myData.users[i].id);
                // button.style.padding = '10px';

                // itag = document.createElement('i');
                // itag.className = 'far fa-gem';
                // itag.style.fontSize = '18px';

                // button.appendChild(itag);
                // td.appendChild(button);

                // td = document.createElement('td');
                // td.innerHTML = myData.users[i].email;
                // td.className = 'text-right';
                // tr.appendChild(td);

                // console.log(myData.documents[i]);
            }
        }
    });
</script>

@endsection