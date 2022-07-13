<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class TagsSynchronizer
{

  public function sync(Collection $tags, Model $model)
  {
    $ids = [];
    foreach ($tags as $tag) {
      if (is_object($tag)) {
        $ids[] = $tag->id;
      } else {
        $articleTag = Tag::firstOrCreate(['name' => $tag]);
        $ids[] = $articleTag->id;
      }
    }

    $model->tags()->sync($ids);
  }
}
