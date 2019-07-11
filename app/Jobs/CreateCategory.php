<?php

namespace App\Jobs;

use App\User;
use Ramsey\Uuid\Uuid;
use App\Models\Category;
use App\Models\Subscription;
use App\Http\Requests\CreateCategoryRequest;

final class CreateCategory
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var \App\Models\Category
     */
    private $category;

    public function __construct(array $name)
    {
        $this->name = $name;
    }

    public static function fromRequest(CreateCategoryRequest $request): self
    {
        return new static(
            $request->name()
        );
    }

    public function handle(): Category
    {
        $names = $this->name;
        for($i = 0; $i < count($names); $i++){
            $category[$i] = Category::firstOrCreate([
                'name' => $names[$i],
                'slug' => $names[$i],
            ]);
            $category[$i]->save();
        }

        return $category[0];
    }
}
