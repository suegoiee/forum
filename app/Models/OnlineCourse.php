<?php

namespace App\Models;

use App\User;
use App\Models\Expert;
use App\Helpers\HasTag;
use App\Helpers\HasExpert;
use App\Helpers\ModelHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BeLongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class OnlineCourse extends Model
{
    use HasExpert, HasTag;

    const TABLE = 'online_course';

    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'name',
        'date',
        'quota',
        'introduction',
        'status',
    ];

    public function name(): string
    {
        return $this->name;
    }

    public function date(): string
    {
        return $this->date;
    }

    public function introduction(): string
    {
        return $this->introduction;
    }

    public function quota(): int
    {
        return $this->quota;
    }

    public function status(): int
    {
        return $this->status;
    }

    public static function findByCourseId(int $course_id): self
    {
        return static::where('id', $course_id)->with('expertRelation')->firstOrFail();
    }
}
