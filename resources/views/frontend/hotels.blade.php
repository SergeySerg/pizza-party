@extends('ws-app')

@section('content')
<div id="main-slider">
    <!-- slider -->
        @include('frontend.sections.slider')
    <!-- slider -->  
    <div id="selector-bar-id" class="selector-bar">
        <div class="container-fluid px-1 main-form bottom-1-vh"> 
            <!-- form for find -->
                @include('frontend.sections.form_find')
            <!-- END form for find -->
        </div>
    </div> 
    </div>
    <!-- mobile_messenger -->
        @include('frontend.sections.mobile_messengers')
    <!-- END mobile_messenger --> 
    <div class="container-fluid px-sm-5 pb-5">
        <div class="row text-center">
            <div class="col">
                <h2 class="section-header-huge">{{ $parent_hotel->getAttributeTranslate('type_build')}} {{ $parent_hotel->getTranslate('title')}}</h2>
                <!-- <h4 class="section-header-small">в яремче та буковелі</h4> -->
                <div class="section-description">{!! $parent_hotel->getTranslate('short_description') !!}</div>
            </div>
        </div>
        
        <div class="row justify-content-center no-gutters px-md-5 px-0">
        <?php $i = 0 ?>
            @foreach($children_rooms->take(5) as $key => $room)
                @if($room->getAttributeTranslate('show_hotel_page') AND $room->getAttributeTranslate('show_hotel_page') == 1)
                <!-- Типова мала карточка номеру -->
                <?php $base_price = $room->getPrice($room->id, $room->article_parent->id)['base_price'] ?>
                    <div class="col-xl-4 col-lg-6 p-2 mt-4">
                        <a href="{{ route('article_show', [setLangToRedirect(App::getLocale()), $categories_data['hotels']->getTranslate('url'), $room->article_parent->getAttributeTranslate('url'), $categories_data['rooms']->getTranslate('url'), $room->id])}}" class="a-card">
                            <div class="apart-small-card shadow-hover">
                                <div class="small-card-image" style="background-image: url('{{ asset( $room->getAttributeTranslate('room_photo')) }}')"></div>
                                <div class="row pt-3 mb-1 px-md-4 px-3">
                                    <div class="col-7 d-flex align-items-end">
                                        <h5 class="small-card-header m-0">{{ str_limit($room->getTranslate('title'), 20) }}</h5>
                                    </div>
                                    <!-- <div class="col-4 text-right">
                                        <p class="alt-dates m-0">з 05.10 по 08.10</p>
                                    </div> -->
                                </div>
                                <div class="row pb-1  px-md-4 px-3">
                                    <div class="col-8">
                                        <small class="small-card-hotel">{{ $room->article_parent->getAttributeTranslate('type_build')}} {{ $room->article_parent->getTranslate('title')}}</small>
                                    </div>
                                    <div class="col-4 text-right">
                                        <p class="location-text"><i class="fas fa-map-marker-alt color-ff8c00"></i> {{ $room->article_parent->getAttributeTranslate('location')}}</p>
                                    </div>
                                </div>
                                @if($room->getAttributeTranslate('discount_room'))
                                <div class="apart-small-card-buy d-flex flex-column justify-content-center">
                                    <p class="text-center apart-small-card-buy-hotel-p d-flex align-items-center justify-content-between">
                                        {{trans('base.from')}} 
                                        <span class="d-flex flex-column">
                                            <span class="old-price-hotel-card custom-line-throught">{{--{{ $room->getPrice($room->id, $room->article_parent->id)->getAttributeTranslate('base_price')}}--}}{{ $base_price }}</span>
                                                <strong>
                                                    {{$base_price - (($base_price * $room->getAttributeTranslate('discount_room')) / 100)}}
                                                </strong>
                                            </span> 
                                            {{trans('base.grn')}}
                                    </p>
                                </div>
                            @else 
                                <div class="apart-small-card-buy d-flex flex-column justify-content-center">
                                    <p class="text-center apart-small-card-buy-hotel-p">{{trans('base.from')}} <strong>{{ $base_price }}</strong> {{trans('base.grn')}}</p>
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
                    @if($i == 2)
                        <div class="align-self-center fake col-xl-2 fake-left"></div>
                    @endif
                    <?php $i++;
                        
                    ?>                  
                @endif
            @endforeach
            <div class="align-self-center fake col-xl-2 fake-right"></div>
            

        </div>
    </div>
    @if(isset($children_advantages) AND $children_advantages)
        <!-- Розділ фіч -->
        <div class="container-fluid pb-5 back-f4f4f4">
            <div class="row text-center">
                <div class="col">
                    <h2 class="section-header-huge pb-5 text-uppercase">{{ $categories_data['advantages']->getTranslate('title') }}</h2>
                </div>
            </div>
            
            <div id="feature" class="row no-gutters text-center justify-content-center">
                    <?php $j = 0 ?>
                    @foreach($children_advantages->take(6) as $advantage)
                        <div class="col-md-3 col-6 py-2 my-2 mb-5">
                            {!! $advantage->getAttributeTranslate('icon') !!}
                            <h5 class="feature-text">{!! $advantage->getTranslate('title') !!}</h5>
                        </div>
                        @if($j == 2)<div class="w-100 text-divider"></div>@endif
                        <?php $j++ ?>
                    @endforeach  
                    
                </div>
        </div>
    @endif    
    
      <!-- marketings -->
      @include('frontend.sections.marketings')
    <!--  END marketings -->
   
    <!-- Блок послуг -->
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col">
                <h2 class="section-header-huge text-uppercase">{{ strstr( $categories_data['servicesfree']->getTranslate('title') . ' ', ' ', true ) }} {{ trans('base.hotel') }} {{ $parent_hotel->getTranslate('title')}}</h2>
                <p class="section-description">{{ trans('base.free_services') }}</p>
            </div>
        </div>
        <div class="row text-center align-items-center justify-content-center no-gutters px-md-5 px-0 pb-5">
            <?php $k = 0 ?>
            @foreach($children_servicesfree as $service)
                <div class="col-lg-3 col-md-6 p-5 @if(!$service->getAttributeTranslate('icon'))back-f4f4f4 @endif">
                    <div class="vert-aligner-container">
                    <div class="vert-aligner">
                            <h5 class="mb-4">{{ $service->getTranslate('title')}}</h5>
                            {!! $service->getAttributeTranslate('icon') !!}
                    </div> 
                    </div>
                </div>
                <?php $k++ ?>
            @endforeach
            
        </div>
    </div>
   
    <!-- reviews_callback -->
        @include('frontend.sections.reviews')
    <!--  END reviews_callback -->
    <!-- callback -->
        @include('frontend.sections.callback')
    <!--  END callback -->

@endsection