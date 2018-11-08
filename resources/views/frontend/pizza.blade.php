@extends('ws-app')

@section('content')
    <div class="reducer">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col tac">
                <h1>{{ $category->getTranslate('title')}}</h1>
            </div>
        </div>
        <div class="mdl-grid">
            @foreach($articles as $key => $pizza)
            <div class="mdl-cell mdl-cell--3-col tac item">
                <div class="item_popup" 
                    data-info='[@if($pizza->getAttributeTranslate("size_32")){"id":"24","size":"32","weigth":"450","liters":null,"persons":null,"price":"119"}@endif @if($pizza->getAttributeTranslate("size_40")),{"id":24,"size":"40","weigth":"900","liters":null,"persons":null,"price":"199"}@endif]'
                    data-img="{{ asset($pizza->getAttributeTranslate('img'))}}" data-title='{{ $pizza->getTranslate("title")}}' data-description='{!! $pizza->getTranslate("short_description") !!}'>
                    <div class="item_img">
                        <img width="200" height="200" src="{{ asset($pizza->getAttributeTranslate('img'))}}" class="attachment-200x200 size-200x200 wp-post-image" alt="" srcset="{{ asset($pizza->getAttributeTranslate('img'))}} 300w, {{ asset($pizza->getAttributeTranslate('img'))}} 150w, {{ asset($pizza->getAttributeTranslate('img'))}} 100w, {{ asset($pizza->getAttributeTranslate('img'))}} 600w" sizes="(max-width: 200px) 100vw, 200px" />
                    </div>
                    <h3 class="entry-title">{{ $pizza->getTranslate('title')}}</h3>
                </div>
                {!!$pizza->getTranslate('short_description')!!} 
                <div class="tac item_button_size_list">
                    @if($pizza->getAttributeTranslate('size_32'))
                        <div class="item_button_size checked" data-id="{{ $pizza->id}}" data-pos="0">
                            32 см
                        </div>
                    @endif
                    @if($pizza->getAttributeTranslate('size_40'))
                        <div class="item_button_size_toggle">
                            <label class="mdl-switch mdl-js-switch" for="{{ $pizza->id}}">
                                <input type="checkbox" id="{{ $pizza->id}}" class="mdl-switch__input">
                                <span class="mdl-switch__label"></span>
                            </label>
                        </div>
                        <div class="item_button_size" data-id="{{ $pizza->id}}" data-pos="1">
                            40 см
                        </div>
                    @endif
                </div>
                <div class="tac">
                    @if($pizza->getAttributeTranslate('size_32'))
                        <div class="item_button" data-pos="0">
                            <div class="item_price">{{ $pizza->getAttributeTranslate('price_32')}} грн</div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-id="{{ $pizza->id}}" data-price="{{ $pizza->getAttributeTranslate('price_40')}}" data-weight="{{ $pizza->getAttributeTranslate('weight_40')}}">{{ trans('base.order')}}</button>
                            <div class="item_button_done">
                                <div><a href="/cart.html">{{ trans('base.add_backet')}}</a></div>
                            </div>
                        </div>
                    @endif
                    @if($pizza->getAttributeTranslate('size_40'))
                        <div class="item_button hidden" data-pos="1">
                            <div class="item_price">{{ $pizza->getAttributeTranslate('price_40')}} грн</div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-id="{{ $pizza->id}}" data-price="{{ $pizza->getAttributeTranslate('price_40')}}" data-weight="{{ $pizza->getAttributeTranslate('weight_40')}}">{{ trans('base.order')}}</button>
                            <div class="item_button_done">
                                <div><a href="/cart.html">{{ trans('base.add_backet')}}</a></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endforeach    
        <div class="pgn"></div>
    </div>
@endsection