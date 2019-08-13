@title($expert->expert_name)

@extends('layouts.default')

@section('content')
    <div class="container" id="CanvasBaseMap" style="padding-top: 65px;">
        <div class="card" style="width: 100%; margin: 4%">
            <img class="card-img-top" src="{{$expert->avatar}}" alt="Card image" style="width:35%; position: relative; float: left; margin-right:5%">
            <div class="card-body" style="width:60%; position:relative; float:left;">
                <h4 class="card-title">{{$expert->expert_name}}</h4>
                <p class="card-text">{{$expert->introduction}}</p>
                <p class="card-text">適合投資期: {{$expert->investment_period}}</p>
                <p class="card-text">投資風格: </p>
                @foreach($expert->TagRelation as $style)
                    <pre>{{$style->name}}</pre>
                @endforeach
                <p class="card-text">資歷: {{$expert->experience}}</p>
            </div>
            <div class="card-body" style="width:100%; position:relative; float:left;">
                @include('experts._latest_content')
            </div>
        </div>
    </div>
@endsection
