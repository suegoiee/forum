<div class="row profile-latest-items" style="background-color:#fff; padding: 10px 15px; margin-top: 2%;">
    <div class="col-md-6">
        <h3 style="color: #393939; font-size: 18px;">最近發文</h3>

        @forelse ($user->latestThreads() as $thread)
            <div class="list-group">
                <a href="{{ route('thread', $thread->slug()) }}" class="list-group-item" style="border: 2px solid #e9e9e9 !important;">
                    <h4 class="list-group-item-heading">{{ $thread->subject() }}</h4>
                    <p class="list-group-item-text">{!! str_limit(strip_tags($thread->body), 150) !!}</p>
                </a>
            </div>
        @empty
            <p style="color:#545454;" class="text-center">{{ $user->name() }} 還沒發過文喔~</p>
        @endforelse
    </div>
    <div class="col-md-6">
        <h3 style="color: #393939; font-size: 18px;">最近回覆</h3>

        @forelse ($user->latestReplies() as $reply)
            <div class="list-group">
                <a href="{{ route_to_reply_able($reply->replyAble()) }}" class="list-group-item" style="border: 2px solid #e9e9e9 !important;">
                    <h4 class="list-group-item-heading">{{ $reply->replyAble()->subject() }}</h4>
                    <p class="list-group-item-text">{!! str_limit(strip_tags($reply->body), 100) !!}</p>
                    
                </a>
            </div>
        @empty
            <p style="color:#545454;" class="text-center">{{ $user->name() }} 還沒留言過喔~</p>
        @endforelse
    </div>
</div>
