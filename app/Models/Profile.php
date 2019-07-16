<?php

namespace App\Models;

use App\Helpers\ModelHelpers;
use Illuminate\Database\Eloquent\Model;

final class Profile extends Model
{
    const TABLE = 'profiles';

    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'user_id',
        'name',
        'nickname',
    ];

    public function user_id(): int
    {
        return $this->user_id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function nickname(): string
    {
        return $this->nickname;
    }
}
