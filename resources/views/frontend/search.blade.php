@extends('ws-app')

@section('content')
<div id="main-view">
        <div class="halfscreen-img d-flex align-items-center justify-content-center" style="background-image: url('{{ asset ($search->first()->getAttributeTranslate('img_search'))}}');">
            <h1 class="pb-5 text-uppercase">
                {{ $search->first()->getAttributeTranslate('slogan1') }}
                <br class="text-divider"> 
                {{ $search->first()->getAttributeTranslate('slogan2') }}
            </h1>
        </div>
        <div class="main-form">
            <div class="container-fluid px-1">
                <div class="row no-gutters justify-content-center py-md-3 py-1 px-md-5">
                    <div class="col-lg-2 col-md-3 my-1">
                        <div id="div-datepicker" class="input-pattern">
                            <i class="fas fa-calendar-alt input-icon"></i>
                            <input type='text' data-language="{{ App::getLocale()}}" data-multiple-dates-separator=" - " class="datepicker-here cursor-pointer" id="datepicker" placeholder="Дата" readonly="readonly"/>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 my-1">
                    <div class="input-pattern">
                        <p id="guests" class="input-text">{{ trans('base.count_guestі')}}</p>
                        <i class="fas fa-male input-icon"></i>
                        <div class="input-dropdown">
                            <div class="input-members d-flex justify-content-between">
                                <p>{{ trans('base.adults')}}</p>
                                <span>
                                    <button id="adults_minus" type="button">
                                        <i class="fas fa-minus fa-lg add-member-btn"></i>
                                    </button>
                                    <input id="adults" type="number" name="adults" min="0" value="0" readonly="readonly" />
                                    <button id="adults_plus" type="button">
                                        <i class="fas fa-plus fa-lg add-member-btn"></i>
                                    </button>
                                </span>
                            </div>
                            <div class="input-members d-flex justify-content-between">
                                <p>{{ trans('base.children')}}<br/><sup>5-12 {{ trans('base.years')}}</sup></p>
                                <span>
                                    <button id="children_minus"type="button">
                                        <i class="fas fa-minus fa-lg add-member-btn"></i>
                                    </button>
                                    <input id="children" type="number" name="children" min="0" value="0" readonly="readonly" />
                                    <button id="children_plus" type="button">
                                        <i class="fas fa-plus fa-lg add-member-btn"></i>
                                    </button>
                                </span>
                            </div>
                            <p class="children-up-to-5"><sub>{{ trans('base.free_children')}}</sub></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 my-1">
                    <div class="input-pattern">
                        <button type="submit" class="search submit-button text-uppercase">{{ trans('base.check_price') }}</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
   
    <!-- mobile_messenger -->
    @include('frontend.sections.mobile_messengers')
    <!-- END mobile_messenger -->
    
    <div class="container-fluid px-sm-5 pb-3">
        <div class="row text-center">
            <div class="col">
                <h2 class="section-header-huge text-uppercase">{{ trans('base.search')}} {{ count((!$subdomain) ? $rooms : $children_rooms) }} {{ trans('base.count_rooms')}}</h2>
                <div class="section-description">
                    {!! $search->first()->getTranslate('short_description') !!}
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid pb-5">
        <div class="row justify-content-center pb-5">
        <?php $r = 0 ?>
            @foreach((!$subdomain) ? $rooms : $children_rooms as $key => $room)
                <!-- APARTMENT CARD START -->
                <?php $base_price = $room->getPrice($room->id, $room->article_parent->id)['base_price'] ?>
                <div class="col-md-11">
                    <div data-id={{ $r }} class="apart-card shadow-hover mb-5">
                        <div class="row no-gutters">
                            <div class="col-lg-6">
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
                                    @if(Request::get('discount') OR $room->getAttributeTranslate('discount_room'))
                                        <div class="price-bar">
                                            <p  data-attribute-id={{ $r}} class="apart-old-price custom-line-throught">{{ $base_price}}</p>
                                            <h4  data-attribute-id={{ $r}} class="apart-price-h">{{$base_price - (($base_price * ((Request::get('discount')) ? Request::get('discount') : $room->getAttributeTranslate('discount_room'))) / 100)}}</h4>
                                            <small>{{ trans('base.grn')}} {{ trans('base.price_night')}}</small>
                                        </div>

                                        <div class="sale-bar">
                                            <h5 class="sale-text">{{ trans('base.discount')}} {{ (Request::get('discount')) ? Request::get('discount') : $room->getAttributeTranslate('discount_room')}}%</h5>
                                        </div>
                                    @else
                                        <div class="price-bar">
                                            
                                            <h4 data-attribute-id={{ $r}} class="apart-price-h">{{ $base_price}}</h4>
                                            <small>{{ trans('base.grn')}} {{ trans('base.price_night')}}</small>
                                        </div>                                       
                                    @endif    
                                </div>
                            </div>
                            <div class="col-lg-6 p-lg-4 p-3">
                                <div class="row">
                                    <div class="col-md-6 mb-md-0 mb-3">
                                        <h3 data-id={{ $r }} class="apart-header pb-2">{{ str_limit($room->getTranslate('title'), 50) }}</h3>
                                        <small data-id={{ $r }} class="apart-hotel">{{ $room->article_parent->getAttributeTranslate('type_build')}} {{ $room->article_parent->getTranslate('title')}}</small>
                                    </div>
                                    <div class="col-md-3 col-6 text-md-right"><p class="text-brown-param">{{ trans('base.includes')}}: <i class="fa fa-male align-text-top text-orange"></i> х{{ $room->getAttributeTranslate('max_count_guests')}}</p></div>
                                    <div class="col-md-3 col-6 text-right"><p class="text-brown-param"><i class="fa fa-map-marker-alt align-text-top text-orange"></i> {{ $room->article_parent->getAttributeTranslate('location')}}</p></div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="apart-description pt-md-3">
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
                                            <i class="bb-hair-dryer" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.hair_dryer')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('wifi') == 1)
                                            <i class="bb-wifi-gray"  data-toggle="tooltip" data-placement="top" data-original-title="WIFI"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('fireplace') == 1)
                                                <i class="bb-fireplace" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.fireplace')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('kitchen') == 1)
                                                <i class="bb-kitchen" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.kitchen')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('bathroom') == 1)
                                            <i class="bb-shower" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.bathroom')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('fridge') == 1)        
                                            <i class="bb-refrigerator" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.fridge')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('safe') == 1)
                                            <i class="bb-safe-box" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.safe')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('kettle') == 1)
                                            <i class="bb-electric-kettle" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.kettle')}}"></i>
                                        @endif
                                        
                                        @if($room->getAttributeTranslate('tv') == 1)
                                            <i class="bb-tv" data-toggle="tooltip" data-placement="top" data-original-title="TV"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('Jacuzzi') == 1)
                                            <i class="bb-jacuzzi"  data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.Jacuzzi')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('breakfast') == 1)
                                            <i class="fa fa-plus m-1 text-orange"></i>
                                            <i class="bb-breakfast" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.breakfast')}}"></i>
                                        @endif
                                        @if($room->getAttributeTranslate('parking') == 1)
                                            <i class="fa fa-plus m-1 text-orange"></i>
                                            <i class="bb-parking" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.parking')}}"></i>
                                        @endif 
                                        @if($room->getAttributeTranslate('coffe') == 1)
                                            <i class="fa fa-plus m-1 text-orange"></i>
                                            <i class="bb-teapot" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.coffe')}}"></i>
                                        @endif 
                                        @if($room->getAttributeTranslate('сhildren_room') == 1)
                                            <i class="fa fa-plus m-1 text-orange"></i>
                                            <i class="bb-toy-bold" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.сhildren_room')}}"></i>
                                        @endif 
                                        @if($room->getAttributeTranslate('ski_storage_room') == 1)
                                            <i class="fa fa-plus m-1 text-orange"></i>
                                            <i class="bb-ski-staff" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.ski_storage_room')}}"></i>
                                        @endif 
                                        @if($room->getAttributeTranslate('bowl_ski_equipment') == 1)
                                            <i class="fa fa-plus m-1 text-orange"></i>
                                            <i class="bb-ski-dryer" data-toggle="tooltip" data-placement="top" data-original-title="{{ trans('base.bowl_ski_equipment')}}"></i>
                                        @endif 
                                    </div>
                                </div>
                                <div class="row mt-4 align-items-end no-gutters">
                                    <div class="col-md-4 calc-price">
                                        <div class="row no-gutters justify-content-center mb-md-0 mb-3">
                                            @if(Request::get('discount') OR $room->getAttributeTranslate('discount_room'))
                                                <div class="col-md-12 col-6 text-center text-md-left align-self-center">
                                                    <p class="apart-old-total-price"><b class="custom-line-throught"><span data-attribute-id={{ $r }} class='old-price-apart'>{{ $base_price}}</span> {{ trans('base.grn')}}</b></p>
                                                </div>
                                                <div class='old_price' data-attribute-id={{ $r }} data-id={{ $key }}  style='display:none'>{{ $base_price}}</div>

                                            @endif                                            
                                            <div class='result_price' data-attribute-id={{ $r }} data-id={{ $key }}  style='display:none'>{{$base_price - (($base_price * ((Request::get('discount')) ? Request::get('discount') : $room->getAttributeTranslate('discount_room'))) / 100)}}</div>
                                            <div class="col-md-12 col-6 align-self-center">
                                                <h3 data-id={{ $r }} class="apart-total-price">{{$base_price - (($base_price * ((Request::get('discount')) ? Request::get('discount') : $room->getAttributeTranslate('discount_room')))  / 100)}} {{ trans('base.grn')}}</h3>
                                            </div>                                             
                                            <div class="col text-md-left text-center">
                                                <small class="apart-hotel">{{ trans('base.from_')}} <span class='date_from'></span> {{ trans('base.to') }} <span class='date_to'></span> <span class='quantity_days_search'></span></small>
                                            </div>
                                        </div> 
                                        <div data-attribute-id={{ $r }} id='discount' style='display:none'>{{ $room->getAttributeTranslate('discount_room')}}</div>
                                        <div class='room_id' style='display:none'>{{ $room->id }}</div>
                                    <div class='parent_id' style='display:none'>{{ $room->article_parent->id }}</div>
  
                                    </div> 
                                    <div class='days' style='display:none'>1</div>
                                    <input type="hidden" name='csrf-token' value="{{csrf_token()}}"/>


                                    <div class="col-md-4 col-6 px-1"><a href="{{ route('article_show', [setLangToRedirect(App::getLocale()), $categories_data['hotels']->getTranslate('url'), $room->article_parent->getAttributeTranslate('url'), $categories_data['rooms']->getTranslate('url'), $room->id])}}" class="btn btn-yellow-overline">{{ trans('base.more_')}}</a></div>
                                    <div class="col-md-4 col-6 px-1"><a data-toggle="modal" data-id= {{ $r }} data-target="#exampleModal" class="btn btn-yellow reserved">{{ trans('base.order')}}</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- APARTMENT CARD END -->
                <div></div>
                <?php $r++ ?>
            @endforeach
        </div>
    </div>

    <div class="container-fluid pb-5 back-f4f4f4">
        <div class="row text-center">
            <div class="col">
                <h2 class="section-header-huge pb-5">{{ trans('base.free_room')}}</h2>
            </div>
        </div>
        <div class="row justify-content-center no-gutters px-md-5 px-0 pb-3">
        <?php $i = 0 ?>
            @foreach((!$subdomain) ? $rooms->random(3) : $children_rooms->random(3) as $room)
                    <!-- Типова мала карточка номеру -->
                    <?php $base_price = $room->getPrice($room->id, $room->article_parent->id)['base_price'] ?>
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
                                @if(Request::get('discount') OR $room->getAttributeTranslate('discount_room'))
                                <div class="apart-small-card-buy d-flex flex-column justify-content-center">
                                    <p class="text-center apart-small-card-buy-hotel-p d-flex align-items-center justify-content-between">
                                        {{trans('base.from')}} 
                                        <span class="d-flex flex-column">
                                            <span class="old-price-hotel-card custom-line-throught">{{ $base_price}}</span>
                                                <strong>
                                                    {{$base_price - (($base_price * ((Request::get('discount')) ? Request::get('discount') : $room->getAttributeTranslate('discount_room'))) / 100)}}
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
                   
                    <?php $i++;
                        
                    ?>                  
            @endforeach                       

        </div>
    </div>

    <!-- callback -->
        @include('frontend.sections.callback')
    <!--  END callback -->
    <!-- modal window -->
        @include('frontend.sections.modal')
    <!--  END modal window -->
    <!-- modal end_reservation -->
    @include('frontend.sections.end_reservation')
    <!--  END modal end_reservation -->
@endsection