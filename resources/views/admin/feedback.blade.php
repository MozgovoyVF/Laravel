@extends('layout.admin')

@section('content')
<div class="col-md-8">
  <h3 class="pb-4 mb-4 fst-italic border-bottom">
    Список сообщений
  </h3>

  <article class = "messages__item">
    <p class = "messages__email"> Email </p>
    <p class = "messages__content"> Сообщение </p>
    <p class = "messages__created">Дата отправки </p>
  </article>

  @foreach ($messages as $message)
    @include('admin.item')
  @endforeach

</div>
@endsection