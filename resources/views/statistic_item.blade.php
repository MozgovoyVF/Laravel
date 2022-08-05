<h3 class="mt-4 mb-4 fst-italic border-bottom">
    {{ $key }}
</h3>
<h3 class="fst-italic">
    @if (is_string($item) || is_int($item) || is_float($item))
        {{ $item }}
    @else
        <h3 class="fst-italic">{{ $item->title }}</h3>
        <a class="pb-4" href="{{ route('article.show', ['article' => $item->code]) }}">Ссылка на
            статью</a>
    @endif
</h3>
