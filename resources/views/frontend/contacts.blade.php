@extends('ws-app')

@section('content')

    <div id="main-view">
        <div class="fourthscreen-img d-flex align-items-center justify-content-center" style="background-image: url('{{ asset ($search->first()->getAttributeTranslate('img_search'))}}');">
            <h1 class="pt-5 mt-5 text-uppercase">{{ $categories_data['contacts']->getTranslate('title') ? $categories_data['contacts']->getTranslate('title') : 'контакты' }}</h1>
        </div>
    </div>
   
     <!-- mobile_messenger -->
     @include('frontend.sections.mobile_messengers')
    <!-- END mobile_messenger --> 
    
    
    <div class="container-fluid pb-5">
        <div class="row text-center">
            <div class="col">
                <h2 class="section-header-huge pb-5">{!! $categories_data['contacts']->getTranslate('short_description') !!}</h2>
            </div>
        </div>
        
        <div class="row no-gutters text-center px-lg-5">
            <div class="col-md-3 p-3">
                <i class="fas fa-bus fa-10x circle-around"></i>
                <h5 class="feature-text">{{ trans('base.bus')}}</h5>
                <div class="apart-description my-4">
                    {!! $children_contacts->first()->getAttributeTranslate('bus_way') !!}               
                 </div>
            </div>
            <div class="col-md-3 p-3">
                <i class="fas fa-car fa-10x circle-around"></i>
                <h5 class="feature-text mb-4">{{ trans('base.car')}}</h5>
                <div class="apart-description my-4">
                    {!! $children_contacts->first()->getAttributeTranslate('car_way') !!}               
                 </div>
            </div>
            <div class="col-md-3 p-3">
                <i class="fas fa-train fa-10x circle-around"></i>
                <h5 class="feature-text mb-4">{{ trans('base.train')}}</h5>
                <div class="apart-description my-4">
                    {!! $children_contacts->first()->getAttributeTranslate('train_way') !!}               
                 </div>
            </div>
            <div class="col-md-3 p-3">
                <i class="fas fa-plane fa-10x circle-around"></i>
                <h5 class="feature-text mb-4">{{ trans('base.aircraft')}}</h5>
                <div class="apart-description my-4">
                    {!! $children_contacts->first()->getAttributeTranslate('air_way') !!}               
                 </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-md-6 order-md-2 back-f4f4f4 px-md-5 px-3">
                <div class="row">
                    <div class="col-md-7 mt-4">
                        <h5 class="feature-text-brown mb-4 text-center text-md-left">{{ trans('base.reception') }}</h5>
                        <p class="contacts-text">
                            <i class="fas fa-phone text-orange mr-1"></i>
                            {{ $children_contacts->first()->getAttributeTranslate(' reception_tel1') }}<br>
                            <span class="ml-4">{{ $children_contacts->first()->getAttributeTranslate(' reception_tel2') }}</span>
                        </p>
                        <p class="contacts-text mb-5">
                            <i class="fas fa-envelope text-orange mr-1"></i>
                            {{ $children_contacts->first()->getAttributeTranslate('email') }}<br>
                            {{--<span class="ml-4">info@vedmedycya.com.ua</span>--}}
                        </p>
                        <h5 class="feature-text-brown mb-4 text-center text-md-left">{{ trans('base.reservation_department') }}</h5>
                        <p class="contacts-text">
                            <i class="fas fa-phone text-orange mr-1"></i>
                            {{ $children_contacts->first()->getAttributeTranslate('reservation_tel1') }}<br>
                            <span class="ml-4">{{ $children_contacts->first()->getAttributeTranslate('reservation_tel2') }}</span>
                        </p>
                        <p class="contacts-text mb-5">
                            <i class="fas fa-envelope text-orange mr-2"></i>
                            {{ $children_contacts->first()->getAttributeTranslate('email') }}
                        </p>
                    </div>
                    <div class="col-md-5 mt-4">
                        <h5 class="feature-text-brown mb-4 text-center text-md-left">{{ trans('base.restaurant') }}</h5>
                        <p class="contacts-text mb-5">
                            <i class="fas fa-phone text-orange mr-2"></i>
                            {{ $children_contacts->first()->getAttributeTranslate('restaurant_tel1') }}
                        </p>
                        <h5 class="feature-text-brown mb-4 text-center text-md-left">{{ trans('base.address') }}</h5>
                        <p class="contacts-text mb-5">
                            <i class="fas fa-map-marker-alt text-orange mr-2"></i>
                            {{ $children_contacts->first()->getAttributeTranslate('address') }}<br>
                            <span class="ml-4">{{ $children_contacts->first()->getAttributeTranslate('street') }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 order-md-1">
                <iframe src="{{ $parent_hotel->getAttributeTranslate('map') }}" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen class="max-100"></iframe>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            <div class="col text-center mt-4 mb-5">
                <p class="section-description pb-3">{{ trans('base.connect_socials')}}:</p>
                @if(isset($social) AND count($social) !== 0 AND $categories_data['social']->active == 1)
                    @foreach($social as $social_item)
                        <div class="footer-icon-container"><a href="{{ $social_item->getAttributeTranslate('social_link') ? $social_item->getAttributeTranslate('social_link') : "#"}}" target="_blank" class="text-white">{!! $social_item->getAttributeTranslate('icon') ? $social_item->getAttributeTranslate('icon') : " " !!}</a></div>                        
                    @endforeach                    
                @endif                
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

    <div class="container-fluid px-1 back-747474">
        <!-- form for find -->
        @include('frontend.sections.form_find')
        <!-- END form for find -->
    </div>
@endsection