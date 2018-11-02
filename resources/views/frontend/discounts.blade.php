@extends('ws-app')

@section('content')

    <div id="main-view">
        <div class="fourthscreen-img d-flex align-items-center justify-content-center" style="background-image: url('{{ asset ('img/frontend/headers/discount.jpg')}}');">
            <h1 class="pt-5 mt-5 text-uppercase">{{ $categories_data['discounts']->getTranslate('title') ? $categories_data['discounts']->getTranslate('title') : 'акции' }}</h1>
        </div>
    </div>
     <!-- mobile_messenger -->
     @include('frontend.sections.mobile_messengers')
    <!-- END mobile_messenger --> 

    <div class="container-fluid py-5">
        <div class="row justify-content-center">
        <?php $iter = 0 ?>
            @foreach((!$subdomain) ? $rooms : $children_rooms as $key => $room)
                @if($room->getAttributeTranslate('discount_room') OR $room->getAttributeTranslate('marketing_hot_sale') )
                    <div class="col-md-11">
                        <div data-id={{ $iter }} class="apart-card shadow-hover mb-5">
                            <div class="row no-gutters">
                                <div class="col-xl-6">
                                    <div class="apart-image-slider">
                                        @foreach($room->getImages() as $room_img)
                                            <div class="apart-image" style="background-image:url('{{ asset( $room_img['full']) }}')"></div>
                                         @endforeach                                    
                                    </div>
                                    <div class="div-arrows-apart-img-slider">
                                        <div class="div-arrows p-apart-arrow">
                                            <div class="arrow-left">
                                                <div class="back-yellow"></div>
                                                <div class="back-yellow"></div>
                                            </div>
                                        </div>
                                        <div class="div-arrows n-apart-arrow">
                                            <div class="arrow-right">
                                                <div class="back-yellow"></div>
                                                <div class="back-yellow"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bar-container">
                                        @if($room->getAttributeTranslate('discount_room'))
                                            <div class="price-bar">
                                                <p class="apart-old-price custom-line-throught">{{ $room->getAttributeTranslate('base_price')}}</p>
                                                <h4 class="apart-price-h">{{$room->getAttributeTranslate('base_price') - (($room->getAttributeTranslate('base_price') * $room->getAttributeTranslate('discount_room')) / 100)}}</h4>
                                                <small>{{ trans('base.grn')}} {{ trans('base.price_night')}}</small>
                                            </div>

                                            <div class="sale-bar">
                                                <h5 class="sale-text">{{ trans('base.discount')}} {{ $room->getAttributeTranslate('discount_room')}}%</h5>
                                            </div>
                                        @else
                                            <div class="price-bar">
                                                
                                                <h4 class="apart-price-h">{{ $room->getAttributeTranslate('base_price')}}</h4>
                                                <small>{{ trans('base.grn')}} {{ trans('base.price_night')}}</small>
                                            </div>                                       
                                        @endif    
                                    </div>
                                </div>
                                <div class="col-xl-6 p-xl-4 p-3">
                                    <div class="row">
                                        <div class="col-lg-6 mb-lg-0 mb-3">
                                            <h3 data-id={{ $iter }} class="apart-header pb-2">{{ str_limit($room->getTranslate('title'), 50) }}</h3>
                                            <small data-id={{ $iter }} class="apart-hotel">{{ $room->article_parent->getAttributeTranslate('type_build')}} {{ $room->article_parent->getTranslate('title')}}</small>
                                        </div>
                                        <div class="col-lg-3 col-6 text-lg-right"><p class="text-brown-param">{{ trans('base.includes')}}: <i class="fa fa-male align-text-top text-orange"></i> х{{ $room->getAttributeTranslate('max_count_guests')}}</p></div>
                                        <div class="col-lg-3 col-6 text-right"><p class="text-brown-param"><i class="fa fa-map-marker-alt align-text-top text-orange"></i> {{ $room->article_parent->getAttributeTranslate('location')}}</p></div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="apart-description pt-lg-3">
                                                {!! str_limit($room->getTranslate('description') , 200) !!}                                       
                                            </div>
                                            @if($room->getAttributeTranslate('base_count_ guests'))
                                                <small class="apart-text-muted">*{{ trans('base.price_for_person', ['person' => $room->getAttributeTranslate('base_count_ guests')])}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row icons-row mt-4">
                                    <div class="col">
                                        @if($room->getAttributeTranslate('hair_droom'))                                           
                                            <i class="bb-hair-dryer" data-toggle="{{ trans('base.hair_dryer')}}" data-placement="top" title="{{ trans('base.hair_dryer')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('wifi') == 1)
                                                <i class="bb-wifi-gray"  data-toggle="WIFI" data-placement="top" title="WIFI"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('fireplace') == 1)
                                                <i class="bb-fireplace" data-toggle="{{ trans('base.fireplace')}}" data-placement="top" title="{{ trans('base.fireplace')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('kitchen') == 1)
                                                <i class="bb-kitchen" data-toggle="{{ trans('base.kitchen')}}" data-placement="top" title="{{ trans('base.kitchen')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('bathroom') == 1)
                                            <i class="bb-shower" data-toggle="{{ trans('base.bathroom')}}" data-placement="top" title="{{ trans('base.bathroom')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('fridge') == 1)        
                                            <i class="bb-refrigerator" data-toggle="{{ trans('base.fridge')}}" data-placement="top" title="{{ trans('base.fridge')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('safe') == 1)
                                            <i class="bb-safe-box" data-toggle="{{ trans('base.safe')}}" data-placement="top" title="{{ trans('base.safe')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('kettle') == 1)
                                            <i class="bb-electric-kettle" data-toggle="{{ trans('base.kettle')}}" data-placement="top" title="{{ trans('base.kettle')}}"></i>
                                        @endif
                                        
                                        @if($room->getAttributeTranslate('tv') == 1)
                                            <i class="bb-tv" data-toggle="TV" data-placement="top" title="TV"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('Jacuzzi') == 1)
                                            <i class="bb-jacuzzi"  data-toggle="{{ trans('base.Jacuzzi')}}" data-placement="top" title="{{ trans('base.Jacuzzi')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('breakfast') == 1)
                                            <i class="fa fa-plus m-1 text-orange"></i>
                                            <i class="bb-breakfast" data-toggle="{{ trans('base.breakfast')}}" data-placement="top" title="{{ trans('base.breakfast')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('parking') == 1)
                                            <i class="fa fa-plus m-1 text-orange"></i>
                                            <i class="bb-parking" data-toggle="{{ trans('base.parking')}}" data-placement="top" title="{{ trans('base.parking')}}"></i>
                                        @endif 
                                        @if($room->getAttributeTranslate('coffe') == 1)
                                            <i class="fa fa-plus m-1 text-orange"></i>
                                            <i class="bb-teapot" data-toggle="{{ trans('base.coffe')}}" data-placement="top" title="{{ trans('base.coffe')}}"></i>
                                        @endif 
                                        @if($room->getAttributeTranslate('сhildren_room') == 1)
                                            <i class="fa fa-plus m-1 text-orange"></i>
                                            <i class="bb-toy-bold" data-toggle="{{ trans('base.сhildren_room')}}" data-placement="top" title="{{ trans('base.сhildren_room')}}"></i>
                                        @endif 
                                        @if($room->getAttributeTranslate('ski_storage_room') == 1)
                                            <i class="fa fa-plus m-1 text-orange"></i>
                                            <i class="bb-ski-staff" data-toggle="{{ trans('base.ski_storage_room')}}" data-placement="top" title="{{ trans('base.ski_storage_room')}}"></i>
                                        @endif 
                                        @if($room->getAttributeTranslate('bowl_ski_equipment') == 1)
                                            <i class="fa fa-plus m-1 text-orange"></i>
                                            <i class="bb-ski-dryer" data-toggle="{{ trans('base.bowl_ski_equipment')}}" data-placement="top" title="{{ trans('base.bowl_ski_equipment')}}"></i>
                                        @endif 
                                    </div>
                                    </div>
                                    <div class="row mt-4 align-items-end no-gutters">
                                    <div class="col-md-4 calc-price" @if($room->getAttributeTranslate('marketing_hot_sale'))style="display:none" @endif>
                                        <div class="row no-gutters justify-content-center mb-md-0 mb-3">
                                            @if($room->getAttributeTranslate('discount_room'))
                                                <div class="col-md-12 col-6 text-center text-md-left align-self-center">
                                                    <p class="apart-old-total-price"><b class="custom-line-throught"><span class='old-price-apart'>{{ $room->getAttributeTranslate('base_price')}}</span> {{ trans('base.grn')}}</b></p>
                                                </div>
                                                <div class='old_price' data-id={{ $key }}  style='display:none'>{{ $room->getAttributeTranslate('base_price')}}</div>

                                            @endif                                            
                                            <div class='result_price' data-id={{ $key }}  style='display:none'>{{$room->getAttributeTranslate('base_price') - (($room->getAttributeTranslate('base_price') * $room->getAttributeTranslate('discount_room')) / 100)}}</div>
                                            <div class="col-md-12 col-6 align-self-center">
                                                <h3 data-id={{ $iter }} class="apart-total-price">{{$room->getAttributeTranslate('base_price') - (($room->getAttributeTranslate('base_price') * $room->getAttributeTranslate('discount_room')) / 100)}} {{ trans('base.grn')}}</h3>
                                            </div>                                             
                                            <div class="col text-md-left text-center">
                                                <small class="apart-hotel">{{ trans('base.from_')}} <span class='date_from'></span> {{ trans('base.to') }} <span class='date_to'></span> <span class='quantity_days_search'></span></small>
                                            </div>
                                        </div>   
                                    </div> 
                                    
                                    <div class='days' style='display:none'>1</div>
                                    @if($room->getAttributeTranslate('marketing_hot_sale'))
                                        <div class="col-md-8 px-1"><a href="{{ route('article_show', [setLangToRedirect(App::getLocale()), $categories_data['hotels']->getTranslate('url'), $room->article_parent->getAttributeTranslate('url'), $categories_data['rooms']->getTranslate('url'), $room->id])}}" class="btn btn-red-freedates">{{ $room->getAttributeTranslate('marketing_hot_sale')}}</a></div>
                                        <div class="col-md-4 px-1"><a data-toggle="modal" data-id= {{ $iter }} data-target="#exampleModal" class="btn btn-yellow reserved">{{ trans('base.order')}}</a></div>
                                    @else
                                        <div class="col-md-4 col-6 px-1"><a href="{{ route('article_show', [setLangToRedirect(App::getLocale()), $categories_data['hotels']->getTranslate('url'), $room->article_parent->getAttributeTranslate('url'), $categories_data['rooms']->getTranslate('url'), $room->id])}}" class="btn btn-yellow-overline">{{ trans('base.more_')}}</a></div>
                                        <div class="col-md-4 col-6 px-1"><a data-toggle="modal" data-id= {{ $iter }} data-target="#exampleModal" class="btn btn-yellow reserved">{{ trans('base.order')}}</a></div>
                                    @endif
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $iter++ ?>
                @endif
            @endforeach
        </div>
    </div>
        @foreach((!$subdomain) ? $discounts : ((isset($children_discounts)) ? $discounts->where('article_id', 0)->merge($children_discounts) : $discounts->where('article_id', 0)) as $discount)
            <div class="container-fluid pb-5">
                <div class="row justify-content-center">
                    <div class="col-md-11 pb-5">
                        <div class="huge-discount-card shadow-hover">
                            <div class="huge-discount-card-img" style="background-image: url('{{ asset ($discount->getAttributeTranslate('img_discount'))}}')"></div>
                            <h2 class="section-header-huge text-center">{{ $discount->getTranslate('title')}}</h2>
                            <p class="countdown-p text-center m-0" data-time-left="{{date('F j, Y',strtotime($discount->date)) }}"><span class="days-left back-f4f4f4 p-2">00</span> : <span class="hours-left back-f4f4f4 p-2">00</span> : <span class="minutes-left back-f4f4f4 p-2">00</span> : <span class="seconds-left back-f4f4f4 p-2">00</span></p>
                            <p class="text-center mt-1"><small>{{ trans('base.sale_description')}}</small></p>
                            <div class="huge-discount-card-p text-center">{!! $discount->getTranslate('description') !!}</div>
                            <div class="container-fluid d-flex justify-content-center mb-3">
                                <a href="@if($subdomain OR $discount->article_parent){{ route('article_url', [setLangToRedirect(App::getLocale()), $categories_data['hotels']->getTranslate('url'), ($discount->article_parent) ? $discount->article_parent->getAttributeTranslate('url') : $parent_hotel->getAttributeTranslate('url'), $categories_data['search']->getTranslate('url') . '?discount=' . $discount->getAttributeTranslate('discount_room') ]) }}@else {{ route('article_category', [setLangToRedirect(App::getLocale()), $categories_data['search']->getTranslate('url') . '?discount=' . $discount->getAttributeTranslate('discount_room') ]) }} @endif" class="btn btn-yellow px-4">{{ trans('base.check_room') }}</a>
                            </div>
                            <div class="row">
                                <div class="col-xl-4 order-xl-1 order-3 py-3">
                                    <div class="row d-flex pl-xl-4 pr-xl-0 mt-xl-4 px-3">
                                        <div class="col-1 d-flex align-items-center">
                                            <i class="fas fa-phone color-ff8c00 m-xl-0 mx-auto"></i>
                                        </div>
                                        <div class="col-xl-11 col-10 d-flex flex-xl-row flex-column">
                                            <p class="pl-xl-2 phone-discount-card m-0 text-xl-left text-center">{{ $texts->get('tel_1') }}</p>
                                            <p class="pl-xl-2 phone-discount-card m-0 text-xl-left text-center">{{ $texts->get('tel_2') }}</p>
                                        </div>                      
                                    </div>
                                </div>
                                @if($discount->getAttributeTranslate('marketing_dush'))
                                    <div class="col-xl-4 order-xl-2 order-1 d-flex justify-content-center py-3">
                                        <p class="text-uppercase m-0 back-red d-flex justify-content-center align-items-center py-2 px-3">{{ $discount->getAttributeTranslate('marketing_dush')}}</p>
                                    </div>
                                @endif    
                                <div class="col-xl-4 order-xl-3 order-2 py-3">
                                    <div class="row d-flex pl-xl-0 pl-xl-4 pr-xl-0 justify-content-xl-end mt-xl-4 px-3">
                                        <div class="col-1 d-flex align-items-center">
                                            <i class="far fa-calendar-alt color-ff8c00 mr-xl-2 mx-auto d-xl-none"></i>
                                        </div>
                                        @if($discount->date)
                                            <div class="col-xl-11 col-10 p-0">
                                                <p class="text-xl-right text-center pr-xl-5 m-0"><i class="far fa-calendar-alt color-ff8c00 mr-2 d-xl-inline d-none"></i>{{ trans('base.sale_to')}} {{date('d.m.Y',strtotime($discount->date)) }}</p>  
                                            </div>
                                        @endif    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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
    <!-- modal window -->
    @include('frontend.sections.modal')
    <!--  END modal window -->
    <!-- modal end_reservation -->
    @include('frontend.sections.end_reservation')
    <!--  END modal end_reservation -->
@endsection