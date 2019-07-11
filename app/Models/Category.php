<?php

namespace App\Models;

use App\Helpers\HasSlug;
use App\Helpers\HasProduct;
use App\Helpers\HasThread;
use App\Helpers\ModelHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Category extends Model
{
    const TABLE = 'categories';
    use HasSlug, ModelHelpers, HasProduct, SoftDeletes, HasThread;

    protected $dates = ['deleted_at'];

    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    public function id(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public $timestamps = false;

    public function name(): string
    {
        return $this->name;
    }

    public function delete()
    {
        $this->deleteCategory();

        parent::delete();
    }
}
