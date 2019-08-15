@title('online')

@extends('layouts.default')

@section('content')
    <div class="container" id="CanvasBaseMap" style="padding-top: 65px;">
        <div class="card" style="width: 100%; margin: 4%">
            <img src="{{env('API_URL').'storage/'.$course->image}}" style="width:100%">
            <div style="text-align:right;">
                @if($course->location)
                    <a class="btn" style="margin-right: 8px;" href="{{route('courses.pysical.signIn', $course->id)}}">報名</a>
                @else
                    <a class="btn" style="margin-right: 8px;" href="{{route('courses.online.signIn', $course->id)}}">報名</a>
                @endif
            </div>
            <div class="card-body" style="width:100%; position:relative; float:top;">
                <h4 class="card-title">{{$course->name}}</h4>
                {!!$course->introduction!!}
                <p class="card-text">上課日期: {{$course->date}}</p>
                @if($course->location)
                    <p class="card-text">上課地點: {{$course->location}}</p>
                @endif
                <p class="card-text">名額上限: {{$course->quota}}</p>
                <p class="card-text">主辦單位: {!!$course->host!!}</p>
            </div>
            <div class="card-body" style="width:100%; position:relative; float:top;">
                @foreach($course->expertRelation as $expert)
                    <div class="card container" style="width:100%; position:relative; float:top; margin:4%;">
                        <a href="{{route('experts.profile', $expert->id)}}">
                            {!!$expert->avatar!!}
                        </a>
                        <div class="card-body" style="width:60%; position:relative; float:left;">
                            <h4 class="card-title">{{$expert->expert_name}}</h4>
                            <p class="card-text">{!!$expert->introduction!!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="container" style="width:100%; position:relative; float:top; margin-top:15px">
                <h3 style="text-align:center">相關課程</h3>
                @foreach($associated as $associate)
                    <div class="card" style="width:25%; position:relative; float:left; margin:4%;">
                        <a href="{{route('courses.online.show', $associate->id)}}">
                            <img class="card-img-top" src="{{env('API_URL').'storage/'.$associate->image}}" alt="Card image cap">
                        </a>
                        <div class="card-body">
                            <h4 class="card-title">{{$associate->name}}</h4>
                            <p class="card-text">{!! str_limit(strip_tags($associate->introduction), 100) !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
