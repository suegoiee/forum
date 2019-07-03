<div class="profile-user-info">
    @can(App\Policies\UserPolicy::ADMIN, App\User::class)
        <a href="{{ route('admin.users.show', $user->username()) }}">
        <img src="/images/icon/person.svg" style="width:25px;">
        </a>
    @else
        <a href="{{ route('profile', $user->username()) }}">
        <img src="/images/icon/user.svg">
        </a>
    @endcan

    <h2 class="profile-user-name">{{ $user->name() }}</h2>

    @if ($bio = $user->bio())
        <p class="profile-user-bio">
            {{ $bio }}
        </p>
    @endif

    @if ($user->isAdmin())
        <p><span class="label label-primary">Admin</span></p>
    @elseif ($user->isModerator())
        <p><span class="label label-primary">Moderator</span></p>
    @endif

</div>
