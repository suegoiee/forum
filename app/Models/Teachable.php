<?php

namespace App\Models;

use App\User;
use App\Models\Expert;
use App\Helpers\ModelHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BeLongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

final class expertable extends Model
{
    const TABLE = 'expertables';

    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'expert_id',
        'expertable_id',
        'expertable_type',
    ];

    public function expert_id(): int
    {
        return $this->expert_id;
    }

    public function expertable_id(): int
    {
        return $this->expertable_id;
    }

    public function expertable_type(): string
    {
        return $this->expertable_type;
    }

    public function related(){
        $this->morphTo();
    }
}
