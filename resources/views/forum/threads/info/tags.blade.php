@if (count($thread->tags()))
    <div class="thread-info-tags" style="text-overflow: ellipsis; overflow: hidden;">
        @foreach ($thread->tags() as $tag)
            <a href="{{ route('forum.tag', $tag->slug()) }}">
                <span class="label label-default">{{ $tag->name() }}</span>
            </a>
        @endforeach
    </div>
@endif