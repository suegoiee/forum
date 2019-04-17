@if (count($archive->tags()))
    <div class="thread-info-tags">
        @foreach ($archive->tags() as $tag)
            <a href="{{ route('blogs.tag', $tag->slug()) }}">
                <span class="label label-default">{{ $tag->name() }}</span>
            </a>
        @endforeach
    </div>
@endif