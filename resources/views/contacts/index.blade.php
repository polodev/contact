@extends('master.master')
@section('content')
<section class="hero is-primary is-bold">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Polo's Contact app
      </h1>
      <h2 class="subtitle">
        Tinkering Laravel
      </h2>
      <p>
        <a class="button" href="/create">Add Contact</a>
      </p>
    </div>
  </div>
</section>
<div class="contactSearch">
  <div class="container">
    <div class="field has-addons">
      <p class="control is-expanded">
        <input class="input" type="text" placeholder="Find a contact">
      </p>
      <p class="control">
        <a class="button is-info">
          Search
        </a>
      </p>
    </div>
  </div>
</div>
<div class="container">
  <div class="contacts">
    @foreach($contacts as $contact)
     <a href="/profile/{{$contact->slug}}" class="contactBox">
      <img src="{{$contact->avatarUrl}}" alt="">
      <div class="contactBox__rightContent">
        <p class="name">{{$contact->name}}</p>
        <p>{{ $contact->city }}</p>
        <p>{{ $contact->mobile }}</p>
      </div>
    </a>
    @endforeach
  </div>
  <div class="contactPaginate">
    {{ $contacts->links() }}
  </div>
</div>
@endsection
