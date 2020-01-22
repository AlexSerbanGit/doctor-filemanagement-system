@extends('layouts.convenants')

@section('content')

<div class="container-fluid">

    <div class="table-responsive">
        <div class="alert alert-primary">
            <h1>Your documents</h1>
            <h5>(Showing <tag-random id="count">{{$documents->count()}}</tag-random> of {{$total}} documents)</h5> 
            <br>
            <a href="{{ url('/document-search') }}">
                <button type="button" class="btn btn-primary">
                    {{ __('Search documents') }}
                </button>
            </a>
        </div>
        <div class="container">
            <div class="form-group">
                <input placeholder="Search by date or patient name" type="text" id="mySearch" name="name" class="form-control">
            </div>
        </div>
        <form action="{{ url('/zip_files') }}" method="POST">
        @csrf
        <table class="table">
        <thead>
            <tr>
            <th scope="col"></th>
            <th scope="col">@sortablelink('id', 'Id')</th>
            <th scope="col">@sortablelink('title', 'Title')</th>
            <th scope="col">@sortablelink('created_at', 'Receipt date')</th>
            <th>Downloaded</th>
            <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id="docscontainer">
            @foreach ($documents as $key=>$document)                
            <tr>
            <td><input type="checkbox" name="check[{{$document->id}}]"></td>
            <td>{{$document->id}}</td>
            <td scope="col">{{$document->title}}</td>
            <td>{{$document->created_at}}</td>
            <td>@if($document->downloaded == 1) Yes @else No @endif</td>
            <td>
            {{-- <a download="{{$document->id.'.'.$document->extension}}" href="{{ url('/gg/'.$document->id.'.'.$document->extension) }}"><button class="btn btn-success"><i class="fas fa-download"></i></button></a>                <button class="btn btn-danger"><i class="fas fa-trash"></i></button> --}}
            <a href="{{ url('/download_document/'.$document->id) }}">
                <button type="button" class="btn btn-success"><i class="fas fa-download"></i></button>
            </a>            
            </td>     
            </tr>
            @endforeach
        </tbody>
        </table>
            {{$documents->render()}}
            <button class="btn btn-success" style="margin-bottom: 10px"><i class="fas fa-download"></i> Download as zip file</button>
        </form>
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
    url:"{{ url('/api/get_documents/'.Auth::user()->id) }}",
    success:function(data){
        // alert(data);
        myData = data;
        document.getElementById('mySearch').style.display = 'inline-block';
    }
    });
});
baseUrl = "{{ url('/') }}";
$("#mySearch").on("paste keyup", function() {
    document.getElementById('docscontainer').innerHTML = '';
    numm = 0;
    
    if(!$(this).val()){
        for(let i=0;i < myData.documents.length && i < 15;i++){
            // console.log(myData.documents[i]);
            // obj = myData.documents[i];
            // console.log(myData.documents[i].title);

            // name = myData.documents[i]['name'].toUpperCase();
            // email = myData.documents[i].email.toUpperCase();
            // console.log(myData.documents[i]);
            numm++;
            document.getElementById('count').innerHTML = numm;

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
            if(myData.documents[i].downloaded == 0){
                td.innerHTML = 'No';
            }else{
                td.innerHTML = 'Yes';
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
            button.style.marginRight = '5px';
            aa.appendChild(button);
            itag = document.createElement('i');
            itag.setAttribute('class', 'fas fa-download');
            button.appendChild(itag);

        }
    }else{
        for(let i=0;i < myData.documents.length;i++){
            name = myData.documents[i].title.toUpperCase();
            date = myData.documents[i].created_at.toUpperCase()
            if(date.includes($(this).val().toUpperCase()) || name.includes($(this).val().toUpperCase())){
                numm++;
                document.getElementById('count').innerHTML = numm;

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
                if(myData.documents[i].downloaded == 0){
                    td.innerHTML = 'No';
                }else{
                    td.innerHTML = 'Yes';
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
                button.style.marginRight = '5px';
                aa.appendChild(button);
                itag = document.createElement('i');
                itag.setAttribute('class', 'fas fa-download');
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
    }    
    });
</script>
@endsection