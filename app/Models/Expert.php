<?php

namespace App\Models;

use App\User;
use App\Models\Tag;
use App\Models\OnlineCourse;
use App\Models\PhysicalCourse;
use App\Helpers\ModelHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BeLongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphedByMany;

final class Expert extends Model
{
    const TABLE = 'experts';

    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'user_id',
        'expert_name',
        'introduction',
        'investment_style',
        'investment_period',
        'experience',
    ];

    public function user_id(): int
    {
        return $this->user_id;
    }

    public function expert_name(): string
    {
        return $this->expert_name;
    }

    public function introduction(): string
    {
        return $this->introduction;
    }

    public function investment_style(): string
    {
        return $this->investment_style;
    }

    public function investment_period(): string
    {
        return $this->investment_period;
    }

    public function experience(): string
    {
        return $this->experience;
    }

    public function userRelation(): BeLongsTo
    {
        return $this->BeLongsTo(User::class, 'user_id');
    }

    public static function findByExpertId(int $expert_id): self
    {
        $expert = static::where('id', $expert_id)->with('userRelation')->firstOrFail();
        //dd($expert->courseRelation());
        return static::where('id', $expert_id)->with('userRelation')->firstOrFail();
    }

    public function OnlineCourseRelation()
    {        
        $onlineCourse = $this->morphedByMany(OnlineCourse::class, 'expertable');
        return $onlineCourse;
    }

    public function PhysicalCourseRelation()
    {
        $physicalCourse = $this->morphedByMany(PhysicalCourse::class, 'expertable');
        return $physicalCourse;
    }

    public function TagRelation()
    {
        $tags = $this->morphToMany(Tag::class, 'taggable');
        return $tags;
    }
}
