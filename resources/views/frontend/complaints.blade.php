@extends('ws-app')
@section('content')
    <div class="reducer">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col tac">
            <h1>{{ $category->getTranslate('title')}}</h1>
            </div>
        </div>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="tac">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_feedback">Добавить отзыв</button>
                </div>
                <div class="feedback_form_block hidden">
                    <form action="" id="%ID%_form" class='add_review'>
                        <h2>{{ trans('base.add_review')}}</h2>
                        <div class="%CLASS%-textfield %CLASS%-js-textfield %CLASS%-textfield--floating-label">
                            <input class="%CLASS%-textfield__input" type="text" name="name" id="%ID%_name">
                            <label class="%CLASS%-textfield__label" for="%ID%_name">{{ trans('base.name')}}*</label>
                        </div>
                        <div class="%CLASS%-textfield %CLASS%-js-textfield %CLASS%-textfield--floating-label">
                            <textarea class="%CLASS%-textfield__input" name="review" type="text" rows="3" id="%ID%_msg"></textarea>
                            <label class="%CLASS%-textfield__label" for="%ID%_msg">{{ trans('base.review')}}*</label>
                        </div>
                        <div>
                            <input type="submit" value="{{ trans('base.send')}}" class="%CLASS%-button %CLASS%-js-button %CLASS%-button--raised %CLASS%-button--colored send_review" disabled id="%ID%_btn">
                            <div class="%CLASS%-spinner %CLASS%-spinner--single-color %CLASS%-js-spinner is-active hidden" id="%ID%_loader"></div>
                        </div>
                    </form>
                    <div id="%ID%_form_done" class="hidden">
                        <h2>Спасибо!</h2>
                        <p>Ваш отзыв добавлен!</p>
                    </div>
                </div>
                <script>
                        var feedback_paged = 1;
                        </script>
                <div class="feedback_list">
                    @foreach($articles as $key => $review)
                        <div class="feedback_block">
                            <h3>{{ $review->getAttributeTranslate('name')}}</h3>
                            <div class="feedback_date">
                                {{ $review->date}}
                            </div>
                            <div class="feedback_text">
                                {!! $review->getAttributeTranslate('review')!!}                            
                            </div>
                            @if($review->getAttributeTranslate('admin_answer'))
                                <div class="feedback_answer">
                                    <strong>{{ trans('base.manager')}} {{$review->getAttributeTranslate('manager')}}</strong>
                                    {!!$review->getAttributeTranslate('admin_answer')!!}                               </div>
                            @endif
                        </div>
                    @endforeach    
                </div>
            </div>
        </div>
        
        <div class="pgn"> {{ $articles->render() }}
        </div>
    </div>
@endsection