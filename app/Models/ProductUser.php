<?php

namespace App\Models;

use App\Helpers\HasAuthor;
use App\Helpers\HasProduct;
use App\Helpers\HasPermissions;
use App\Helpers\ModelHelpers;
use App\Helpers\HasTimestamps;
use App\Helpers\HasCategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BeLongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class ProductUser extends Model
{
    use HasAuthor, HasCategories, HasTimestamps, ModelHelpers, HasPermissions;

    const TABLE = 'product_user';
    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;

    public function id(): int
    {
        return $this->id;
    }

    public function product_id(): int
    {
        return $this->product_id;
    }

    public function user_id(): int
    {
        return $this->user_id;
    }
}
