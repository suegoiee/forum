@title('Users')

@extends('layouts.default')

@section('content')
    <div class="container" id="CanvasBaseMap" style="padding-top: 65px;">
        @foreach($experts as $expert)
            <div class="card" style="width:25%; position:relative; float:left; margin:4%;">
                <a href="{{route('experts.profile', $expert->id)}}">
                    <img class="card-img-top" src="{{$expert->avatar}}" alt="Card image" style="width:100%">
                </a>
                <div class="card-body">
                    <h4 class="card-title">{{$expert->expert_name}}</h4>
                    <p class="card-text">{{$expert->short_intro}}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
