<?php

namespace App\Jobs;

use App\Models\Reply;

final class DeleteReply
{
    /**
     * @var \App\Models\Reply
     */
    private $reply;

    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    public function handle()
    {
        $this->reply->forceDelete();
    }
}
