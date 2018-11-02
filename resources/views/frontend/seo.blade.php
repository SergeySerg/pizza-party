@extends('ws-app')

@section('content')
<div style='heigth: 300px'>
    {{ $seo_article->getAttributeTranslate('url')}}
</div>
@endsection