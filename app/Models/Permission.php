<?php

namespace App\Models;

use App\Helpers\HasAuthor;
use App\Helpers\HasPermissions;
use App\Helpers\ModelHelpers;
use App\Helpers\HasTimestamps;
use App\Helpers\HasTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BeLongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class Permission extends Model
{
    use HasAuthor, HasTags, HasTimestamps, ModelHelpers, HasPermissions;

    const TABLE = 'permission';
    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'user_id',
        'permission',
        'vip',
        'category_id',
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function user_id(): int
    {
        return $this->user_id;
    }

    public function vip(): int
    {
        return $this->vip;
    }

    public function permission(): int
    {
        return $this->permission;
    }

    public function category_id(): int
    {
        return $this->category_id;
    }
}
