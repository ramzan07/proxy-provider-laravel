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

@endsection

@section('page_heading')
<div class="sub-title">
    <h2>Test Url</h2>
    <a href="#"><i class="icon-support"></i></a>
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
            <th class="text-center">Test Url</th>
            <th class="text-center">IP</th>
            <th class="text-center">Port</th>
            <th class="text-center">Status</th>
            <th class="text-center">Last Success Time</th>
            <th class="text-center">Created at</th>
            <th class="text-center">Last Chechk</th>
        </tr>
    </thead>
    <tbody>
      @foreach($testurls as $testurl)
      <tr>
            <td class="text-center">{{$testurl['testurl']}}</td>
            <td class="text-center">{{$testurl['ip']}}</td>
            <td class="text-center">{{$testurl['port']}}</td>
            <td class="text-center">{{$testurl['status']}}</td>
            <td class="text-center">success_time</a></td>
            <td class="text-center">created_at</a></td>
            <td class="text-center">updated_at</a></td>
        </tr>
      @endforeach
    </tbody>
    </table>
@endsection