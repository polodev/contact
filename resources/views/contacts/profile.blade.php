@extends('master.master')
@section('content')
    <div class="container">
      <div class="singleContact">
        <div class="box">
          <img src="{{$contact->avatarUrl}}" alt="">
          <p> <strong>{{ $contact->name }}</strong></p>
          <p class="city">{{ $contact->city }}</p>
          <p>
            <strong>Relation:</strong>
            {{ $contact->relation }}
          </p>
          <p>
            <strong>Address:</strong>
            {{ $contact->address }}
          </p>
          <p>
            <strong>Designation:</strong>
            {{ $contact->designation }}
          </p>
          <p>
            <strong>Mobile:</strong>
            {{ $contact->mobile }}
          </p>
          <p>
            <strong>email:</strong>
            {{ $contact->email }}
          </p>
          <p>
            <strong>facebook:</strong>
            <a href="{{ $contact->facebook }}">
              {{ $contact->facebook }}
            </a>
          </p>
          <p>
            <strong>twitter:</strong>
            <a href="{{ $contact->twitter }}">
              {{ $contact->twitter }}
            </a>
          </p>
          <p>
            <strong>linkedIn:</strong>
            <a href="{{ $contact->linkedin }}">
              {{ $contact->linkedin }}
            </a>
          </p>
          <div class="mnemonics">
            <p class="title">About</p>
            {!! $contact->about !!}
          </div>
          <div class="editDelete">
            <div>
              <a class="button is-info" href="/profile/{{$contact->slug}}/edit"> Edit</a>
            </div>
            <div>
              <form action="/profile/delete" method="post">
                {{csrf_field()}}
                <input type="hidden" name="id" id="{{$contact->id}}">
                <input type="submit" class="button is-danger" value="Delete">
              </form>
            </div>
          </div>
        </div>
        <div class="box">
          <div class="status">
            <div class="status_header">
              <h2 class="title">Status</h2>
              <a href="#" class="button is-primary">Add Status</a>
            </div>
            <div class="single_status">
              <strong>april 12, 2017 -</strong>
              Talked about visa related stuff
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
