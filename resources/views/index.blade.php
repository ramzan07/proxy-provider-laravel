@extends('layout.master')
@section('title')

 <title>RSS Posts</title>

@endsection

@section('page_styles')
<link href="{{asset('public/css/posts.css')}}" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
    .not-active {
    pointer-events: none;
    cursor: default;
    text-decoration: none;
    color: red;
}

.not-allowed {cursor: not-allowed;}
</style>
<style type="text/css">
  table.dataTable thead .sorting,
table.dataTable thead .sorting_asc,
table.dataTable thead .sorting_desc {
    background : none;
}
}
</style>

@endsection

@section('page_scripts')
<script src="{{asset('public/js/counter.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>



@endsection

@section('sidebarCards')
<div class="my-detail col"  style="margin-bottom: 0px;">
    <div class="white-spacing">
      <i class="icon-envelope fa-2x"></i>
      <h1 class="timer count-title count-number" data-to="50" data-speed="1500"></h2>
      <h1>Providers</h1>
    </div>
      </div>
<div class="my-detail col"  style="margin-bottom: 0px;">
    <div class="white-spacing">
      <i class="icon-support fa-2x"></i>
      <h1 class="timer count-title count-number" data-to="70" data-speed="1500"></h2>
      <h1>Posts</h1>
    </div>
</div>
@endsection

@section('page_heading')
<div class="sub-title">
    <h2>RSS Feeds</h2>
    <a href="#"><i class="icon-envelope"></i></a>
</div>
@endsection

@section('action_buttons')
@if(Session::has('success_message'))
    <div class="alert alert-success" id="message">
        <center><strong>Success!</strong> {{Session::get('success_message')}} </center>
    </div>
    @endif
    @if(Session::has('warning_message'))
    <div class="alert alert-warning" id="message">
        <strong>Warning!</strong> {{Session::get('warning_message')}}
    </div>   
    @endif
    @if(Session::has('error_message'))
    <div class="alert alert-danger" id="message">
        <strong>Danger!</strong> {{Session::get('error_message')}}
    </div>
@endif

@endsection

@section('content')
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Updated_at</th>
            </tr>
        </thead>
        <tbody>
          @foreach($proxiesData as $data)
            <tr>
                <td>{{$data['ip']}}</td>
                <td>{{$data['port']}}</td>
                <td>{{$data['type']}}</td>
                <td>{{$data['check_timestamp']}}</td>
                <td>{{$data['created_at']}}</td>
                <td>{{$data['updated_at']}}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>

@endsection