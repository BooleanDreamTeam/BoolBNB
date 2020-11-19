@extends('layouts.extranet')   

@section('content')

@foreach($allmessages as $message )                     
  <a class="messages dropdown-item d-flex align-items-center" href="">
      <div class="dropdown-list-image mr-3">
          <img class="rounded app-img" src="{{$message->imgurl}}" alt="">
          <div class="status-indicator bg-success"></div>
      </div>
      <div class="message-text">
          <div class="text">
              <p class="text-wrap">{{$message->message}}</p>
          </div>
          <div class="small text-gray-500">{{$message->email}}</div>
      </div>
  </a>
@endforeach

@endsection