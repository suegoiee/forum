<?php

namespace App\Jobs;

use DB;
use App\Models\Thread;
use App\Http\Requests\TopThreadRequest;

final class TopThread
{
    private $thread;
    private $topThread;

    public function __construct(Thread $thread, array $topThread = [])
    {
        $this->thread = $thread;
        $this->topThread = array_only($topThread, ['id']);
    }

    public static function fromRequest(Thread $thread, TopThreadRequest $request): self
    {
        return new static($thread, [
            'id' => $request->id(),
            'top' => 1
        ]);
    }

    public function handle()
    {
        $this->thread->update($this->topThread);
        DB::table('threads')->where('id', '=', $this->topThread)->update(['top' => 1]);
        return $this->thread;
    }
}
