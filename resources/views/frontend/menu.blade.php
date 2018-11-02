@if(isset($hotels) AND count($hotels) !== 0 AND $categories_data['hotels']->active == 1)
    <li class="nav-item">
        <a class="nav-link my-1 hover-underline" href="@if(Route::currentRouteName() == 'article_index')#hotelsAnchor @else {{ route('article_index', [setLangToRedirect(App::getLocale()) . '#hotelsAnchor'])}} @endif">{{ $categories_data['hotels']->getTranslate('title') ? $categories_data['hotels']->getTranslate('title') : 'Отели' }}</a>
    </li>
@endif
    <li class="nav-item">
        <a class="nav-link my-1 hover-underline" href="@if(Route::currentRouteName() == 'article_index')#aboutAnchor @else {{ route('article_index', [setLangToRedirect(App::getLocale()) . '#aboutAnchor'])}} @endif">{{trans('base.about_us')}}</a>
    </li>
@if(isset($discounts)  AND $categories_data['discounts']->active == 1)
    <li class="nav-item">
        <a class="nav-link my-1 hover-underline" href="{{ route('article_category', [setLangToRedirect(App::getLocale()), $categories_data['discounts']->getTranslate('url')]) }}">{{ $categories_data['discounts']->getTranslate('title') ? $categories_data['discounts']->getTranslate('title') : 'Акции' }}</a>
    </li>
@endif
<li class="nav-item text-center my-xl-1">
    <a id="desktop-logo" href="{{ route('article_index', [setLangToRedirect(App::getLocale())])}}"><img class="img-fluid mx-center" src="{{ asset('/img/frontend/logo.png') }}" width="140px"></a>
</li>
@if(isset($reviews) AND count($reviews) !== 0 AND $categories_data['reviews']->active == 1)
    <li class="nav-item">
        <a class="nav-link my-1 hover-underline" href="@if(Route::currentRouteName() == 'article_index')#feedbackAnchor @else {{ route('article_category', [setLangToRedirect(App::getLocale()), $categories_data['reviews']->getTranslate('url')]) }} @endif">{{ strstr( $categories_data['reviews']->getTranslate('title') ? $categories_data['reviews']->getTranslate('title') : 'отзывы' . ' ', ' ', true ) }}</a>
    </li>
@endif
@if(isset($contacts) AND count($contacts) !== 0 AND $categories_data['contacts']->active == 1)
    <li class="nav-item">
        <a class="nav-link my-1 hover-underline" href="#contactAnchor">{{ $categories_data['contacts']->getTranslate('title') ? $categories_data['contacts']->getTranslate('title') : 'контакты' }}</a>
    </li>
@endif

