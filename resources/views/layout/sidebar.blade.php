<div class="col-md-4">
  <div class="position-sticky" style="top: 2rem;">
    <h3 class="pb-4 mb-4 fst-italic border-bottom">Список тегов статей</h3>
    @include('articles.tags', ['tags' => $tagsCloud])
    <br>
    <h3 class="pb-4 mb-4 fst-italic border-bottom">Список тегов новостей</h3>
    @include('news.tags', ['tags' => $tagsNewsCloud])
  </div>
</div>