<?php

namespace App\Jobs;

use App\User;
use App\Models\Profile;
use App\Http\Requests\UpdateProfileRequest;

final class UpdateProfile
{
    /**
     * @var \App\User
     */
    private $user;

    /**
     * @var array
     */
    private $attributes;

    /**
     * @var array
     */
    private $profile_attributes;

    public function __construct(User $user, array $attributes = [])
    {   
        $this->user = $user;
        //$this->profile = $profile;
        $this->attributes = array_only($attributes, ['name', 'email', 'username', 'bio', 'address', 'phone']);
        $this->profile_attributes = array_only($attributes, ['address', 'phone']);
    }

    public static function fromRequest(User $user, UpdateProfileRequest $request): self
    {
        return new static($user, [
            'name' => $request->name(),
            'email' => $request->email(),
            'username' => strtolower($request->username()),
            'bio' => trim(strip_tags($request->bio())),
            'address' => $request->address(),
            'phone' => $request->phone(),
        ]);
    }

    public function handle(): User
    {
        //dd($this->user->id);
        $this->profile = Profile::where('user_id', $this->user->id);
        if($this->profile->first()){
            $this->profile->update($this->profile_attributes);
        }
        else{
            /*$this->profile->create($this->profile_attributes);
            Profile::firstOrCreate(
                [
                    'id' => $homestead_thread->id, 
                    'author_id' => $homestead_thread->author_id,
                    'subject' => $homestead_thread->subject,
                    'body' => $homestead_thread->body,
                    'slug' => $homestead_thread->slug,
                    'solution_reply_id' => 0,
                    'created_at' => $homestead_thread->created_at,
                    'updated_at' => $homestead_thread->updated_at
                ]
            );*/
        }
        $this->user->update($this->attributes);

        return $this->user;
    }
}
