@extends('ws-app')

@section('content')
<div id="main-slider">
        <div class="slider-class">
            <div class="fullscreen-img d-flex flex-column align-items-center justify-content-md-center justify-content-start mt-md-0 mt-5" style="background-image: url(' {{ asset('img/frontend/headers/404.jpg') }} ');">
                <h1 class="huge-404 m-md-0 mb-0 mt-5">404</h1>
                <p>{{ trans('base.error_404')}} :(</p>
                <div class="input-pattern my-4">
                    <a class="btn btn-yellow get-in-touch-btn text-uppercase px-5 py-4 d-flex align-items-center"  href="{{ route('article_index', [setLangToRedirect(App::getLocale())])}}" >{{ trans('base.back')}}</a>
                </div>
            </div>
        </div>
        <div id="selector-bar-id">
            <div class="container-fluid px-1 main-form bottom-0-vh">
                <div class="d-flex container-fluid justify-content-center py-lg-3">
                    <h2 class="text-uppercase text-center m-0">{{ $main->first()->getTranslate('title') }} {{ $main->first()->getAttributeTranslate('location')}}</h2>
                </div>
                <!-- form for find -->
                @include('frontend.sections.form_find')
                <!-- END form for find -->
            </div>
        </div>
    </div>

    <div class="container-fluid pb-5 back-f4f4f4">
        <div class="row text-center">
            <div class="col">
                <h2 class="section-header-huge pb-5">{{ trans('base.popular_rooms') }}</h2>
            </div>
        </div>
        <div class="row justify-content-center no-gutters px-md-5 px-0 pb-3">
        <?php $i = 0 ?>
            @foreach((!$subdomain) ? $rooms->random(3) : $children_rooms->random(3) as $room)
                    <!-- Типова мала карточка номеру -->
                    <div class="col-xl-4 col-lg-6 p-2 mt-4">
                        <a href="{{ route('article_show', [setLangToRedirect(App::getLocale()), $categories_data['hotels']->getTranslate('url'), $room->article_parent->getAttributeTranslate('url'), $categories_data['rooms']->getTranslate('url'), $room->id])}}" class="a-card">
                            <div class="apart-small-card shadow-hover">
                                <div class="small-card-image" style="background-image: url('{{ asset( $room->getAttributeTranslate('room_photo')) }}')"></div>
                                <div class="row pt-3 mb-1 px-md-4 px-3">
                                    <div class="col-7 d-flex align-items-end">
                                        <h5 class="small-hotel-header m-0">{{ str_limit($room->getTranslate('title'), 20) }}</h5>
                                    </div>
                                    <!-- <div class="col-5 text-right">
                                        <p class="alt-dates m-0">з 05.10 по 08.10</p>
                                    </div> -->
                                </div>
                                <div class="row pb-1  px-md-4 px-3">
                                    <div class="col-7">
                                        <small class="small-card-hotel">{{ $room->article_parent->getAttributeTranslate('type_build')}} {{ $room->article_parent->getTranslate('title')}}</small>
                                    </div>
                                    <div class="col-5 text-right">
                                        <p class="location-text"><i class="fas fa-map-marker-alt color-ff8c00"></i> {{ $room->article_parent->getAttributeTranslate('location')}}</p>
                                    </div>
                                </div>
                                @if($room->getAttributeTranslate('discount_room'))
                                <div class="apart-small-card-buy d-flex flex-column justify-content-center">
                                    <p class="text-center apart-small-card-buy-hotel-p d-flex align-items-center justify-content-between">
                                        {{trans('base.from')}} 
                                        <span class="d-flex flex-column">
                                            <span class="old-price-hotel-card custom-line-throught">{{ $room->getAttributeTranslate('base_price')}}</span>
                                                <strong>
                                                    {{$room->getAttributeTranslate('base_price') - (($room->getAttributeTranslate('base_price') * $room->getAttributeTranslate('discount_room')) / 100)}}
                                                </strong>
                                            </span> 
                                            {{trans('base.grn')}}
                                    </p>
                                </div>
                            @else 
                                <div class="apart-small-card-buy d-flex flex-column justify-content-center">
                                    <p class="text-center apart-small-card-buy-hotel-p">{{trans('base.from')}} <strong>{{ $room->getAttributeTranslate('base_price')}}</strong> {{trans('base.grn')}}</p>
                                </div>

                            @endif
                            <div class="apart-small-card-buy-hover apart-small-hover-hotel">
                                <p class="d-flex justify-content-center align-items-center text-uppercase">
                                    {{trans('base.reservation')}}
                                </p>
                                </div>
                            @if($room->getAttributeTranslate('discount_room'))
                                <div class="apart-small-discount-hotel">
                                    <p class="text-center py-1 text-uppercase">{{ trans('base.discount')}} {{ $room->getAttributeTranslate('discount_room')}}%</p>
                                </div>
                            @endif
                            </div>
                        </a>
                    </div>               
                   
                    <?php $i++;
                        
                    ?>                  
            @endforeach 
        </div>
    </div>


   

@endsection