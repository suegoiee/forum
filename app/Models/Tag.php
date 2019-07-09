<?php

namespace App\Models;

use App\Helpers\HasSlug;
use App\Helpers\HasProduct;
use App\Helpers\ModelHelpers;
use Illuminate\Database\Eloquent\Model;

final class Tag extends Model
{
    use HasSlug, ModelHelpers, HasProduct;

    /**
     * {@inheritdoc}
     */
    protected $table = 'categories';

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
}
