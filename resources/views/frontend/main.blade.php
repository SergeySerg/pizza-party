@extends('ws-app')

@section('content')

 <div class="front_page_slider" style="background: url('{{ asset( $categories->where('link','slides')->first()->img) }}') 50% 50% no-repeat;-webkit-background-size: cover;background-size: cover;">
            <div class="sp_home_slider slick-slider">
                @foreach($categories->where('link','slides')->first()->articles()->activeAndSortArticles()->get() as $slide)
                    <div>
                        <a href="{{ $slide->getAttributeTranslate('link')}}">
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
                <div class="mdl-cell mdl-cell--3-col item">
                    <div class="item_popup" data-info='[{"id":24,"size":"32","weigth":"450","liters":null,"persons":"2","price":"119"},{"id":24,"size":"40","weigth":"900","liters":null,"persons":"4","price":"199"}]' data-img="/images/vegan.jpg" data-title='Вегетарианская' data-description='томатный соус, лук маринованный, маслины, цукини, баклажаны гриль, зелень, перец болгарский, моцарелла'>
                        <div class="item_img">
                            <img width="200" height="200" src="/images/vegan-300x300.jpg" class="attachment-200x200 size-200x200 wp-post-image" alt="" srcset="/images/vegan-300x300.jpg 300w, /images/vegan-150x150.jpg 150w, /images/vegan-100x100.jpg 100w, /images/vegan.jpg 600w" sizes="(max-width: 200px) 100vw, 200px" />
                        </div>
                        <h3>Вегетарианская</h3>
                    </div>
                    томатный соус, лук маринованный, маслины, цукини, баклажаны гриль, зелень, перец болгарский, моцарелла
                    <div class="tac item_button_size_list">
                        <div class="item_button_size checked" data-id="switch-24-0" data-pos="0">
                            32 см
                        </div>
                        <div class="item_button_size_toggle">
                            <label class="mdl-switch mdl-js-switch" for="switch-24-0">
                                <input type="checkbox" id="switch-24-0" class="mdl-switch__input">
                                <span class="mdl-switch__label"></span>
                            </label>
                        </div>
                        <div class="item_button_size" data-id="switch-24-0" data-pos="1">
                            40 см
                        </div>
                    </div>
                    <div class="tac">
                        <div class="item_button" data-pos="0">
                            <div class="item_price">119 грн</div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-id="24" data-price="119" data-weight="450">Заказать</button>
                            <div class="item_button_done">
                                <div><a href="/cart.html">Добавлено в корзину</a></div>
                            </div>
                        </div>
                        <div class="item_button hidden" data-pos="1">
                            <div class="item_price">199 грн</div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-id="24" data-price="199" data-weight="900">Заказать</button>
                            <div class="item_button_done">
                                <div><a href="/cart.html">Добавлено в корзину</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--3-col item">
                    <div class="item_popup" data-info='[{"id":119,"size":"32","weigth":"460","liters":null,"persons":"2","price":"169"},{"id":119,"size":"40","weigth":"920","liters":null,"persons":"4","price":"219"}]' data-img="/images/gavayskaya-pizza.jpg" data-title='Гавайская' data-description='томатный соус, курица гриль, ананас, моцарелла'>
                        <div class="item_img">
                            <img width="200" height="200" src="/images/gavayskaya-pizza-300x300.jpg" class="attachment-200x200 size-200x200 wp-post-image" alt="" srcset="/images/gavayskaya-pizza-300x300.jpg 300w, /images/gavayskaya-pizza-150x150.jpg 150w, /images/gavayskaya-pizza-100x100.jpg 100w, /images/gavayskaya-pizza.jpg 600w" sizes="(max-width: 200px) 100vw, 200px" />
                        </div>
                        <h3>Гавайская</h3>
                    </div>
                    томатный соус, курица гриль, ананас, моцарелла 
                    <div class="tac item_button_size_list">
                        <div class="item_button_size checked" data-id="switch-119-1" data-pos="0">
                            32 см
                        </div>
                        <div class="item_button_size_toggle">
                            <label class="mdl-switch mdl-js-switch" for="switch-119-1">
                                <input type="checkbox" id="switch-119-1" class="mdl-switch__input">
                                <span class="mdl-switch__label"></span>
                            </label>
                        </div>
                        <div class="item_button_size" data-id="switch-119-1" data-pos="1">
                            40 см
                        </div>
                    </div>
                    <div class="tac">
                        <div class="item_button" data-pos="0">
                            <div class="item_price">169 грн</div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-id="119" data-price="169" data-weight="460">Заказать</button>
                            <div class="item_button_done">
                                <div><a href="/cart.html">Добавлено в корзину</a></div>
                            </div>
                        </div>
                        <div class="item_button hidden" data-pos="1">
                            <div class="item_price">219 грн</div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-id="119" data-price="219" data-weight="920">Заказать</button>
                            <div class="item_button_done">
                                <div><a href="/cart.html">Добавлено в корзину</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--3-col item">
                    <div class="item_popup" data-info='[{"id":24,"size":"32","weigth":"450","liters":null,"persons":"2","price":"119"},{"id":24,"size":"40","weigth":"900","liters":null,"persons":"4","price":"199"}]' data-img="/images/vegan.jpg" data-title='Вегетарианская' data-description='томатный соус, лук маринованный, маслины, цукини, баклажаны гриль, зелень, перец болгарский, моцарелла'>
                        <div class="item_img">
                            <img width="200" height="200" src="/images/vegan-300x300.jpg" class="attachment-200x200 size-200x200 wp-post-image" alt="" srcset="/images/vegan-300x300.jpg 300w, /images/vegan-150x150.jpg 150w, /images/vegan-100x100.jpg 100w, /images/vegan.jpg 600w" sizes="(max-width: 200px) 100vw, 200px" />
                        </div>
                        <h3>Вегетарианская</h3>
                    </div>
                    томатный соус, лук маринованный, маслины, цукини, баклажаны гриль, зелень, перец болгарский, моцарелла 
                    <div class="tac item_button_size_list">
                        <div class="item_button_size checked" data-id="switch-24-2" data-pos="0">
                            32 см
                        </div>
                        <div class="item_button_size_toggle">
                            <label class="mdl-switch mdl-js-switch" for="switch-24-2">
                                <input type="checkbox" id="switch-24-2" class="mdl-switch__input">
                                <span class="mdl-switch__label"></span>
                            </label>
                        </div>
                        <div class="item_button_size" data-id="switch-24-2" data-pos="1">
                            40 см
                        </div>
                    </div>
                    <div class="tac">
                        <div class="item_button" data-pos="0">
                            <div class="item_price">119 грн</div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-id="24" data-price="119" data-weight="450">Заказать</button>
                            <div class="item_button_done">
                                <div><a href="/cart.html">Добавлено в корзину</a></div>
                            </div>
                        </div>
                        <div class="item_button hidden" data-pos="1">
                            <div class="item_price">199 грн</div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-id="24" data-price="199" data-weight="900">Заказать</button>
                            <div class="item_button_done">
                                <div><a href="/cart.html">Добавлено в корзину</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--3-col item">
                    <div class="item_popup" data-info='[{"id":109,"size":"32","weigth":"420","liters":null,"persons":"2","price":"167"},{"id":109,"size":"40","weigth":"840","liters":null,"persons":"4","price":"249"}]' data-img="/images/kurinaya-rokfor-pizza.jpg" data-title='Куриная с сыром рокфор' data-description='сливочный соус, курица гриль, шампиньоны, моцарелла, рокфор'>
                        <div class="item_img">
                            <img width="200" height="200" src="/images/kurinaya-rokfor-pizza-300x300.jpg" class="attachment-200x200 size-200x200 wp-post-image" alt="" srcset="/images/kurinaya-rokfor-pizza-300x300.jpg 300w, /images/kurinaya-rokfor-pizza-150x150.jpg 150w, /images/kurinaya-rokfor-pizza-100x100.jpg 100w, /images/kurinaya-rokfor-pizza.jpg 600w" sizes="(max-width: 200px) 100vw, 200px" />
                        </div>
                        <h3>Куриная с сыром рокфор</h3>
                    </div>
                    сливочный соус, курица гриль, шампиньоны, моцарелла, рокфор 
                    <div class="tac item_button_size_list">
                        <div class="item_button_size checked" data-id="switch-109-3" data-pos="0">
                            32 см
                        </div>
                        <div class="item_button_size_toggle">
                            <label class="mdl-switch mdl-js-switch" for="switch-109-3">
                                <input type="checkbox" id="switch-109-3" class="mdl-switch__input">
                                <span class="mdl-switch__label"></span>
                            </label>
                        </div>
                        <div class="item_button_size" data-id="switch-109-3" data-pos="1">
                            40 см
                        </div>
                    </div>
                    <div class="tac">
                        <div class="item_button" data-pos="0">
                            <div class="item_price">167 грн</div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-id="109" data-price="167" data-weight="420">Заказать</button>
                            <div class="item_button_done">
                                <div><a href="/cart.html">Добавлено в корзину</a></div>
                            </div>
                        </div>
                        <div class="item_button hidden" data-pos="1">
                            <div class="item_price">249 грн</div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-id="109" data-price="249" data-weight="840">Заказать</button>
                            <div class="item_button_done">
                                <div><a href="/cart.html">Добавлено в корзину</a></div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        @foreach($categories->where('link','articles')->first()->articles()->activeAndSortArticles()->get()->take(4) as $article)
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