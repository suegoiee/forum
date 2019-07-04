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

final class CategoryProduct extends Model
{
    use HasAuthor, HasTags, HasTimestamps, ModelHelpers, HasPermissions;

    const TABLE = 'category_product';
    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'product_id',
        'category_id',
    ];

    public function id(): int
    {
        return $this->id;
    }

    public function product_id(): int
    {
        return $this->product_id;
    }

    public function category_id(): int
    {
        return $this->category_id;
    }
}
