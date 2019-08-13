<?php

namespace App\Models;

use App\Helpers\HasCourses;
use App\Helpers\ModelHelpers;
use Illuminate\Database\Eloquent\Model;

final class Tag extends Model
{
    use HasCourses;
    const TABLE = 'tags';

    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'name',
    ];

    public function name(): string
    {
        return $this->name;
    }
}
