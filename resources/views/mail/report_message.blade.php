@component('mail::message')
    Согласно Вашему запросу итоговый отчет содержит:

    

    @foreach ($data as $key => $item)
        @switch($key)
            @case('User')
                {{ 'Пользователей: ' . $item }}
            @break

            @case('Comment')
                {{ 'Комментариев: ' . $item }}
            @break

            @case('News')
                {{ 'Новостей: ' . $item }}
            @break

            @case('Tag')
                {{ 'Тэгов: ' . $item }}
            @break

            @case('Article')
                {{ 'Статей: ' . $item }}
            @break
        @endswitch
        
    @endforeach


    С уважением,
    {{ config('app.name') }}
@endcomponent
