@title($user->name())

@extends('layouts.base')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a class="btn btn-default btn-block" href="{{ route('profile', $user->username()) }}">查看資料</a>

                        @can(App\Policies\UserPolicy::BAN, $user)
                            @if ($user->isBanned())
                                <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#unbanUser">解除封鎖用戶</button>
                            @else
                                <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#banUser">封鎖用戶</button>
                            @endif
                        @endcan

                        @can(App\Policies\UserPolicy::DELETE, $user)
                            <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteUser">刪除用戶</button>
                        @endcan
                    </div>
                </div>

                <p style="text-align:center"><a href="{{ route('admin') }}"><img src="/images/icon/back.svg"></a></p>
            </div>
            <div class="col-lg-9">
                @include('layouts._alerts')

                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('users._user_info')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- The reason why we put the modals here is because otherwise UI gets broken --}}
    @can(App\Policies\UserPolicy::BAN, $user)
        @if ($user->isBanned())
            @include('_partials._update_modal', [
                'id' => 'unbanUser',
                'route' => ['admin.users.unban', $user->username()],
                'title' => "解除封鎖用戶 {$user->name()}",
                'body' => '<p>封鎖此用戶將禁止他們登錄，發表文章和回覆文章。</p>',
            ])
        @else
            @include('_partials._update_modal', [
                'id' => 'banUser',
                'route' => ['admin.users.ban', $user->username()],
                'title' => "封鎖用戶 {$user->name()}",
                'body' => '<p>取消對此用戶的封鎖將允許他們再次登錄並發表文章</p>',
            ])
        @endif
    @endcan

    @can(App\Policies\UserPolicy::DELETE, $user)
        @include('_partials._delete_modal', [
            'id' => 'deleteUser',
            'route' => ['admin.users.delete', $user->username()],
            'title' => "Delete {$user->name()}",
            'body' => '<p>刪除此用戶將刪除其帳戶和任何相關內容，如主題和回复。不能撤消!</p>',
        ])
    @endcan
@endsection
