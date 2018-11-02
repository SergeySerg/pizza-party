@extends('ws-app')

@section('content') 
<div class="main-slider-apart">
        <div class="slider-class-2">
            @foreach($article->getImages() as $room_img)

                <div class="fullscreen-img-2 d-flex justify-content-center" style="background-image:url('{{ asset( $room_img['full']) }}')">
                    <h5 class="apart-photo-title text-center">{{ $article->getAttributeTranslate('title_img')}}</h5>
                </div>
            @endforeach
        </div>
        <nav class="main-dots-2 d-flex justify-content-center"></nav>
        <div id="p-arrow">
            <div class="arrow-left main-arrow-left">
                <div></div>
                <div></div>
            </div>
        </div>
        <div id="n-arrow">
            <div class="arrow-right main-arrow-right">
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
   {{-- @if( Request::get('status'))
        <div class="container-fluid px-sm-5 pb-3">
            <div class="row py-4">
                <div class="col text-center">
                    <h3 class="section-header-huge pt-0" style="color: green">{{ trans('base.success_send_contact') }}</h3>
                </div>
            </div>
        </div>
    @endif
    --}}
    <div class="container-fluid px-sm-5 pb-3">
        <div class="row py-4">
            <div class="col text-center">
                <h3 class="section-header-huge pt-0">{{ $article->getTranslate('title') }}</h3>
                <small class="section-description">{{ $parent_hotel->getAttributeTranslate('type_build')}} {{ $parent_hotel->getTranslate('title')}}, {{ $parent_hotel->getAttributeTranslate('location')}}</small>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row pb-3 justify-content-center apart-features-row">
            @if($article->getAttributeTranslate('hair_dryer') == 1)
                <div class="col-md-1 col-4 pb-4">
                    <i class="bb-hair-dryer"></i><br>
                    <small>{{ trans('base.hair_dryer')}}</small>
                </div>
            @endif
            @if($article->getAttributeTranslate('wifi') == 1)
                <div class="col-md-1 col-4 pb-4">
                    <i class="bb-wifi-gray"></i><br>
                    <small>WIFI</small>
                </div>
            @endif
            @if($article->getAttributeTranslate('fireplace') == 1)
                <div class="col-md-1 col-4 pb-4">
                    <i class="bb-fireplace"></i><br>
                    <small>{{ trans('base.fireplace')}}</small>
                </div>
            @endif
            @if($article->getAttributeTranslate('kitchen') == 1)
                <div class="col-md-1 col-4 pb-4">
                    <i class="bb-kitchen"></i><br>
                    <small>{{ trans('base.kitchen')}}</small>
                </div>
            @endif
            @if($article->getAttributeTranslate('bathroom') == 1)
                <div class="col-md-1 col-4 pb-4">
                    <i class="bb-shower"></i><br>
                    <small>{{ trans('base.bathroom')}}</small>
                </div>
            @endif
            @if($article->getAttributeTranslate('fridge') == 1)        
                <div class="col-md-1 col-4 pb-4">
                    <i class="bb-refrigerator"></i><br>
                    <small>{{ trans('base.fridge')}}</small>
                </div>
            @endif
            @if($article->getAttributeTranslate('safe') == 1)
                <div class="col-md-1 col-4 pb-4">
                    <i class="bb-safe-box"></i><br>
                    <small>{{ trans('base.safe')}}</small>
                </div>
            @endif
            @if($article->getAttributeTranslate('kettle') == 1)
                <div class="col-md-1 col-4 pb-4">
                    <i class="bb-electric-kettle"></i><br>
                    <small>{{ trans('base.kettle')}}</small>
                </div>
            @endif
            
            @if($article->getAttributeTranslate('tv') == 1)
                <div class="col-md-1 col-4 pb-4">
                    <i class="bb-tv"></i><br>
                    <small>TV</small>
                </div>
            @endif
            @if($article->getAttributeTranslate('Jacuzzi') == 1)
                <div class="col-md-1 col-4 pb-4">
                    <i class="bb-jacuzzi"></i><br>
                    <small>{{ trans('base.Jacuzzi')}}</small>
                </div>
            @endif
        </div>
    </div>
    
    <div class="container-fluid px-md-5 px-3">
        <div class="full-width-line"></div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <h4 class="apart-page-section-header mb-3 mobile-text-center">{{ trans('base.free_services') }}</h4>
                <div id="justify" class="row text-orange text-center no-gutters d-flex">
                
                    @if($article->getAttributeTranslate('breakfast') == 1)
                        <i class="fa fa-plus mt-3"></i>
                        <div class="col-md-2 col-4">
                            <i class="bb-breakfast fa-3x mobile-text-center"></i><br>
                            <small class="mobile-text-center">{{ trans('base.breakfast')}}</small>
                        </div>
                    @endif
                    @if($article->getAttributeTranslate('parking') == 1)
                        <i class="fa fa-plus mt-3"></i>
                        <div class="col-md-2 col-4">
                            <i class="bb-parking fa-3x mobile-text-center"></i><br>
                            <small class="mobile-text-center">{{ trans('base.parking')}}</small>
                        </div>
                    @endif 
                    @if($article->getAttributeTranslate('coffe') == 1)
                        <i class="fa fa-plus mt-3"></i>
                        <div class="col-md-2 col-4">
                            <i class="bb-teapot fa-3x mobile-text-center"></i><br>
                            <small class="mobile-text-center">{{ trans('base.coffe')}}</small>
                        </div>
                    @endif 
                    @if($article->getAttributeTranslate('сhildren_room') == 1)
                        <i class="fa fa-plus mt-3"></i>
                        <div class="col-md-2 col-4">
                            <i class="bb-toy-bold fa-3x mobile-text-center"></i><br>
                            <small class="mobile-text-center">{{ trans('base.сhildren_room')}}</small>
                        </div>
                    @endif 
                    @if($article->getAttributeTranslate('ski_storage_room') == 1)
                        <i class="fa fa-plus mt-3"></i>
                        <div class="col-md-2 col-4">
                            <i class="bb-ski-staff fa-3x mobile-text-center"></i><br>
                            <small class="mobile-text-center">{{ trans('base.ski_storage_room')}}</small>
                        </div>
                    @endif 
                    @if($article->getAttributeTranslate('bowl_ski_equipment') == 1)
                        <i class="fa fa-plus mt-3"></i>
                        <div class="col-md-2 col-4">
                            <i class="bb-ski-dryer fa-3x mobile-text-center"></i><br>
                            <small class="mobile-text-center">{{ trans('base.bowl_ski_equipment')}}</small>
                        </div>
                    @endif 
                    @if($article->getAttributeTranslate('wifi') == 1)
                        <i class="fa fa-plus mt-3"></i>
                        <div class="col-md-2 col-4">
                            <i class="bb-wifi-orange fa-3x mobile-text-center"></i><br>
                            <small class="mobile-text-center">WIFI</small>
                        </div>
                    @endif    
                </div>
                <h4 class="apart-page-section-header mt-4">{{ trans('base.description')}}</h4>
                <div class="apart-page-sect-desc text-equal-spacing">{!! $article->getTranslate('description') !!}</div>
                <h4 class="apart-page-section-header mt-4 mobile-text-center">{{ trans('base.complactation')}}</h4>
                <div class="row small-features mb-5">
                    {!! $article->getAttributeTranslate('equipment_room')!!}
                </div>
            </div>
            {{--//TODO:order--}}
            <div class="col-md-4 text-md-right text-center">
                <small id="people_max">{{ trans('base.price_for')}} <i class="fa fa-male align-text-top text-orange"></i> х <span id='base_guests'>{{ $article->getAttributeTranslate('base_count_ guests') }}</span>, {{ trans('base.max_count_guests')}} <i class="fa fa-male align-text-top text-orange"></i> х<span id='max_guests'>{{ $article->getAttributeTranslate('max_count_guests') }}</span></small>
                <div class="order-card mt-4">
                    <div class="d-flex justify-content-center margin-left-15">
                        <div class="apart-price-discount back-707070">
                        @if($article->getAttributeTranslate('discount_room'))
                            <p class="d-flex align-items-center justify-content-around flex-xl-row flex-md-column color-white py-xl-0 py-md-3 px-xl-3">
                                <span class="new-price-apart">
                                    <span data-class= 'base_price' class="custom-line-throught">
                                        {{ $base_price}}
                                    </span>
                                    <br>
                                    <span class="apart-price-additional-text">
                                        {{ trans('base.grn')}} {{ trans('base.price_night')}}
                                    </span>
                                </span>
                                <span data-class='discount_price' class='price'>
                                    {{$base_price - (($base_price * $article->getAttributeTranslate('discount_room')) / 100)}}
                               </span>                            
                            </p>
                        @else
                            <p class="d-flex align-items-center justify-content-around flex-xl-row flex-md-column color-white py-xl-0 py-md-3 px-xl-3">
                               <span data-class='discount_price' class='price'>
                                    {{$base_price - (($base_price * $article->getAttributeTranslate('discount_room')) / 100)}}
                               </span>
                               <br>
                               <span class="apart-price-additional-text">
                                    {{ trans('base.grn')}} {{ trans('base.price_night')}}
                                </span>  
                            </p>
                        @endif
                        </div>
                        {{--for math price--}}
                            <div id='surcharge' style='display:none'>{{ $surchange }}</div>
                            <div id='surcharge_children' style='display:none'>{{ $surchange_children }}</div>
                            <div id='discount' style='display:none'>{{ $article->getAttributeTranslate('discount_room')}}</div>
                            <div id='room_id' style='display:none'>{{ $article->id }}</div>
                            <div id='parent_id' style='display:none'>{{ $article->article_parent->id }}</div>
                            <div class='days' style='display:none'>1</div>
                            <div class='result_price' style='display:none'>{{$base_price - (($base_price * $article->getAttributeTranslate('discount_room')) / 100)}}</div>

                        {{--/for math price--}}
                        <div class="apart-price back-white d-flex flex-column">
                            <p class="color-black pt-2 mt-auto">{{$base_price - (($base_price * $article->getAttributeTranslate('discount_room')) / 100)}}</p>
                            <p class="pt-0 mb-auto"><span class='quantity_days' class=".color-opacity-5 align-text-top apart-price-additional-text">{{ trans('base.grn')}} {{ trans('base.pear')}} 1 {{ trans('base.one_night')}}</span></p>
                        </div>
                    </div>
                    <div id="div-datepicker" class="input-pattern mt-1">
                        <i class="fas fa-calendar-alt order-form-icon"></i>
                        <input type='text' data-language="{{ App::getLocale()}}" data-multiple-dates-separator=" - " class="datepicker-here cursor-pointer pl-2" id="datepicker" placeholder="Дати" readonly="readonly"/>
                    </div>
                    <div class="input-pattern d-flex justify-content-between mt-3">
                        <p id="guests" class="input-text float-left">{{ trans('base.count_guestі')}}</p>
                        <i class="fas fa-male order-form-icon"></i>
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
                    @if($article->getAttributeTranslate('marketing'))
                        <div class="apart-left mt-3">
                            <p class="text-uppercase">{{ $article->getAttributeTranslate('marketing') }}</p>
                        </div>
                    @endif
                    <div class="apart-buy mt-3">
                        <a class="btn btn-yellow text-uppercase" data-toggle="modal" data-target="#exampleModal">{{ trans('base.reservation')}}</a>
                    </div>
                </div>                   
            </div>
        </div>
        <div class="row px-xl-5 px-3 mb-4 mt-5">
            @foreach($rules as $rule)
                <div class="col-lg-2 col-md-4 mb-4">
                    {!! $rule->getAttributeTranslate('icon') !!}
                    <h5 class="rules-header ">{{ $rule->getTranslate('title') }}</h5>
                    <div class="apart-page-sect-desc pl-4">{!! $rule->getTranslate('short_description') !!}</div>
                </div>
            @endforeach
        </div>
    </div>
    
    <div id="feedbackAnchor" class="container-fluid">
        <div class="row text-center px-md-5">
            <div class="col">
                <h2 class="section-header-huge pt-4">{{ $categories_data['reviews']->getTranslate('title')}}</h2>
                <div class="section-description">{!! $categories_data['reviews']->getTranslate('short_description') !!}</div>
            </div>
        </div>
        <div class="container-fluid px-xl-5">
            <div class="container-fluid line-1-ff8c00"></div>
            <div class="row px-xl-5 my-5">
                <div class="col-xl-3 d-flex align-items-center justify-content-center">
                    <p class="section-text-huge ipad-text-center">{{ $children_reviews->total() }} {{trans_choice('base.review', (!$subdomain) ? $reviews->total() : $children_reviews->total()) }} <br/>
                    @if($children_reviews_raty !== 0)
                        @for ($i = 0; $i < $children_reviews_raty; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                        @for ($i = 0; $i < 5 - $children_reviews_raty; $i++)
                            <i class="far fa-star"></i>
                        @endfor
                    @endif
                    </p>
                </div>
                <div class="col-xl px-xl-5">
                    @if($revsettings->first()->getAttributeTranslate('is_cleanness'))
                        <div class="row">
                            <div class="col d-flex justify-content-xl-around">
                                <p class="section-text-small mx-xl-0 mr-auto">{{ trans('base.cleanness')}}</p>
                                <div class="div-stars">                                    
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($revsettings->first()->getAttributeTranslate('is_сosiness'))
                        <div class="row">
                            <div class="col d-flex justify-content-xl-around">
                                <p class="section-text-small mx-xl-0 mr-auto">{{ trans('base.сosiness')}}</p>
                                <div class="div-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-xl px-xl-5">
                    @if($revsettings->first()->getAttributeTranslate('is_location'))
                        <div class="row">
                            <div class="col d-flex justify-content-xl-around">
                                <p class="section-text-small mx-xl-0 mr-auto">{{ trans('base.location')}}</p>
                                <div class="div-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($revsettings->first()->getAttributeTranslate('is_food'))
                        <div class="row">
                            <div class="col d-flex justify-content-xl-around">
                                <p class="section-text-small mx-xl-0 mr-auto">{{ trans('base.food')}}</p>
                                <div class="div-stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>                
            </div>
            <div class="container-fluid line-1-ff8c00"></div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container-fluid position-relative">
        <div class="feedback-slider">
                    @foreach($children_reviews->take(5) as $review)
                        <div class="d-flex justify-content-center">
                            <div id="test" class="card feedback-card">
                                <div class="card-body">
                                    <p>
                                        {!! str_limit($review->getAttributeTranslate('review'), 400) !!}
                                        @if(strlen($review->getAttributeTranslate('review')) > 400)                                            
                                            <a href="#" class="color-ff8c00">{{ trans('base.more_detale') }}</a>
                                        @endif 
                                    </p>   
                                    </div>
                                    <div class="card-footer">
                                        @if($review->getAttributeTranslate('source'))
                                            <i class="fab fa-{{lcfirst($review->getAttributeTranslate('source'))}}-square"></i>
                                            <p class="name">{{ $review->getAttributeTranslate('name') }}
                                                <small class="text-muted">({{ trans('base.review_from') }} {{ $review->getAttributeTranslate('source') }})</small>
                                            </p>
                                        @else
                                            <p class="name">{{ $review->getAttributeTranslate('name') }}</p>
                                        @endif
                                        <p class="date">{{ $review->getAttributeTranslate('date_create_review') }}</p>
                                    </div>
                                    @if($review->getAttributeTranslate('profile_foto') )
                                        <div id="profile-huge" class="profile-image" style="background: url('{{ asset( $review->getAttributeTranslate('profile_foto')) }}')"></div>
                                    @else
                                        <div id="profile-huge" class="profile-image" style="background: url('{{ asset('img/frontend/profile.jpg') }}')" ></div>
                                    @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            <div id="feedback-arrow-left">
                <div class="div-arrows div-a-f">
                    <div class="arrow-left f-arrow-left">
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <div id="feedback-arrow-right">
                <div class="div-arrows div-a-f">
                    <div class="arrow-right f-arrow-right">
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="feedback-button">
            <a href="#">{{ trans('base.all_reviews') }}</a>
            <a href="#" data-toggle="modal" data-target="#exampleModal2">{{ trans('base.add_review') }}</a>
        </div>
    </div>
    
    <div class="container-fluid pb-5 back-f4f4f4">
        <div class="row text-center">
            <div class="col">
                <h2 class="section-header-huge pb-5">{{ trans('base.same_room') }}</h2>
            </div>
        </div>
        <div class="row justify-content-center no-gutters px-md-5 px-0">
        <?php $i = 0 ?>
            @foreach($children_rooms->take(3) as $key => $room)
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
                                            <span class="old-price-hotel-card custom-line-throught">{{ $base_price }}</span>
                                                <strong>
                                                    {{$base_price  - (($base_price  * $room->getAttributeTranslate('discount_room')) / 100)}}
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
    <div class="container-fluid p-0 back-0f0f0f">
        <div class="row no-gutters">
            <div class="col">
                <iframe src="{{ $parent_hotel->getAttributeTranslate('map') }}" width="100%" height="400" frameborder="0" class="border-0" allowfullscreen></iframe>
            </div>
        </div>
    </div> 
   
    <!-- callback -->
        @include('frontend.sections.callback')
    <!--  END callback -->
    <!-- modal window -->
        @include('frontend.sections.modal')
    <!--  END modal window -->
    <!-- modal modal_review -->
        @include('frontend.sections.modal_review')
    <!--  END modal modal_review -->
    <!-- modal end_reservation -->
        @include('frontend.sections.end_reservation')
    <!--  END modal end_reservation -->
      
      
    
@endsection