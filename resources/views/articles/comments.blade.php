@once
  <h3>Комментарии</h3>
@endonce

<div class="flex flex-row gap-5">
  <p class="basis-1/3">{{$comment->email}}</p>
  <p class="basis-1/3">{{$comment->pivot->message}}</p>
  <p class="basis-1/3">{{$comment->pivot->created_at->diffForHumans()}}</p>
</div>