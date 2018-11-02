@extends('ws-app')

@section('content')

    <div id="main-view">
        <div class="fourthscreen-img d-flex align-items-center justify-content-center" style="background-image: url('{{ asset ($search->first()->getAttributeTranslate('img_search'))}}');">
            <h1 class="pt-5 mt-5 text-uppercase header-feedback-font">{!! $revsettings->first()->getTranslate('short_description') !!}</h1>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="container-fluid px-xl-5">
            <div class="row px-xl-5 my-5">
                <div class="col-xl-3 d-flex align-items-center justify-content-center">
                    <p class="section-text-huge ipad-text-center">{{ (!$subdomain) ? $reviews->total() : $children_reviews->total()}} {{trans_choice('base.review', (!$subdomain) ? $reviews->total() : $children_reviews->total()) }}<br/>
                    @if(!$subdomain)
                        @if($reviews_raty !== 0)
                            @for ($i = 0; $i < $reviews_raty; $i++)
                                <i class="fas fa-star color-ff8c00 font-12"></i>
                            @endfor
                            @for ($i = 0; $i < 5 - $reviews_raty; $i++)
                                <i class="far fa-star color-ff8c00 font-12"></i>
                            @endfor
                        @endif
                    @else
                        @if($children_reviews_raty !== 0)
                            @for ($i = 0; $i < $children_reviews_raty; $i++)
                                <i class="fas fa-star color-ff8c00 font-12"></i>
                            @endfor
                            @for ($i = 0; $i < 5 - $children_reviews_raty; $i++)
                                <i class="far fa-star color-ff8c00 font-12"></i>
                            @endfor
                        @endif
                    @endif
                    </p>
                </div>
                <div class="col-xl px-xl-5">
                    @if($revsettings->first()->getAttributeTranslate('is_cleanness'))
                        <div class="row">
                            <div class="col d-flex justify-content-xl-between px-xl-2">
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
                            <div class="col d-flex justify-content-xl-between px-xl-2">
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
                            <div class="col d-flex justify-content-xl-between px-xl-2">
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
                            <div class="col d-flex justify-content-xl-between px-xl-2">
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
        <div class="col-xl-2 col-md-4 my-5 mx-auto">
            <div class="input-pattern">
                <a class="btn btn-yellow get-in-touch-btn text-uppercase" data-toggle="modal" data-target="#exampleModal2">{{ trans('base.add_review') }}</a>
            </div>
        </div>
        <div class="container pb-4">        
            <?php $q = 0 ?>
            
            @foreach((!$subdomain) ? $reviews : $children_reviews as $review)

                <div class="d-flex flex-column py-3">
                    <div class="d-flex justify-content-center pb-3">
                        <div class="card feedback-card my-0">
                            <div class="card-body pb-1">
                                <p>
                                {!! $review->getAttributeTranslate('review') !!}
                                {{-- {!! str_limit($review->getAttributeTranslate('review'), 400) !!}
                                    @if(strlen($review->getAttributeTranslate('review')) > 400)                                            
                                        <a href="#" class="color-ff8c00">{{ trans('base.more_detale') }}</a>
                                    @endif --}}
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="order-lg-1 col-lg-6 col-12 d-flex flex-column justify-content-end">
                                        {{--<div>
                                            <p class="text-lg-right m-0 font-12 font-10">Дата проживання:<span class="d-lg-inline d-none"><br/></span> 20.02.2018 - 25.02.2018</p>
                                        </div>--}}
                                        <div class="align-self-lg-end align-self-center">
                                            <!-- calc raty -->
                                                @include('frontend.sections.calc')                                            
                                            <!--  calc raty -->                                      
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 d-flex align-items-end p-0">
                                        <div class="d-flex align-items-center container-fluid pr-1">
                                            <i class="fab fa-facebook-square m-0"></i>
                                            <p class="name px-1 m-0">{{ $review->getAttributeTranslate('name') }}</p>
                                            <p class="date px-1 m-0 mt-1 ml-lg-0 ml-auto">{{ $review->getAttributeTranslate('date_create_review') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($review->getAttributeTranslate('profile_foto'))
                                <div id="profile-huge" class="profile-image" style="background: url('{{ asset( $review->getAttributeTranslate('profile_foto')) }}')"></div>
                            @else
                                <div id="profile-huge" class="profile-image" style="background: url('{{ asset('img/frontend/profile.jpg') }}')" ></div>
                            @endif
                        </div>
                    </div>
                        @if($review->getAttributeTranslate('answer_reviews'))
                        <div class="d-flex justify-content-center">
                            <div class="card feedback-card px-0 my-0 width-not-full margin-left-166px margin-top-0">
                                <div class="card-body pb-1">                                    
                                    {!! $review->getAttributeTranslate('answer_reviews') !!}                                    
                                </div>
                                <div class="card-footer pt-3">
                                    <p class="name bigbear-name-font m-sm-0 mb-0 mt-1">{{ $texts->get('admin_name') }}</p>
                                    <p class="date">{{ $review->getAttributeTranslate('date_answer_reviews') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>        
            @endforeach   
            {{ (!$subdomain) ? $reviews->render() : $children_reviews->render()}} 
            
            <?php $q++ ?> 
            {{-- Ссилка на всі відгуки<div class="container d-flex justify-content-center my-3">
                    <a class="feedback-button-a" id='more_reviews' data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Всі відгуки</a>
                </div>
            
                <div class="collapse сontainer-fluid" id="collapseExample">
                
            </div>--}}
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

    <!-- callback -->
        @include('frontend.sections.callback')
    <!--  END callback -->
    <!-- modal modal_review -->
        @include('frontend.sections.modal_review')
    <!--  END modal modal_review -->
    
@endsection