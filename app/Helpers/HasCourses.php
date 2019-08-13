<?php

namespace App\Helpers;

use App\Models\PhysicalCourse;
use App\Models\OnlineCourse;
use Illuminate\Database\Eloquent\Relations\MorphedByMany;

trait HasCourses
{
    public function PhysicalCourseRelation()
    {
        $physicalCourse = $this->morphedByMany(PhysicalCourse::class, 'taggable');
        return $physicalCourse;
    }

    public function OnlineCourseRelation()
    {
        $onlineCourse = $this->morphedByMany(OnlineCourse::class, 'taggable');
        return $onlineCourse;
    }
}
