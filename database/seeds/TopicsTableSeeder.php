<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\Category;
use App\Models\User;
use Illuminate\View\Factory;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();

        $category_ids = Category::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $topics = factory(Topic::class)
                ->times(100)
                ->make()
                ->each(function ($topic, $index)
                  use ($user_ids, $category_ids, $faker)
                  {
                      $topic->user_id = $faker->randomElement($user_ids);

                      $topic->category_id = $faker->randomElement($category_ids);
                  });

        Topic::insert($topics->toArray());
    }

}

