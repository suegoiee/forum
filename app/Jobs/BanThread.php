<?php

namespace App\Jobs;

use DB;
use App\Models\Thread;
use App\Http\Requests\BanThreadRequest;

final class BanThread
{
    private $thread;
    private $banThread;

    public function __construct(Thread $thread, array $banThread = [])
    {
        $this->thread = $thread;
        $this->banThread = array_only($banThread, ['id']);
    }

    public static function fromRequest(Thread $thread, BanThreadRequest $request): self
    {
        return new static($thread, [
            'id' => $request->id(),
            'ban' => 1
        ]);
    }

    public function handle()
    {
        $this->thread->update($this->banThread);
        DB::table('threads')->where('id', '=', $this->banThread)->update(['ban' => 1]);
        //Threads::where('id', '=', $this->banThread->id())->update(['ban' => 1]);
        return $this->thread;
    }
}
