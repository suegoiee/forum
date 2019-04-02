@title('Edit your thread')

@extends('layouts.default')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="alert alert-info">
        <p>
            在更新文章前麻煩先了解
            <a href="{{ route('rules') }}" class="alert-link">論壇規則</a> 
        </p>
    </div>

    @include('forum.threads._form', [
        'route' => ['threads.update', $thread->slug()],
        'method' => 'PUT',
    ])
@endsection
