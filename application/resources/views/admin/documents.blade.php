@extends('layouts.admin')

@section('content')

    <div class="container-fluid">
        
        <div class="alert alert-primary">
            <h1>
                Documents
            </h1>
        </div>
        {{-- <input type="text" id="searchh" class="form-control" > --}}
        <div class="container">
            <div class="form-group">
                <input placeholder="Search by date or patient name" type="text" id="mySearch" name="name" class="form-control">
            </div>
        </div>
        <div class="table-responsive">
            <form action="{{ url('/zip_files') }}" method="POST">
            @csrf
            <table class="table">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">@sortablelink('id', 'Id')</th>
                    <th scope="col">@sortablelink('title', 'Title')</th>
                    <th scope="col">@sortablelink('created_at', 'Receipt date')</th>
                    <th scope="col">@sortablelink('role_id', 'Type')</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody id="docscontainer">
                @foreach($documents as $key=>$document)
                <tr>
                    <th><input type="checkbox" name="check[{{$document->id}}]"></th>
                    <th scope="row">{{$document->id}}</th>
                    <td>{{$document->title}}</td>
                    <td>{{$document->created_at}}</td>
                    <td>@if($document->role_id == 2) Patient @elseif($document->role_id == 3) Convenant @elseif($document->role_id == 4) Doctor @endif</td>
                    <td>    
                        {{-- <a download="{{$document->id.'.'.$document->extension}}" href="{{ url('/gg/'.$document->id.'.'.$document->extension) }}"><button type="button" class="btn btn-success"><i class="fas fa-download"></i></button></a>   --}}
                        {{-- <a download="{{$document->id.'.'.$document->extension}}" href="{{ url('/gg/'.$document->id.'.'.$document->extension) }}"><button class="btn btn-success"><i class="fas fa-download"></i></button></a>                <button class="btn btn-danger"><i class="fas fa-trash"></i></button> --}}
                        <a href="{{ url('/download_document/'.$document->id) }}">
                            <button type="button" class="btn btn-success"><i class="fas fa-download"></i></button>
                        </a>
                        <a href="{{ url('admin/delete_document/'.$document->id) }}"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                    </td>
                </tr>
                @endforeach
                
                </tbody>
            </table>
            {{$documents->render()}}
            <button class="btn btn-success" style="margin-bottom: 10px"><i class="fas fa-download"></i> Download as zip file</button>
            </form>
            <a href="{{ url('/admin/run_cron_job') }}">
                <button class="btn btn-warning" style="color: white"><i class="fas fa-redo"></i> Run Cron Job NOW</button>
            </a>
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
    url:"{{ url('/api/get_documents') }}",
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
            name = myData.documents[i].patient_name.toUpperCase();
            date = myData.documents[i].created_at.toUpperCase()
            if(date.includes($(this).val().toUpperCase()) || name.includes($(this).val().toUpperCase())){
                numm++;

                tr = document.createElement('tr');
                document.getElementById('docscontainer').appendChild(tr);
                td = document.createElement('td');
                tr.appendChild(td);

                td = document.createElement('td');
                td.innerHTML = numm;
                td.className = 'text-center';
                tr.appendChild(td);

                td = document.createElement('td');
                td.innerHTML = myData.documents[i].title;
                tr.appendChild(td);

                td = document.createElement('td');
                td.innerHTML = myData.documents[i].created_at;
                tr.appendChild(td);

                td = document.createElement('td');
                if(myData.documents[i].role_id == 2){
                    td.innerHTML = 'Patient';
                }
                if(myData.documents[i].role_id == 3){
                    td.innerHTML = 'Convenant';
                }
                if(myData.documents[i].role_id == 4){
                    td.innerHTML = 'Doctor';
                }
                tr.appendChild(td);

                td = document.createElement('td');
                tr.appendChild(td);
                aa = document.createElement('a');
                aa.setAttribute('href', baseUrl+'/download_document/'+myData.documents[i].id);
                td.appendChild(aa);
                button = document.createElement('button');
                button.setAttribute('type', 'button');
                button.setAttribute('class', 'btn btn-success');
                aa.appendChild(button);
                itag = document.createElement('i');
                itag.setAttribute('class', 'fas fa-download');
                button.appendChild(itag);
                
                aa = document.createElement('a');
                aa.setAttribute('href', baseUrl+'/admin/delete_document/'+myData.documents[i].id);
                td.appendChild(aa);
                button = document.createElement('button');
                button.setAttribute('type', 'button');
                button.setAttribute('class', 'btn btn-danger');
                aa.appendChild(button);
                itag = document.createElement('i');
                itag.setAttribute('class', 'fas fa-trash');
                button.appendChild(itag);

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