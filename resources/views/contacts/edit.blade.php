@extends('master.master')
@section('content')
    <div class="container formpage">
      <h1 class="title">create a contact</h1>
      <div class="box">
        <edit-contact :contact="{{$contact}}"></edit-contact>
      </div>
    </div>
@endsection
