<article class="blog-post">
  <a href="{{route('admin.article.show', ['article' => $article->code])}}" class="blog-post-title mb-1">{{$article->title}}</a>

  <x-published success="{{$article->published}}"/>

  <p class="blog-post-meta">{{$article->created_at->toFormattedDateString()}}</p>

  @include('articles.tags', ['tags' => $article->tags])
  
  <p>{{$article->description}}</p>
</article>