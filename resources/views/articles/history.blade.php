@once
  <h3>Изменения</h3>
@endonce

<div class="flex flex-row gap-5">
  <p class="basis-1/4">{{$history->email}}</p>
  <p class="basis-1/4">{{$history->pivot->before}}</p>
  <p class="basis-1/4">{{$history->pivot->after}}</p>
  <p class="basis-1/4">{{$history->pivot->created_at->diffForHumans()}}</p>
</div>