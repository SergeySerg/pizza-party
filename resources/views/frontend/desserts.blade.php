@extends('ws-app')

@section('content')
<div class="reducer">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col tac">
            <h1>{{ $category->getTranslate('title')}}</h1>
        </div>
    </div>
    <div class="mdl-grid">
        @foreach($articles as $key => $dessert)
            <div class="mdl-cell mdl-cell--3-col tac item">
                <div class="item_popup" data-info='[{"id":{{$dessert->id}},"size":null,"weigth":"{{ $dessert->getAttributeTranslate("weight")}}","category":"{{ $type }}","liters":null,"persons":{{ $dessert->getAttributeTranslate("quantity_person")}},"price":"{{ $dessert->getAttributeTranslate("price")}}"}]' data-img="{{ asset($dessert->getAttributeTranslate('img'))}}" data-title='{{ $dessert->getTranslate("title")}}' data-description='{{ $dessert->getTranslate("short_description")}}'>
                    <div class="item_img">
                        <img width="200" height="158" src="{{ asset($dessert->getAttributeTranslate('img'))}}" data-category = '{{ $type }}' class="attachment-200x200 size-200x200 wp-post-image" alt="{{ $dessert->getTranslate('title')}}" srcset="{{ asset($dessert->getAttributeTranslate('img'))}}" class="attachment-200x200 size-200x200 wp-post-image" alt="{{ $dessert->getTranslate('title')}}" srcset="{{ asset($dessert->getAttributeTranslate('img'))}} 607w, {{ asset($dessert->getAttributeTranslate('img'))}} 300w" sizes="(max-width: 200px) 100vw, 200px" />
                    </div>
                    <h3 class="entry-title">{{ $dessert->getTranslate('title')}}</h3>
                </div>
                <div class="item_button">
                    <div class="item_price">{{ $dessert->getAttributeTranslate('price')}} грн</div>
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-category = '{{ $type }}' data-id="{{ $dessert->id}}" data-price="{{ $dessert->getAttributeTranslate('price')}}" data-weight="{{ $dessert->getAttributeTranslate('weight')}}">{{ trans('base.order')}}</button>
                    <div class="item_button_done">
                        <div><a href="/cart">{{ trans('base.add_backet')}}</a></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="pgn"></div>
</div>

@endsection