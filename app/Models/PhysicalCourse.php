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

final class PhysicalCourse extends Model
{
    use HasExpert, HasTag;

    const TABLE = 'physical_course';

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
        'location',
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

    public function location(): string
    {
        return $this->location;
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
