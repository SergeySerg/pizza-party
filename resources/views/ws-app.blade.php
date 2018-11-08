<!doctype html>
<html lang="{{ App::getLocale() }}">
<head>
<link rel="shortcut icon" href="{{ asset('/img/favicon/favicon.png') }}?1" type="image/x-icon">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>
    Пицца Пати (Киев)
</title>
{{--<meta name="description" content="@if($categories_data[$type]->getTranslate('meta_description')){{ $categories_data[$type]->getTranslate('meta_description') }} @else Пицца Пати (Киев)@endif">
<meta name="keywords" content="@if($categories_data[$type]->getTranslate('meta_keywords')){{ $categories_data[$type]->getTranslate('meta_keywords') }} @else  Пицца Пати (Киев) @endif"> --}}
	<!-- <link rel="shortcut icon" href="{{ asset('/img/favicon/favicon.png') }}" >
	<link rel="apple-touch-icon" href="{{ asset('/img/favicon/apple-touch-icon.png') }}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon/apple-touch-icon-72x72.png') }}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/img/favicon/apple-touch-icon-114x114.png') }}"> -->

    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC:400,700&amp;subset=cyrillic-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <meta name='robots' content='noindex,follow' />
    <link rel='stylesheet' id='mdl-css-css' href="{{ asset('/css/frontend/material.min.css') }}?ver={{ $version }}" type='text/css' media='' />
    <link rel='stylesheet' id='slick-css-css' href="{{ asset('/css/frontend/slick.css') }}?ver={{ $version }}" type='text/css' media='' />
    <link rel='stylesheet' id='slick2-css-css' href="{{ asset('/css/frontend/slick-theme.css') }}?ver={{ $version }}" type='text/css' media='' />
    <link rel='stylesheet' id='gallery-css-css' href="{{ asset('/css/frontend/magnific-popup.css') }}?ver={{ $version }}" type='text/css' media='' />
    <link rel='stylesheet' id='main-css-css' href="{{ asset('/css/frontend/style.css') }}?ver={{ $version }}" type='text/css' media='' />
    <link href="{{ asset('/css/plugins/sweetalert.css') }}" rel="stylesheet">
</head>
<body class="home page-template-default page page-id-2">
    <div class="layout">
        <header>
            <div class="reducer">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col tac">
                        <a href="/" class="logo">
                            <em><img src="{{ asset('/img/frontend/logo.svg') }}" alt="Пицца Пати (Киев)"></em>
                        </a>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col header_support_cell">
                        <div class="header_support">
                            <div class="phone"><a href="tel:{{ $texts->get('tel_1') }}">{{ $texts->get('tel_1') }}</a></div>
                            <div class="schedule">{{ $texts->get('get_order') }}</div>
                            <a href="{{ route('article_list', [null, 'map', null]) }}">{{ trans('base.map_delivery')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="reducer">
            <div class="mdl-grid nav-grid">
                <div class="mdl-cell mobile_menu">
                    <button id="mobile_menu_block" class="mdl-button mdl-js-button mdl-button--icon">
                        <i class="material-icons">{{ trans('base.menu')}}</i>
                    </button>
                    <div class="mdl-menu mdl-menu--bottom-left mdl-js-menu mdl-js-ripple-effect" for="mobile_menu_block">
                        <div class="menu-main-container">
                            <ul id="menu-main" class="mobile_menu_list">
                                @foreach($categories_for_menu as $key => $category_for_menu)
                                    <li id="menu-item-{{$key}}" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-{{$key}} mdl-menu__item"><a href="{{ route('article_list', [null, $category_for_menu->link]) }}">{{ $category_for_menu->getTranslate('title')}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mdl-cell nav_support">
                    <div class="header_support">
                        <div class="phone"><a href="tel:{{ $texts->get('tel_1') }}">{{ $texts->get('tel_1') }}</a></div>
                        <div class="schedule">{{ $texts->get('get_order') }}</div>
                        <a href="{{ route('article_list', [null, 'map', null]) }}">{{ trans('base.map_delivery')}}</a>
                    </div>
                </div>
                <nav class="mdl-cell">
                    <div class="menu-main-container">
                        <ul id="primary-menu" class="mdl-navigation">
                        @foreach($categories_for_menu as $key => $category_for_menu)
                            <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-{{ $key }} mdl-navigation__link"><a href="{{ route('article_list', [null, $category_for_menu->link]) }}">{{ $category_for_menu->getTranslate('title')}}</a></li>
                        @endforeach
                        </ul>
                    </div>
                </nav>
                <div class="mdl-cell">
                    <a href="{{ route('article_list', [null, 'cart', null]) }}" class="header_cart" id="header_top_cart">
                        <div class="header_cart_top">
                            {{ trans('base.backet') }}: <span id="total_cart">0</span> шт.
                        </div>
                        {{ trans('base.cost') }}: <span id="total_price">0</span> грн.
                    </a>
                </div>
            </div>
        </div>

        @yield('content')

        <footer>
            <div class="reducer">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div>© 2009—<?php echo date("Y");?> {{trans('base.pizza_network')}} <b>Pizza Party</b>™.</div>
                        <div>{{trans('base.contact_tel')}}: +38{{ $texts->get('tel_1') }}, email <a href="mailto:{{ $texts->get('email') }}">{{ $texts->get('email') }}</a></div>
                    </div>
                </div>
            </div>
        </footer><!-- #colophon -->
    </div><!-- #page -->
    <!-- file_translate -->
        @include('frontend.sections.i18n')
    <!--  END file_translate-->
{{-- JS --}}
{{--Binotel--}}
    <script type="text/javascript">
        (function(d, w, s) {
          var widgetHash = '28wtrufy5lqh1hyysds6', gcw = d.createElement(s); gcw.type = 'text/javascript'; gcw.async = true;
          gcw.src = '//widgets.binotel.com/getcall/widgets/'+ widgetHash +'.js';
          var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(gcw, sn);
        })(document, window, 'script');
      </script> 
{{--/Binotel--}}
<script type='text/javascript' src="{{ asset('/js/frontend/jquery.js') }}"></script>
    <script type='text/javascript' src="{{ asset('/js/frontend/jquery-migrate.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('/js/frontend/maskedinput.js') }}"></script>
    <script type='text/javascript' src="{{ asset('/js/frontend/slick.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('/js/frontend/material.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('/js/frontend/jquery.magnific-popup.min.js') }}?ver={{ $version }}"></script>
    <script type='text/javascript' src="{{ asset('/js/plugins/sweetalert.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('/js/frontend/custom-content.js') }}?ver={{ $version }}"></script>
    
{{-- /JS --}}
<div class="fade"></div>
<div class="dt_popup">
    <div class="dt_popup_bg">
        <div class="dt_popup_close"></div>
        <div class="dt_popup_content"></div>
    </div>
</div>

</body>
</html>
