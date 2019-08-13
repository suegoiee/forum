@title('Users')

@extends('layouts.default')

@section('content')
    <div class="container" id="CanvasBaseMap" style="padding-top: 65px;">
        <div class="container" style="width:100%; position:relative; float:top; margin-top:15px">
            <h3 style="text-align:center">實體課程</h3>
            @foreach($physicalCourses as $physicalCourse)
                <div class="card" style="width:25%; position:relative; float:left; margin:4%;">
                    <a href="{{route('courses.pysical.show', $physicalCourse->id)}}">
                        <img class="card-img-top" src="{{$physicalCourse->image}}" alt="Card image" style="width:100%">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">{{$physicalCourse->name}}</h4>
                        <p class="card-text">{{$physicalCourse->introduction}}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
