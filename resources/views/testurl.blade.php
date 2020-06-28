@extends('layout.master')
@section('title')

 <title>Test URL'S</title>

@endsection

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
    <h2>Test URL'S</h2>
    <a href="#"><i class="icon-support"></i></a>
</div>
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
    <table class="table table-striped custab">
    <thead>
    <!-- <a href="#" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new categories</a> -->
        <tr>
            <th class="text-center">Test Url</th>
            <th class="text-center">IP</th>
            <th class="text-center">Port</th>
            <th class="text-center">Status</th>
            <th class="text-center">Last Success Time</th>
            <th class="text-center">Last Check</th>
        </tr>
    </thead>
    <tbody>
      @foreach($testurls as $testurl)
      <tr>
            <td class="text-center">{{$testurl['testurl']}}</td>
            <td class="text-center">{{$testurl['ip']}}</td>
            <td class="text-center">{{$testurl['port']}}</td>
            @if($testurl['status'] == 1)         
                  <td class="text-center"><span class="fa fa-check"></span></td>
            @else
                  <td class="text-center"><span class="fa fa-times"></span></td>
            @endif
            <td class="text-center">{{$testurl['success_time']}}</a></td>
            <td class="text-center">{{$testurl['updated_at']}}</a></td>
            <!-- {{substr($testurl['updated_at'], 0, strpos($testurl['updated_at'], ":"))}} -->
        </tr>
      @endforeach
    </tbody>
    </table>
@endsection