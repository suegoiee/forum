<?php

namespace App\Jobs;

use App\Models\Archive;

final class DeleteArchive
{
    /**
     * @var \App\Models\Archive
     */
    private $archive;

    public function __construct(Archive $archive)
    {
        $this->archive = $archive;
    }

    public function handle()
    {
        $this->archive->delete();
    }
}
