@extends('layout.admin')

@section('title')
    {{ __('Отчеты : Итого') }}
@endsection

@section('content')
    <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
            Отчеты: Итого
        </h3>

        <form action="{{route('admin.reports.queue')}}" method="POST">
            @csrf

            <div class="checkselect">
                <label><input type="checkbox" name="sections[]" value="User"> Пользователи</label>
                <label><input type="checkbox" name="sections[]" value="Article"> Статьи</label>
                <label><input type="checkbox" name="sections[]" value="News"> Новости</label>
                <label><input type="checkbox" name="sections[]" value="Comment"> Комментарии</label>
                <label><input type="checkbox" name="sections[]" value="Tag"> Теги</label>
            </div>

            <button type="submit" class="btn btn-primary mb-3">Сгенерировать отчет</button>
        </form>
        
    </div>
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        (function($) {
        function setChecked(target) {
            var checked = $(target).find("input[type='checkbox']:checked").length;
            if (checked) {
                $(target).find('select option:first').html('Выбрано: ' + checked);
            } else {
                $(target).find('select option:first').html('Выберите из списка');
            }
        }
     
        $.fn.checkselect = function() {
            this.wrapInner('<div class="checkselect-popup"></div>');
            this.prepend(
                '<div class="checkselect-control">' +
                    '<select class="form-control"><option></option></select>' +
                    '<div class="checkselect-over"></div>' +
                '</div>'
            );	
     
            this.each(function(){
                setChecked(this);
            });		
            this.find('input[type="checkbox"]').click(function(){
                setChecked($(this).parents('.checkselect'));
            });
     
            this.parent().find('.checkselect-control').on('click', function(){
                $popup = $(this).next();
                $('.checkselect-popup').not($popup).css('display', 'none');
                if ($popup.is(':hidden')) {
                    $popup.css('display', 'block');
                    $(this).find('select').focus();
                } else {
                    $popup.css('display', 'none');
                }
            });
     
            $('html, body').on('click', function(e){
                if ($(e.target).closest('.checkselect').length == 0){
                    $('.checkselect-popup').css('display', 'none');
                }
            });
        };
    })(jQuery);	
     
    $('.checkselect').checkselect();
    </script>
    
@endpush
