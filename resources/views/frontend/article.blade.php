@extends('ws-app')
@section('content')
    <div class="reducer">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <h1>{{ $article->getTranslate('title')}}</h1>
                <p><img width="640" height="360" src="{{asset($article->getAttributeTranslate('img'))}}" class="attachment-large size-large wp-post-image" alt="{{ $article->getTranslate('title')}}" srcset="{{asset($article->getAttributeTranslate('img'))}} 1024w, {{asset($article->getAttributeTranslate('img'))}} 300w, {{asset($article->getAttributeTranslate('img'))}} 768w, {{asset($article->getAttributeTranslate('img'))}} 1244w" sizes="(max-width: 640px) 100vw, 640px" /></p>
                {!!$article->getTranslate('description')!!}                
            </div>
        </div>
    </div>
@endsection