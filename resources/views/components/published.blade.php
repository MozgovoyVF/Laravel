@props(['success'])

@unless ($success)
    <p class="text-red-500"> Статья не опубликована</p>
@endunless