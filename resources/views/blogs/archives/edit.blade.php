@title('編輯專欄')

@extends('layouts.default')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="alert"  style="background: rgba(255,255,255,0.9);border-left: 3px solid #0084ff;color: #393939;box-shadow: 2px 2px 2px 0px rgba(2%,2%,4%,0.12);">
        <i class="fas fa-info-circle" style="color: #0084ff;padding-right: 1%;"></i>
            在編輯專欄前麻煩先了解
            <a style="color:#ffa500; font-weight:bolder; cursor: pointer;" data-toggle="modal" data-target="#rule">論壇規則</a>。
                    @include('_partials._rule_modal', [
                        'id' => 'rule',
                    ])
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color: #0084ff;">&times;</button> 
    </div>

    @include('blogs.archives._blogs', [
        'route' => ['archives.update', $archive->slug()],
        'method' => 'PUT',
    ])
@endsection
