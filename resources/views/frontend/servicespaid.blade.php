@extends('ws-app')

@section('content')
<div id="main-view">
        <div class="fourthscreen-img d-flex align-items-center justify-content-center" style="background-image: url('{{ asset ($search->first()->getAttributeTranslate('img_search'))}}');">
            <h1 class="pt-5 mt-5 text-uppercase">{{ trans('base.hotel_services')}}<br>{{ $parent_hotel->getTranslate('title')}}</h1>
        </div>
    </div>
   
     <!-- mobile_messenger -->
     @include('frontend.sections.mobile_messengers')
    <!-- END mobile_messenger --> 
    
    <div class="container-fluid px-sm-5">
        <div class="row text-center">
            <div class="col">
                <h2 class="section-header-huge text-uppercase">{{ trans('base.hotel_services')}}</h2>
                <p class="section-description pb-1">{{ trans('base.pay_services')}}</p>
                <div class="description-underline mb-4"></div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="row justify-content-center no-gutters px-md-5 px-0 pb-3">
            @foreach($children_servicespaid->forPage(1, 6) as $servicepaid )
                <div class="col-xl-4 col-lg-6 p-2 mt-3">
                    <div class="service-card shadow-hover">
                        @if( $servicepaid->getAttributeTranslate('price'))
                            <div class="apart-small-card-buy d-flex flex-column justify-content-center">
                                <p class="text-center apart-small-card-buy-hotel-p d-flex align-items-center justify-content-between">{{ trans('base.from')}} <strong>{{ $servicepaid->getAttributeTranslate('price')}}</strong> {{ trans('base.grn')}}</p>
                            </div>
                        @endif
                        <div class="service-image" style="background-image: url('{{ asset ($servicepaid->getAttributeTranslate('img_pay_service'))}}');"></div>
                        <div class="px-4">
                            <div class="pt-3 pb-1">
                                <h5 class="small-service-header m-0">{{ $servicepaid->getTranslate('title')}}</h5>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="location-text">{!! $servicepaid->getTranslate('short_description') !!}</div>
                                </div>
                                <div class="col-5 text-right">
                                    <a href="{{ $servicepaid->getAttributeTranslate('link_video')}}" target="_blank" class="no-underline">
                                        @if($servicepaid->getAttributeTranslate('link_video'))
                                            <small class="small-card-hotel">{{ trans('base.show_video')}}</small>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            @endforeach
        </div>
        @if(count($children_servicespaid) > 6)
            <div class="row text-center">
                <div class="col mt-4 mb-5">
                    <a class="more-button" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">{{ trans('base.show_more')}}</a>
                </div> 
            </div>
        @endif
        <div class="collapse" id="collapseExample">
            <div class="row justify-content-center no-gutters px-md-5 px-0 pb-3">
            @foreach($children_servicespaid->forPage(2, 6) as $servicepaid )
                <div class="col-xl-4 col-lg-6 p-2 mt-3">
                    <div class="service-card shadow-hover">
                        @if( $servicepaid->getAttributeTranslate('price'))
                            <div class="apart-small-card-buy d-flex flex-column justify-content-center">
                                <p class="text-center apart-small-card-buy-hotel-p d-flex align-items-center justify-content-between">{{ trans('base.from')}} <strong>{{ $servicepaid->getAttributeTranslate('price')}}</strong> {{ trans('base.grn')}}</p>
                            </div>
                        @endif
                        <div class="service-image" style="background-image: url('{{ asset ($servicepaid->getAttributeTranslate('img_pay_service'))}}');"></div>
                        <div class="px-4">
                            <div class="pt-3 pb-1">
                                <h5 class="small-service-header m-0">{{ $servicepaid->getTranslate('title')}}</h5>
                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <div class="location-text">{!! $servicepaid->getTranslate('short_description') !!}</div>
                                </div>
                                <div class="col-5 text-right">
                                    <a href="{{ $servicepaid->getAttributeTranslate('link_video')}}" target="_blank" class="no-underline">
                                        @if($servicepaid->getAttributeTranslate('link_video'))
                                            <small class="small-card-hotel">{{ trans('base.show_video')}}</small>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            @endforeach
            </div>
        </div>
    </div>

   <div class="container-fluid">
        <div class="row text-center">
            <div class="col">
                <h2 class="section-header-huge text-uppercase">{{ trans('base.hotel_services')}}</h2>
                <p class="section-description pb-1">{{ trans('base.free_services')}}</p>
                <div class="description-underline mb-4"></div>
            </div>
        </div>
        <div class="row text-center align-items-center justify-content-center no-gutters px-md-5 px-0 pb-5">
        <?php $k = 0 ?>
            @foreach($children_servicesfree->take(8) as $service)
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
   
    <div class="container">
        <div class="row text-center">
            <div class="col">
                <h2 class="section-header-huge text-uppercase">{{ trans('base.room_services')}}</h2>
                <p class="section-description pb-1">{{ trans('base.free_services')}}</p>
                <div class="description-underline mb-4"></div>
            </div>
        </div>
        <div class="row justify-content-center text-center text-md-left mb-5">
            <div class="col-lg-5 col-md-6"><h4 class="all-features"><i class="fas fa-check text-orange mr-3"></i> {{ trans('base.hair_dryer')}}</h4></div>
            <div class="col-lg-5 col-md-6"><h4 class="all-features"><i class="fas fa-check text-orange mr-3"></i> WIFI</h4></div>
            <div class="col-lg-5 col-md-6"><h4 class="all-features"><i class="fas fa-check text-orange mr-3"></i> {{ trans('base.fireplace')}}</h4></div>
            <div class="col-lg-5 col-md-6"><h4 class="all-features"><i class="fas fa-check text-orange mr-3"></i> {{ trans('base.kitchen')}}</h4></div>
            <div class="col-lg-5 col-md-6"><h4 class="all-features"><i class="fas fa-check text-orange mr-3"></i> {{ trans('base.bathroom')}}</h4></div>
            <div class="col-lg-5 col-md-6"><h4 class="all-features"><i class="fas fa-check text-orange mr-3"></i> {{ trans('base.fridge')}}</h4></div>
            <div class="col-lg-5 col-md-6"><h4 class="all-features"><i class="fas fa-check text-orange mr-3"></i> {{ trans('base.safe')}}</h4></div>
            <div class="col-lg-5 col-md-6"><h4 class="all-features"><i class="fas fa-check text-orange mr-3"></i> {{ trans('base.kettle')}}</h4></div>
            <div class="col-lg-5 col-md-6"><h4 class="all-features"><i class="fas fa-check text-orange mr-3"></i> TV</h4></div>
            <div class="col-lg-5 col-md-6"><h4 class="all-features"><i class="fas fa-check text-orange mr-3"></i> {{ trans('base.Jacuzzi')}}</h4></div>
        </div>
    </div>
   
    <div class="container-fluid px-1 back-747474">
        <!-- form for find -->
            @include('frontend.sections.form_find')
        <!-- END form for find -->
    </div>
@endsection