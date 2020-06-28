@extends('layout.master')
@section('title')

 <title>Proxy Lists</title>

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


<script type="text/javascript">
    function testUrl(id, ip, port)
    {
        $.ajax({
            url: '{{route('getUrl')}}',
            type: "GET",
            data: {
                'provider_id': id,
                'ip': ip,
                'port': port
            },
            success: function(result) {
                //alert(result);
                $('#tbody-data').html(result);
                $('#modal-db-details').modal('toggle');
                $("#modal-db-details").modal('show');
            }
        });
    }
</script>



@endsection

@section('sidebarCards')
<div class="my-detail col"  style="margin-bottom: 0px;">
    <div class="white-spacing">
      <i class="icon-envelope fa-2x"></i>
      <h1 class="timer count-title count-number" data-to="{{$providersCount}}" data-speed="1500"></h2>
      <h1>Providers</h1>
    </div>
      </div>
<div class="my-detail col"  style="margin-bottom: 0px;">
    <div class="white-spacing">
      <i class="icon-support fa-2x"></i>
      <h1 class="timer count-title count-number" data-to="{{$proxiesCount}}" data-speed="1500"></h2>
      <h1>Proxies</h1>
    </div>
</div>
<div class="my-detail col"  style="margin-bottom: 0px;">
    <div class="white-spacing">
      <i class="icon-support fa-2x"></i>
      <h1 class="timer count-title count-number" data-to="{{$testUrlCount}}" data-speed="1500"></h2>
      <h1>Test URL'S</h1>
    </div>
</div>
@endsection

@section('page_heading')
<div class="sub-title">
    <h2>Proxy Lists</h2>
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
<form action="{{route('proxies')}}" method="GET">

        <div class="col-sm-6">
            <select name="channel_id" id="channel" class="form-control" id="exampleFormControlSelect1">
                <option value="">Select a Provider</option>
                @foreach($proxy_channels as $channel)
                @php
                    $provider = isset($_GET['channel_id']) ? $_GET['channel_id'] : '';
                    $val = isset($channel->id) && $channel->id == $provider ? 'selected' : '';
                @endphp
                <option value="{{$channel->id}}" {{$val}}>{{$channel->title}}</option>
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
    <input style = "position:relative; top:-75px;" class="btn btn-primary form-group form-control"  type="submit" value="Refresh &nbsp; &#8634;">
</div>
</form>
@endsection

@section('content')
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>IP</th>
                <th>Port</th>
                <th>Last Check</th>
                <th>Start date</th>
                <th>Updated_at</th>
                <th>Test Url</th>
            </tr>
        </thead>
        <tbody>
          @foreach($proxiesData as $data)
            <tr>
                <td>{{$data['ip']}}</td>
                <td>{{$data['port']}}</td>
                <td>{{$data['check_timestamp']}}</td>
                <td>{{$data['created_at']}}</td>
                <td>{{$data['updated_at']}}</td>
                <td class="text-center" style="width: 200px;"><a onclick="testUrl({{$data['id']}}, '{{$data['ip']}}', '{{$data['port']}}')" class='btn btn-info btn-xs' href="#"><span class="icon-eye"></span> Test</a>
            </tr>
          @endforeach
        </tbody>
    </table>
<div class="modal fade" id="modal-db-details" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Test Proxy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('testIP') }}">
          {{ csrf_field() }}
          <div id ="tbody-data"></div>
          <br>
          <center><input class="btn btn-primary"  type="submit" value="Test"></center>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection