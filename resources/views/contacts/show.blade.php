@extends('master.master')
@section('content')
    <div class="container">
      <div class="singleContact">
        <div class="box">
          <img src="{{$contact->avatarUrl}}" alt="">
          <p> <strong>{{ $contact->name }}</strong></p>
          <p class="city">{{ $contact->city }}</p>

          @if ($contact->relation)
            <p>
              <strong>Relation:</strong>
              {{ $contact->relation }}
            </p>
          @endif
          @if ($contact->address)
            <p>
              <strong>Address:</strong>
              {{ $contact->address }}
            </p>
          @endif
          @if ($contact->designation)
            <p>
              <strong>Designation:</strong>
              {{ $contact->designation }}
            </p>
          @endif
          @if ($contact->mobile)
            <p>
              <strong>Mobile:</strong>
              {{ $contact->mobile }}
            </p>
          @endif
          @if ($contact->email)
            <p>
              <strong>email:</strong>
              {{ $contact->email }}
            </p>
          @endif
          @if ($contact->facebook)
            <p>
              <strong>facebook:</strong>
              <a href="{{ $contact->facebook }}">
                {{ $contact->facebook }}
              </a>
            </p>
          @endif
          @if ($contact->twitter)
            <p>
              <strong>twitter:</strong>
              <a href="{{ $contact->twitter }}">
                {{ $contact->twitter }}
              </a>
            </p>
          @endif
          @if ($contact->linkedin)
            <p>
              <strong>linkedIn:</strong>
              <a href="{{ $contact->linkedin }}">
                {{ $contact->linkedin }}
              </a>
            </p>
          @endif
            <div class="mnemonics">
              <p class="title">About</p>
              @if ($contact->about)
                {!! $contact->about !!}
              @else
                <p>Nothing know about {{$contact->name}}?</p>
              @endif
            </div>
          <div class="editDelete">
            <div>
              <a class="button is-info" href="/profile/{{$contact->slug}}/edit"> Edit</a>
            </div>
            <div>
              <form class="deleteContact" action="/profile/{{$contact->slug}}" method="post">
                {{csrf_field()}}
                {{ method_field('DELETE') }}
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
    @section('bottom_script')
      <script>
        $(".deleteContact").on("submit", function(){
          return confirm("Do you want to delete this item?");
      });
      </script>
    @endsection

@endsection
