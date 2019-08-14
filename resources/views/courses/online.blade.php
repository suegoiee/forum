@title('Users')

@extends('layouts.default')

@section('content')
    <div class="container" id="CanvasBaseMap" style="padding-top: 65px;">
        <div class="container" style="width:100%; position:relative; float:top; margin-top:15px">
            <h3 style="text-align:center">網路課程</h3>
            @foreach($onlineCourses as $onlineCourse)
                <div class="card" style="width:25%; position:relative; float:left; margin:4%;">
                    <a href="{{route('courses.online.show', $onlineCourse->id)}}">
                        <img class="card-img-top" src="{{env('API_URL').'storage/'.$onlineCourse->image}}" alt="Card image cap">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">{{$onlineCourse->name}}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
