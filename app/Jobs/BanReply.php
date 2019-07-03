<?php

namespace App\Jobs;

use DB;
use App\Models\Reply;
use App\Http\Requests\BanReplyRequest;

final class BanReply
{
    private $reply;
    private $BanReply;

    public function __construct(Reply $reply, array $BanReply = [])
    {
        $this->reply = $reply;
        $this->BanReply = array_only($BanReply, ['id']);
    }

    public static function fromRequest(Reply $reply, BanReplyRequest $request): self
    {
        return new static($reply, [
            'id' => $request->id(),
            'ban' => 1
        ]);
    }

    public function handle()
    {
        $this->reply->update($this->BanReply);
        DB::table('replies')->where('id', '=', $this->BanReply)->update(['ban' => 1]);
        return $this->reply;
    }
}
