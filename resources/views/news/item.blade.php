<article class="blog-post">
  <a href="/news/{{$item->id}}" class="blog-post-title mb-1">{{$item->title}}</a>

  <p class="blog-post-meta">{{$item->created_at->toFormattedDateString()}}</p>
  
  <p>{{$item->description}}</p>
</article>