<?php

namespace App\Helpers;

use Carbon\Carbon;

trait HasTimestamps
{
    public function createdAt(): Carbon
    {
        return Carbon::parse($this->created_at);
    }

    public function updatedAt(): Carbon
    {
        Carbon::parse($this->updated_at);
    }
}
