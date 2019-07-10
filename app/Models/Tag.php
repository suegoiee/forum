<?php

namespace App\Models;

use App\Helpers\HasSlug;
use App\Helpers\HasProduct;
use App\Helpers\ModelHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Tag extends Model
{
    use HasSlug, ModelHelpers, HasProduct, SoftDeletes;

    protected $dates = ['deleted_at'];
    
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
