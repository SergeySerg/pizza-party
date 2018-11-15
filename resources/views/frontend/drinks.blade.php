@extends('ws-app')
@section('content')
<div class="reducer">
    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col tac">
            <h1>{{ $category->getTranslate('title')}}</h1>
        </div>
    </div>
    <div class="mdl-grid">
        @foreach($articles as $key => $drink)
            @if($drink->getAttributeTranslate('size_pint') AND $drink->getAttributeTranslate('size_liter'))
                <div class="mdl-cell mdl-cell--3-col tac item">
                    <div class="item_popup" data-info='[{"id":{{ $drink->id}},"size":"pint","weigth":null,"category":"{{ $type }}","liters":"0.5","persons":null,"price":"{{ $drink->getAttributeTranslate("price_pint")}}"},{"id":{{ $drink->id}},"size":"liter","weigth":null,"category":"{{ $type }}","liters":"1","persons":null,"price":"{{ $drink->getAttributeTranslate("price_liter")}}"}]' data-img="{{ asset($drink->getAttributeTranslate('img'))}}" data-title='{{ $drink->getTranslate("title")}}' data-description='{{ $drink->getTranslate("short_description")}}'>
                        <div class="item_img">
                            <img width="60" height="160" src="{{ asset($drink->getAttributeTranslate('img'))}}" class="attachment-200x200 size-200x200 wp-post-image" alt="{{ $drink->getTranslate('title')}}" />
                        </div>
                        <h3 class="entry-title">{{ $drink->getTranslate('title')}}</h3>
                    </div>
                    <div class="tac item_button_size_list">
                        @if($drink->getAttributeTranslate('size_pint'))
                            <div class="item_button_size checked" data-id="{{ $drink->id}}" data-pos="0">
                                0.5 л
                            </div>
                        @endif
                        @if($drink->getAttributeTranslate('size_liter'))
                        
                            <div class="item_button_size_toggle">
                                <label class="mdl-switch mdl-js-switch" for="{{ $drink->id}}">
                                    <input type="checkbox" id="{{ $drink->id}}" class="mdl-switch__input">
                                    <span class="mdl-switch__label"></span>
                                </label>
                            </div>
                            <div class="item_button_size" data-id="{{ $drink->id}}" data-pos="1">
                                1 л
                            </div>
                        @endif
                    </div>
                    <div class="tac">
                        <div class="item_button" data-pos="0">
                            <div class="item_price">{{ $drink->getAttributeTranslate('price_pint')}} грн</div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart"  data-category = '{{ $type }}' data-size= "pint" data-id="{{ $drink->id}}" data-price="{{ $drink->getAttributeTranslate('price_pint')}}" data-weight="0.5">{{ trans('base.order')}}</button>
                            <div class="item_button_done">
                                <div><a href="/cart">{{ trans('base.add_backet')}}</a></div>
                            </div>
                        </div>
                        <div class="item_button hidden" data-pos="1">
                            <div class="item_price">{{ $drink->getAttributeTranslate('price_liter')}} грн</div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-category = '{{ $type }}' data-size= "liter" data-id="{{ $drink->id}}" data-price="{{ $drink->getAttributeTranslate('price_liter')}}" data-weight="1">{{ trans('base.order')}}</button>
                            <div class="item_button_done">
                                <div><a href="/cart">{{ trans('base.add_backet')}}</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($drink->getAttributeTranslate('size_pint'))
                <div class="mdl-cell mdl-cell--3-col tac item">
                    <div class="item_popup" data-info='[{"id":{{$drink->id}},"size":"pint","weigth":null,"category":"{{ $type }}","liters":"0.5","persons":null,"price":"{{ $drink->getAttributeTranslate("price_pint")}}"}]' data-img="{{ asset($drink->getAttributeTranslate('img'))}}" data-title='{{ $drink->getTranslate("title")}}' data-description='{{ $drink->getTranslate("short_description")}}'>
                        <div class="item_img">
                            <img width="60" height="160" src="{{ asset($drink->getAttributeTranslate('img'))}}" data-category = '{{ $type }}' class="attachment-200x200 size-200x200 wp-post-image" alt="{{ $drink->getTranslate('title')}}" srcset="{{ asset($drink->getAttributeTranslate('img'))}}" class="attachment-200x200 size-200x200 wp-post-image" alt="{{ $drink->getTranslate('title')}}" srcset="{{ asset($drink->getAttributeTranslate('img'))}} 607w, {{ asset($drink->getAttributeTranslate('img'))}} 300w" sizes="(max-width: 200px) 100vw, 200px" />
                        </div>
                        
                        <h3 class="entry-title">{{ $drink->getTranslate('title')}}</h3>
                        <div class="tac item_button_size_list">
                            <div class="item_button_size checked">
                                0.5 л
                            </div>
                        </div>
                    </div>
                    <div class="item_button">
                        <div class="item_price">{{ $drink->getAttributeTranslate('price_pint')}} грн</div>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-category = '{{ $type }}' data-size= "pint" data-weight="1" data-id="{{ $drink->id}}" data-price="{{ $drink->getAttributeTranslate('price_pint')}}" data-weight="{{ $drink->getAttributeTranslate('weight')}}">{{ trans('base.order')}}</button>
                        <div class="item_button_done">
                            <div><a href="/cart">{{ trans('base.add_backet')}}</a></div>
                        </div>
                    </div>
                </div>
            @elseif($drink->getAttributeTranslate('size_liter'))
                <div class="mdl-cell mdl-cell--3-col tac item">
                    <div class="item_popup" data-info='[{"id":{{$drink->id}},"size":"liter","weigth":null,"category":"{{ $type }}","liters":"1","persons":null,"price":"{{ $drink->getAttributeTranslate("price_liter")}}"}]' data-img="{{ asset($drink->getAttributeTranslate('img'))}}" data-title='{{ $drink->getTranslate("title")}}' data-description='{{ $drink->getTranslate("short_description")}}'>
                        <div class="item_img">
                            <img width="60" height="160" src="{{ asset($drink->getAttributeTranslate('img'))}}" data-category = '{{ $type }}' class="attachment-200x200 size-200x200 wp-post-image" alt="{{ $drink->getTranslate('title')}}" srcset="{{ asset($drink->getAttributeTranslate('img'))}}" class="attachment-200x200 size-200x200 wp-post-image" alt="{{ $drink->getTranslate('title')}}" srcset="{{ asset($drink->getAttributeTranslate('img'))}} 607w, {{ asset($drink->getAttributeTranslate('img'))}} 300w" sizes="(max-width: 200px) 100vw, 200px" />
                        </div>
                        
                        <h3 class="entry-title">{{ $drink->getTranslate('title')}}</h3>
                        <div class="tac item_button_size_list">
                            <div class="item_button_size checked">
                                1 л
                            </div>
                        </div>
                    </div>
                    <div class="item_button">
                        <div class="item_price">{{ $drink->getAttributeTranslate('price_liter')}} грн</div>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-category = '{{ $type }}' data-size= "liter" data-weight="1" data-id="{{ $drink->id}}" data-price="{{ $drink->getAttributeTranslate('price_liter')}}" data-weight="{{ $drink->getAttributeTranslate('weight')}}">{{ trans('base.order')}}</button>
                        <div class="item_button_done">
                            <div><a href="/cart">{{ trans('base.add_backet')}}</a></div>
                        </div>
                    </div>
                </div>

            @endif
        @endforeach
    </div>

    <div class="pgn">
    </div>
</div>
@endsection