<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run()
    {
        $this->createTag('Installation', 'installation');
        $this->createTag('Blade', 'blade');
        $this->createTag('Cache', 'cache');
    }

    private function createTag($name, $slug)
    {
        factory(Category::class)->create(compact('name', 'slug'));
    }
}
