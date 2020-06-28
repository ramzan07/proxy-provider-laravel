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
    <h2>Proxy Providers</h2>
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
<div id="msg" class="display-hide">
    <center><span id='msg-text'><span></center>
</div>
@endsection

@section('content')
    <table class="table table-striped custab">
    <thead>
    <!-- <a href="#" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new categories</a> -->
        <tr>
            <th class="text-center">Title</th>
            <th class="text-center">URL</th>
            <th class="text-center">Last update</th>
            <th class="text-center">Last attempt</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
      @foreach($providers as $provider)
      <tr>
            <td class="text-center">{{$provider['title']}}</td>
            <td class="text-center">{{$provider['url']}}</td>
            <td class="text-center">{{$provider['last_update_date']}}</td>
            <td class="text-center">{{$provider['updated_at']}}</td>
            <td class="text-center"><a href="{{route('createProxies', ['id' => $provider['id']])}}">Get Proxies List</a></td>
        </tr>
      @endforeach
    </tbody>
    </table>
@endsection