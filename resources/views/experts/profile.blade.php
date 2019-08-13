@title($expert->expert_name)

@extends('layouts.default')

@section('content')
    <div class="container" id="CanvasBaseMap" style="padding-top: 65px;">
        <div class="card" style="width: 100%; margin: 4%">
            {!!$expert->avatar!!}
            <div class="card-body" style="width:60%; position:relative; float:left;">
                <h4 class="card-title">{{$expert->expert_name}}</h4>
                <p class="card-text">{!!$expert->introduction!!}</p>
                <p class="card-text">適合投資期: {!!$expert->investment_period!!}</p>
                <p class="card-text">著作: {!!$expert->book!!}</p>
                <p class="card-text">資歷: {!!$expert->experience!!}</p>
                <p class="card-text">專訪: {!!$expert->interview!!}</p>
            </div>
            <div class="card-body" style="width:100%; position:relative; float:left;">
                @include('experts._latest_content')
            </div>
        </div>
    </div>
@endsection
