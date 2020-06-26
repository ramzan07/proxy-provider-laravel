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

<script type="text/javascript">
  $('#example').dataTable( {
  "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
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
<form action="{{route('proxies')}}" method="POST">

        <div class="col-sm-6">
            <select name="channel_id" id="channel" class="form-control" id="exampleFormControlSelect1">
                <option value="">Select a Provider</option>
                @foreach($proxy_channels as $channel)
                @php
                    $provider = isset($_GET['channel_id']) ? $_GET['channel_id'] : '';
                    $val = isset($channel->id) && $channel->id == $provider ? 'selected' : '';
                @endphp
                <option value="{{$channel->id}}" selected="{{$val}}">{{$channel->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <input class="btn btn-primary form-group form-control" id="searchChannel"  type="submit" value="Search">
        </div>
</form>
<form action="{{route('createProxies')}}" method="GET">
  <div class="col-sm-9"></div>
  <div class="col-sm-3">
    <input type="hidden"  value="all" name="updateAll">
    <input style = "position:relative; top:-75px;" class="btn btn-primary form-group form-control"  type="submit" value="Refresh Feed &nbsp; &#8634;">
</div>
</form>
@endsection

@section('content')
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>IP</th>
                <th>Port</th>
                <th>Type</th>
                <th>Last Check</th>
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
    </table>

@endsection