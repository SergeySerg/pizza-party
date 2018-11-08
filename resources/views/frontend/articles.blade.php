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
                    <div class="feedback_list">
                        @foreach($articles as $key => $article)
                            <div class="feedback_block">
                                <h3><a href="{{ route('article_url', [null, $category->link, $article->getAttributeTranslate('url')]) }}">{{ $article->getTranslate('title')}}</a></h3>
                                <div class="feedback_date">{{ $article->date}}</div>
                                <div class="feedback_text">
                                    <div>
                                        {!! str_limit($article->getTranslate('description'), 350) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="pgn">
            </div>
        </div>

@endsection