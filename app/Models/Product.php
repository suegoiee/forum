<?php

namespace App\Models;

use App\Helpers\ModelHelpers;
use Illuminate\Database\Eloquent\Model;

final class Product extends Model
{
    use ModelHelpers;

    /**
     * {@inheritdoc}
     */
    protected $table = 'products';

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
