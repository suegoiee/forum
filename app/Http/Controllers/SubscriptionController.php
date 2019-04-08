<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Jobs\UnsubscribeFromSubscriptionAble;

class SubscriptionController extends Controller
{
    public function unsubscribe(Subscription $subscription)
    {
        $thread = $subscription->subscriptionAble();

        $this->dispatch(new UnsubscribeFromSubscriptionAble($subscription->user(), $thread));

        $this->success("已取消追蹤此文章");

        return redirect()->route('thread', $thread->slug());
    }
}
