<article class="blog-post">
  <a href="/articles/{{$article->code}}" class="blog-post-title mb-1">{{$article->title}}</a>
  <p class="blog-post-meta">{{$article->created_at->toFormattedDateString()}}</p>
  
  <p>{{$article->description}}</p>
</article>