@extends('layout.master')

@section('page_styles')
<link href="{{asset('public/css/posts.css')}}" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">

<style type="text/css">
  .btn-group-xs>.btn, .btn-xs {
    padding: .70rem .6rem .32rem !important;
    font-size: .875rem;
    line-height: .5;
    border-radius: .2rem;
</style>
@endsection

@section('page_scripts')
<script src="{{asset('public/js/counter.js')}}"></script>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>

<script type="text/javascript">
    function loadProvider(id)
    {
        $.ajax({
            url: '{{route('detailsProvider')}}',
            type: "GET",
            data: {
                'provider_id': id,
            },
            success: function(result) {
                $('#tbody-data').html(result);
                $("#modal-db-details").modal('show');
            }
        });
    }
</script>

<script type="text/javascript">
    function refreshFeeds(id)
    {
        $.ajax({
            url: '{{route('refreshFeed')}}',
            type: "GET",
            data: {
                'provider_id': id,
            },
            success: function(result) {
                if(result == 'time_issue') {
                    $('#msg').show();
                    $('#msg-text').html('Request time is too short (Waiting time is 10 minutes)');
                    $('#msg').removeClass('display-hide').addClass('alert alert-warning display-show');
                }else{
                    $('#msg').show();
                    $('#msg-text').html('success updated');
                    $('#msg').removeClass('alert alert-danger display-show');
                    $('#msg').removeClass('display-hide').addClass('alert alert-success display-show');
                }
                setTimeout(function() {
                        $('#msg').fadeOut('slow');
                    }, 2000);
            }
        });
    }
</script>

<script type="text/javascript">
    $("input:checkbox").on("change", function(event) {
     if($(this).is(":checked")) {
        var status = "1";
     } else {
        var status = "0";
     }
     var id = $(this).attr("value");

    $.ajax({
            url: '{{route('updateProvider')}}',
            type :"PUT",
            data    : {status, id},
            success: function(result) {
                if(result == 'success') {
                        $('#msg').show();
                        $('#msg-text').html('Provider Status Updated');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success display-show');
                        setTimeout(function() {
                            $('#msg').fadeOut('slow');
                        }, 2000);
                  }
            }
    });

    });
</script>

@endsection

@section('page_heading')
<div class="sub-title">
    <h2>RSS Providers</h2>
    <a href="{{route('getProviders')}}"><i class="icon-support"></i></a>
</div>
@endsection

@section('sidebarCards')
<div class="my-detail col"  style="margin-bottom: 0px;">
    <div class="white-spacing">
      <i class="fa fa-code fa-2x"></i>
      <h1 class="timer count-title count-number" data-to="5" data-speed="1500"></h2>
      <h1>News Count</h1>
    </div>
      </div>
<div class="my-detail col"  style="margin-bottom: 0px;">
    <div class="white-spacing">
      <i class="fa fa-code fa-2x"></i>
      <h1 class="timer count-title count-number" data-to="205" data-speed="1500"></h2>
      <h1>News Count</h1>
    </div>
</div>
@endsection

@section('action_buttons')
<div id="msg" class="display-hide">
    <center><span id='msg-text'><span></center>
</div>
@endsection

@section('content')
    <table class="table table-striped custab">
    <thead>
    <!-- <a href="#" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new categories</a> -->
        <tr>
            <th class="text-center">Sr.</th>
            <th class="text-center">Name</th>
            <!-- <th>Source</th> -->
            <th class="text-center">Action</th>
        </tr>
    </thead>
            @foreach($feed_channel as $key=>$channel)
            <tr>
                <td style="width: 2px;">{{++$key}}</td>
                <td>{{$channel['provider_name']}}</td>
                <!-- <td><a>{{$channel['feed_source']}}</a></td> -->
                <td class="text-center" style="width: 200px;"><a onclick="loadProvider({{$channel['id']}})" class='btn btn-info btn-xs' href="#"><span class="icon-eye"></span> View</a>

                <a onclick="refreshFeeds({{$channel['id']}})" class='btn btn-info btn-xs' href="#"><span class="icon-refresh"></span> Refresh</a>

                @php
                    $toogleVal = isset($channel['status']) && $channel['status'] == 1 ? 'checked' : '';
                @endphp
                <input type="checkbox" id="providerStatus" value="{{$channel['id']}}" {{$toogleVal}} data-toggle="toggle" data-size="xs">
                </td>
         	</tr>
            @endforeach
    </table>

<!--  -->
<div class="modal fade" id="modal-db-details" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center" style="width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h4 class="modal-title" id="myModalLabel">Provider Details</h4>

                </div>
                <div class="modal-body"><div id ="tbody-data"></div></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection