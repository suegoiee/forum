<?php

namespace App\Queries;

use App\Models\Archive;
use Illuminate\Contracts\Pagination\Paginator;

final class SearchArchives
{
    /**
     * @return \App\Models\Archive[]
     */
    public static function get(string $keyword, int $perPage = 20): Paginator
    {
        return Archive::feedQuery()
            ->where('archives.subject', 'LIKE', "%$keyword%")
            ->orWhere('archives.body', 'LIKE', "%$keyword%")
            ->paginate($perPage)
            ->appends(['search' => $keyword]);
    }

    public static function count(string $keyword): int
    {
        return Archive::feedQuery()
            ->where('archives.subject', 'LIKE', "%$keyword%")
            ->orWhere('archives.body', 'LIKE', "%$keyword%")
            ->count();
    }
}