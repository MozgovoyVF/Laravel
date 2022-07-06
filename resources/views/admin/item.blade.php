<article class="messages__item">
  <p class="messages__email">{{$message->email}}</p>
  <p class="messages__content">{{$message->message}}</p>
  <p class="messages__created">{{$message->created_at->toFormattedDateString()}}</p>
</article>