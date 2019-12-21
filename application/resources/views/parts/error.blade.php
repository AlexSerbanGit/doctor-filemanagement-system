@if(Session::has('error'))
<div class="container-fluid">
    <div class="alert alert-danger">{{Session::get('error')}}</div>
</div>
@endif