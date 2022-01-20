@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

<h1 class="col-md-12">検索条件を入力してください</h1>
<form action="{{ url('/route/serch')}}" method="post">
  {{ csrf_field()}}
  {{method_field('get')}}
  <div class="form-group">
    <label class="col-md-12">路線</label>
    <input type="text" class="form-control col-md-12" placeholder="路線を入力してください" name="route_name">
  </div>
  <button type="submit" class="btn btn-primary col-md-12">検索</button>
</form>
<form action="{{ url('/station/serch')}}" method="post">
  {{ csrf_field()}}
  {{method_field('get')}}
  <div class="form-group">
    <label class="col-md-12">駅名</label>
    <input type="text" class="form-control col-md-12" placeholder="駅名を入力してください" name="station_name">
  </div>
  <button type="submit" class="btn btn-primary col-md-12">検索</button>
</form>
<form action="{{ url('/prefecture/serch')}}" method="post">
  {{ csrf_field()}}
  {{method_field('get')}}
  <div class="form-group">
    <label class="col-md-12">都道府県</label>
    <input type="text" class="form-control col-md-12" placeholder="都道府県を入力してください" name="prefecture_name">
  </div>
  <button type="submit" class="btn btn-primary col-md-12">検索</button>
</form>
@if(session('flash_message'))
<div class="alert alert-primary" role="alert" style="margin-top:50px;">{{ session('flash_message')}}</div>
</div>
</div>
</div>
@endif
@endsection
