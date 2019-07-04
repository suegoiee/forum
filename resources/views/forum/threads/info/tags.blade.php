@if (count($thread->tags()))
    <script>
        var masters = @json($thread);
        console.log(masters);
    </script>
    <div class="thread-info-tags">
        @foreach ($thread->tags() as $tag)
            <a href="{{ route('forum.tag', $tag->slug()) }}">
                <span class="label label-default">{{ $tag->name() }}</span>
            </a>
        @endforeach
    </div>
@endif