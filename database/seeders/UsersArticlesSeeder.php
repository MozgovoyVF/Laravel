<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagsIds = Tag::factory(10)->create()->pluck('id')->toArray();
        $role = Role::where('slug', 'user')->first();

        User::factory(2)->hasAttached($role)->create()->each(function (User $user) use ($tagsIds) {
            $user->articles()->saveMany(Article::factory(rand(10, 15))->create(['user_id' => $user])->each(function (Article $article) use ($tagsIds) {
                $tagsArr = collect(array_rand($tagsIds, rand(1, count($tagsIds) - 5)))->map(function ($key) use ($tagsIds) {return $tagsIds[$key];})->toArray();
                $article->tags()->sync($tagsArr);
            }));
        });
    }
}
