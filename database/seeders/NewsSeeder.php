<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $news = News::factory(30)->create();

        $tagsIds = Tag::factory(10)->create()->pluck('id')->toArray();

        $news->each(function (News $news) use ($tagsIds) {
            $tagsArr = collect(array_rand($tagsIds, rand(1, count($tagsIds) - 5)))->map(function ($key) use ($tagsIds) {
                return $tagsIds[$key];
            })->toArray();
            $news->tags()->sync($tagsArr);
        });
    }
}
