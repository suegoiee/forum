@title('Users')

@extends('layouts.default')

@section('content')
    <div class="container" id="CanvasBaseMap" style="padding-top: 65px;">


        <div class="container" style="width:100%; position:relative; float:top;">
            <h3>熱門課程</h3>
            @foreach($popularCourses as $popularCourse)
                <div class="card" style="width:25%; position:relative; float:left; margin:4%;">
                    <div style="width:100%">
                        @if($popularCourse->location)
                            <a href="{{route('courses.pysical.show', $popularCourse->id)}}">
                        @else
                            <a href="{{route('courses.online.show', $popularCourse->id)}}">
                        @endif
                            <img class="card-img-top" src="{{env('API_URL').'storage/'.$popularCourse->image}}" alt="Card image cap">
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{$popularCourse->name}}</h4>
                        <p class="card-text">{!! str_limit(strip_tags($popularCourse->introduction), 100) !!}</p>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="container" style="width:100%; position:relative; float:top; margin-top:15px">
            <a href="{{route('courses.pysical')}}"><h3>實體課程</h3></a>
            @foreach($physicalCourses as $physicalCourse)
                <div class="card" style="width:25%; position:relative; float:left; margin:4%;">
                    <a href="{{route('courses.pysical.show', $physicalCourse->id)}}">
                        <img class="card-img-top" src="{{env('API_URL').'storage/'.$physicalCourse->image}}" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">{{$physicalCourse->name}}</h4>
                        <p class="card-text">{!! str_limit(strip_tags($physicalCourse->introduction), 100) !!}</p>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="container" style="width:100%; position:relative; float:top; margin-top:15px">
            <a href="{{route('courses.online')}}"><h3>網路課程</h3></a>
            @foreach($onlineCourses as $onlineCourse)
                <div class="card" style="width:25%; position:relative; float:left; margin:4%;">
                    <a href="{{route('courses.online.show', $onlineCourse->id)}}">
                        <img class="card-img-top" src="{{env('API_URL').'storage/'.$onlineCourse->image}}" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">{{$onlineCourse->name}}</h4>
                        <p class="card-text">{!! str_limit(strip_tags($onlineCourse->introduction), 100) !!}</p>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
@endsection
