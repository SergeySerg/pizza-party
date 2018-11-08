@extends('ws-app')

@section('content')

 <div class="front_page_slider" style="background: url('{{ asset( $categories->where('link','slides')->first()->img) }}') 50% 50% no-repeat;-webkit-background-size: cover;background-size: cover;">
            <div class="sp_home_slider slick-slider">
                @foreach($categories->where('link','slides')->first()->articles()->activeAndSortArticles()->get() as $slide)
                    <div>
                        <a href="@if($slide->getAttributeTranslate('link')) {{ $slide->getAttributeTranslate('link')}} @else # @endif">
                            <img src="{{ asset( $slide->getAttributeTranslate('img')) }}" alt="">
                            <span class="sp_home_slider_title">{{ $slide->getTranslate('short_description')}}</span>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">{{ trans('base.more')}}</button>
                        </a>
                    </div>
                @endforeach    
            </div>
        </div>

        <div class="reducer">
            <h2 class="tac">{{ trans('base.popular_pizza') }}</h2>
            <div class="mdl-grid tac">
                @foreach($popular_pizza->take(4)->get() as $key => $pizza)
                    <div class="mdl-cell mdl-cell--3-col item">
                        <div class="item_popup" 
                        data-info='[@if($pizza->getAttributeTranslate("size_32")){"id":"24","size":"32","weigth":"450","liters":null,"persons":null,"price":"119"}@endif @if($pizza->getAttributeTranslate("size_40")),{"id":24,"size":"40","weigth":"900","liters":null,"persons":null,"price":"199"}@endif]'
                        data-img="{{ asset($pizza->getAttributeTranslate('img'))}}" data-title='{{ $pizza->getTranslate("title")}}' data-description='{!! $pizza->getTranslate("short_description") !!}'>
                            <div class="item_img">
                                <img width="200" height="200" src="{{ asset($pizza->getAttributeTranslate('img'))}}" class="attachment-200x200 size-200x200 wp-post-image" alt="" srcset="{{ asset($pizza->getAttributeTranslate('img'))}} 300w, {{ asset($pizza->getAttributeTranslate('img'))}} 150w, {{ asset($pizza->getAttributeTranslate('img'))}} 100w, {{ asset($pizza->getAttributeTranslate('img'))}} 600w" sizes="(max-width: 200px) 100vw, 200px" />
                            </div>
                            <h3>{{ $pizza->getTranslate('title')}}</h3>
                        </div>
                        {!! $pizza->getTranslate('short_description')!!}
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
            </div>
            <div class="mdl-grid tac">
                <div class="mdl-cell mdl-cell--12-col">
                    <a href="{{ route('article_list', [null, $categories->where('link','pizza')->first()->link]) }}" class="more_link">{{ trans('base.show_all')}} {{ mb_strtolower($categories->where('link','pizza')->first()->getTranslate('title'))}}</a>
                </div>
            </div>
            @if(count($categories->where('link','advantages')->first()->articles()->get()) !== 0 AND $categories->where('link','advantages')->first()->active == 1)
        
                <h2 class="tac">{{$categories->where('link','advantages')->first()->getTranslate('title')}}?</h2>
                <div class="mdl-grid tac">
                    @foreach($categories->where('link','advantages')->first()->articles()->activeAndSortArticles()->get()->take(3) as $advantage)
                        <div class="mdl-cell mdl-cell--4-col">
                            <div class="tac">
                                <img src="{{ asset( $advantage->getAttributeTranslate('img')) }}" alt="">
                            </div>
                            <h3>{{ $advantage->getTranslate('title') }}</h3>
                            {{ $advantage->getTranslate('short_description') }}                    
                        </div>
                    @endforeach
                    
                </div>
            @endif
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--6-col">
                    <h3 class="tac">{{ trans('base.news_sales')}}</h3>
                    <ul class="mdl-list files_list">
                        @foreach($categories->where('link','articles')->first()->articles()->activeAndSortArticles()->get()->take(3) as $article)
                            <li class="mdl-list__item mdl-list__item--two-line">
                                <span class="mdl-list__item-primary-content">
                                    <i class="material-icons mdl-list__item-avatar" style="	background: url('{{ asset($article->getAttributeTranslate('img')) }}') 50% 50% no-repeat;-webkit-background-size: cover;background-size: cover;"></i>
                                    <span class="files_list_content">
                                        <span><a href="{{ route('article_url', [null, 'articles', $article->getAttributeTranslate('url')]) }}">{{ $article->getTranslate('title')}}</a></span>
                                        <span class="mdl-list__item-sub-title">
                                            <div>{{ $article->date}}</div>
                                        </span>
                                    </span>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                <div class="tac">
                    <a href="{{ route('article_list', [null, $categories->where('link','articles')->first()->link, 'index.htm']) }}" class="more_link">{{ trans('base.show_all')}} {{ mb_strtolower($categories->where('link','articles')->first()->getTranslate('title'))}}</a>
                </div>

                </div>
                <div class="mdl-cell mdl-cell--6-col">
                    <h3 class="tac">{{$categories->where('link','feedback')->first()->getTranslate('title')}}</h3>
                    <ul class="mdl-list files_list">
                        @foreach($categories->where('link','feedback')->first()->articles()->activeAndSortArticles()->get()->take(2) as $item_feedback)
                            <li class="mdl-list__item mdl-list__item--two-line">
                                <span class="mdl-list__item-primary-content">
                                    <i class="material-icons mdl-list__item-avatar"></i>
                                    <span class="files_list_content">
                                        <span>{{$item_feedback->getAttributeTranslate('name')}}</span>
                                        <span class="mdl-list__item-sub-title">
                                            <div>
                                            {!!$item_feedback->getAttributeTranslate('review')!!}
                                            </div>
                                        </span>
                                    </span>
                                </span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tac">
                    <a href="{{ route('article_list', [null, $categories->where('link','feedback')->first()->link]) }}" class="more_link">{{ trans('base.show_all')}} {{ mb_strtolower($categories->where('link','feedback')->first()->getTranslate('title'))}}</a>
                    </div>
                </div>
            </div>
        </div>
@endsection