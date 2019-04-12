@component('mail::message')

**{{ $reply->author()->name() }}** 在這篇文章底下留言.

@component('mail::panel')
{!! str_limit(strip_tags($reply->body), 100) !!}
@endcomponent

@component('mail::button', ['url' => route('thread', $reply->replyAble()->slug())])
前往文章
@endcomponent

@component('mail::subcopy')
    您會收到此信係因您有追蹤此篇文章，如要取消請  
    [取消追蹤]({{ route('subscriptions.unsubscribe', $subscription->uuid()->toString()) }}) 此文章.
@endcomponent

@endcomponent
