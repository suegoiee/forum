<?php

namespace App\Jobs;

use App\Models\Archive;
use App\Http\Requests\ArchiveRequest;

final class UpdateArchive
{
    /**
     * @var \App\Models\Archive
     */
    private $archive;

    /**
     * @var array
     */
    private $attributes;

    public function __construct(Archive $archive, array $attributes = [])
    {
        $this->archive = $archive;
        $this->attributes = array_only($attributes, ['subject', 'body', 'slug', 'tags']);
    }

    public static function fromRequest(Archive $archive, ArchiveRequest $request): self
    {
        return new static($archive, [
            'subject' => $request->subject(),
            'body' => $request->body(),
            'slug' => $request->subject(),
            'tags' => $request->tags(),
        ]);
    }

    public function handle(): Archive
    {
        $this->archive->update($this->attributes);

        if (array_has($this->attributes, 'tags')) {
            $this->archive->syncTags($this->attributes['tags']);
        }

        $this->archive->save();

        return $this->archive;
    }
}
