<?php

namespace App\Http\Controllers\Courses;

use App\User;
use App\Models\Tag;
use App\Models\Expert;
use App\Models\PhysicalCourse;
use App\Models\OnlineCourse;
use App\Models\expertable;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfUnconfirmed;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware([Authenticate::class, RedirectIfUnconfirmed::class], ['only' => ['physicalSignIn', 'onlineSignIn']]);
    }

    public function overview()
    {
        $physicalCourses = PhysicalCourse::with(['expertRelation', 'tagRelation'])->where('status', 1)->get();
        $onlineCourses = OnlineCourse::with(['expertRelation', 'tagRelation'])->where('status', 1)->get();
        $popularCourses = array();
        foreach($physicalCourses as $physicalCourse){
            if(!empty($physicalCourse->tagRelation[0])){
                foreach($physicalCourse->tagRelation as $tag){
                    if($tag->id == 4){
                        array_push($popularCourses, $physicalCourse);
                        break;
                    }
                }
            }
        }
        foreach($onlineCourses as $onlineCourse){
            if(!empty($onlineCourse->tagRelation[0])){
                foreach($onlineCourse->tagRelation as $tag){
                    if($tag->id == 4){
                        array_push($popularCourses, $onlineCourse);
                        break;
                    }
                }
            }
        }
        return view('courses.overview', compact('physicalCourses', 'onlineCourses', 'popularCourses'));
    }

    public function showPysical(PhysicalCourse $course)
    {
        $associated = array();
        $tags = $course->tagRelation;
        foreach($tags as $tag){
            foreach($tag->PhysicalCourseRelation()->get() as $tmp){
                if(!in_array($tmp, $associated, true) && $tmp->id != $course->id){
                    array_push($associated, $tmp);
                }
            }
            foreach($tag->OnlineCourseRelation()->get() as $tmp){
                if(!in_array($tmp, $associated, true)){
                    array_push($associated, $tmp);
                }
            }
        }
        return view('courses.show', compact('course', 'associated'));
    }

    public function showOnline(OnlineCourse $course)
    {
        $associated = array();
        $tags = $course->tagRelation;
        foreach($tags as $tag){
            foreach($tag->PhysicalCourseRelation()->get() as $tmp){
                if(!in_array($tmp, $associated, true)){
                    array_push($associated, $tmp);
                }
            }
            foreach($tag->OnlineCourseRelation()->get() as $tmp){
                if(!in_array($tmp, $associated, true) && $tmp->id != $course->id){
                    array_push($associated, $tmp);
                }
            }
        }
        return view('courses.show', compact('course', 'associated'));
    }

    public function Pysical(PhysicalCourse $course)
    {
        $physicalCourses = PhysicalCourse::with(['expertRelation', 'tagRelation'])->where('status', 1)->get();
        return view('courses.physical', compact('physicalCourses'));
    }

    public function physicalSignIn(PhysicalCourse $course)
    {
        return view('courses.signin', compact('course'));
    }

    public function Online(OnlineCourse $course)
    {
        $onlineCourses = OnlineCourse::with(['expertRelation', 'tagRelation'])->where('status', 1)->get();
        return view('courses.online', compact('onlineCourses'));
    }

    public function onlineSignIn(OnlineCourse $course)
    {
        return view('courses.signin', compact('course'));
    }

}
