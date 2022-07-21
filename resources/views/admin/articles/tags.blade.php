@php
    $tags = $tags ?? collect();
@endphp

@if ($tags->isNotEmpty())
      <div class="">
        @foreach ($tags as $tag)
            <a href="/articles/tags/{{$tag->getRouteKey()}}" class="badge-secondary">{{$tag->name}}</a>
        @endforeach
      </div>
  @endif