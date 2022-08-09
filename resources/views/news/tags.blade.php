@php
    $tags = $tags ?? collect();
@endphp

@if ($tags->isNotEmpty())
      <div class="">
        @foreach ($tags as $tag)
            <a href="/news/tags/{{$tag->getRouteKey()}}" class="badge-secondary">{{$tag->name}}</a>
        @endforeach
      </div>
  @endif