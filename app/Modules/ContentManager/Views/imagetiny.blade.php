@extends('layouts.blank')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">Panel heading without title</div>
  <div class="panel-body">
  	<div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    <input type="hidden" value="https://laravel.com/assets/img/laravel-logo.png">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Check me out
    </label>
  </div>
  <button onclick="top.tinymce.activeEditor.insertContent('<img src=\'https://laravel.com/assets/img/laravel-logo.png\' /> ');" class="btn btn-default">Submit</button>  
    <button onclick="top.tinymce.activeEditor.windowManager.getWindows()[0].close();">Close window</button>
  </div>
</div>
@endsection