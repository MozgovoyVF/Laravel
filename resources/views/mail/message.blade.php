@component('mail::message')

@if (request()->method() =='POST')
  Статья '{{$article->title}}' была создана
@endif

@if (request()->method() =='PATCH')
  Статья '{{$article->title}}' была обновлена
@endif

@if (request()->method() =='DELETE')
  Статья '{{$article->title}}' была удалена
@endif

@if (request()->method() != 'DELETE')
  @component('mail::button', ['url' => $url])
    Перейти к просмотру
  @endcomponent
@endif


С уважением,<br>
{{ config('app.name') }}
@endcomponent
