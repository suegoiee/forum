@title('Users')

@extends('layouts.default')

@section('content')
    <div class="container" id="CanvasBaseMap" style="padding-top: 65px;">
        @foreach($experts as $expert)
            <div class="card" style="width:25%; position:relative; float:left; margin:4%;">
                <div class="card-img-top">
                    <a href="{{route('experts.profile', $expert->id)}}">
                        {!!$expert->image!!}
                    </a>
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{$expert->expert_name}}</h4>
                    <p class="card-text">{{$expert->short_intro}}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
