<footer class="blog-footer">
    <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a
            href="https://twitter.com/mdo">@mdo</a>.</p>
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>

@if (Route::currentRouteName() === 'index')
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $('#flash-overlay-modal').addClass('show success').modal();

        Pusher.logToConsole = true;

        var pusher = new Pusher('061d51597c5f01e35ee2', {
            cluster: 'eu',
        });

        var channel = pusher.subscribe('my-channel')

        channel.bind('my-event', function(data) {
            alert('Статья успешно обновлена!');
        })
    </script>
@endif
