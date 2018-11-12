@extends('ws-app')

@section('content')
<div class="reducer">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col tac">
            <h1>{{ $category->getTranslate('title')}}</h1>
        </div>
    </div>
    <div class="mdl-grid">
        @foreach($articles as $key => $salad)
            <div class="mdl-cell mdl-cell--3-col tac item">
                <div class="item_popup" data-info='[{"id":{{$salad->id}},"size":null,"weigth":"{{ $salad->getAttributeTranslate("weight")}}","category":"{{ $type }}","liters":null,"persons":{{ $salad->getAttributeTranslate("quantity_person")}},"price":"{{ $salad->getAttributeTranslate("price")}}"}]' data-img="{{ asset($salad->getAttributeTranslate('img'))}}" data-title='{{ $salad->getTranslate("title")}}' data-description='{{ $salad->getTranslate("short_description")}}'>
                    <div class="item_img">
                        <img width="200" height="158" src="{{ asset($salad->getAttributeTranslate('img'))}}" data-category = '{{ $type }}' class="attachment-200x200 size-200x200 wp-post-image" alt="{{ $salad->getTranslate('title')}}" srcset="{{ asset($salad->getAttributeTranslate('img'))}}" class="attachment-200x200 size-200x200 wp-post-image" alt="{{ $salad->getTranslate('title')}}" srcset="{{ asset($salad->getAttributeTranslate('img'))}} 607w, {{ asset($salad->getAttributeTranslate('img'))}} 300w" sizes="(max-width: 200px) 100vw, 200px" />
                    </div>
                    <h3 class="entry-title">{{ $salad->getTranslate('title')}}</h3>
                </div>
                <div class="item_button">
                    <div class="item_price">{{ $salad->getAttributeTranslate('price')}} грн</div>
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-category = '{{ $type }}' data-id="{{ $salad->id}}" data-price="{{ $salad->getAttributeTranslate('price')}}" data-weight="{{ $salad->getAttributeTranslate('weight')}}">{{ trans('base.order')}}</button>
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