    <li class="nav-item">
        <a class="nav-link my-1 hover-underline" href="{{ route('article_index_subdomain', [setLangToRedirect(App::getLocale()), $categories_data['hotels']->getTranslate('url'), $base_hotel->getAttributeTranslate('url')])}}">{{ trans('base.main') }}</a>
    </li>
@if(isset($rooms) AND count($rooms) !== 0 AND $categories_data['rooms']->active == 1)
    <li class="nav-item">
        <a class="nav-link my-1 hover-underline" href="{{ route('article_url', [setLangToRedirect(App::getLocale()), $categories_data['hotels']->getTranslate('url'), $base_hotel->getAttributeTranslate('url'), $categories_data['search']->getTranslate('url')]) }}">{{ $categories_data['rooms']->getTranslate('title') ? $categories_data['rooms']->getTranslate('title') : 'номери'}}</a>
    </li>
@endif
@if(isset($servicespaid) AND $categories_data['servicespaid']->active == 1)
    <li class="nav-item">
        <a class="nav-link my-1 hover-underline" href="{{ route('article_url', [setLangToRedirect(App::getLocale()), $categories_data['hotels']->getTranslate('url'), $base_hotel->getAttributeTranslate('url'), $categories_data['servicespaid']->getTranslate('url')]) }}">{{ strstr( $categories_data['servicespaid']->getTranslate('title') ? $categories_data['servicespaid']->getTranslate('title') : 'услуги' . ' ', ' ', true ) }}</a>
    </li>
@endif
<li class="nav-item text-center my-xl-1">
    <a id="desktop-logo" href="{{ route('article_index', [setLangToRedirect(App::getLocale())])}}"><img class="img-fluid mx-center" src="{{ asset('/img/frontend/logo.png') }}" width="140px"></a>
</li>
@if(isset($reviews) AND count($reviews) !== 0 AND $categories_data['reviews']->active == 1)
    <li class="nav-item">
        <a class="nav-link my-1 hover-underline" href="{{ route('article_url', [setLangToRedirect(App::getLocale()), $categories_data['hotels']->getTranslate('url'), $base_hotel->getAttributeTranslate('url'), $categories_data['reviews']->getTranslate('url')]) }}">{{ strstr( $categories_data['reviews']->getTranslate('title') ? $categories_data['reviews']->getTranslate('title') : 'отзывы' . ' ', ' ', true ) }}</a>
    </li>
@endif
@if(isset($discounts) AND $categories_data['discounts']->active == 1)
    <li class="nav-item">
        <a class="nav-link my-1 hover-underline" href="{{ route('article_url', [setLangToRedirect(App::getLocale()), $categories_data['hotels']->getTranslate('url'), $base_hotel->getAttributeTranslate('url'), $categories_data['discounts']->getTranslate('url')]) }}">{{ $categories_data['discounts']->getTranslate('title') ? $categories_data['discounts']->getTranslate('title') : 'акции' }}</a>
    </li>
@endif
@if(isset($contacts) AND count($contacts) !== 0 AND $categories_data['contacts']->active == 1)
    <li class="nav-item">
        <a class="nav-link my-1 hover-underline" href="{{ route('article_url', [setLangToRedirect(App::getLocale()), $categories_data['hotels']->getTranslate('url'), $base_hotel->getAttributeTranslate('url'), $categories_data['contacts']->getTranslate('url')]) }}">{{ $categories_data['contacts']->getTranslate('title') ? $categories_data['contacts']->getTranslate('title') : 'контакты' }}</a>
    </li>
@endif
