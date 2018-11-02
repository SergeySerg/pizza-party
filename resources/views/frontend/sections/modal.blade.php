<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content no-rounds">
                <div class="container-fluid px-0">
                    <button type="button" class="close-custom" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times times-gray"></i>
                    </button>
                    <div class="row justify-content-center my-4 px-4">
                        <div class="col text-center">
                            {{--<h5 class="section-header-huge pt-0 mb-0">
                                {{ trans('base.confirmation_reservation')}}
                            </h5>--}}
                            <h5 id='room' class="section-header-huge pt-0 mb-0">
                                @if(isset($article))
                                    {{ $article->getTranslate('title') }}
                                @endif    
                            </h5>
                        </div>
                    </div>
                    <div class="h-line-thin"></div>
                    <div class="row text-center">
                        <div class="col">                            
                            <h6 id='hotel' class="section-header-small mb-4 pt-4">
                                @if(isset($article))
                                    {{ $parent_hotel->getAttributeTranslate('type_build')}} {{ $parent_hotel->getTranslate('title')}}, {{ $parent_hotel->getAttributeTranslate('location')}}
                                @endif
                            </h6>
                        </div>
                    </div>
                    <div class="row px-md-5 px-4">
                        <div class="col-sm-7">
                            <p class="text-muted text-sm-left text-center"><i class="fa fa-male align-text-top text-orange"></i> {{-- х<span id='sum_guests'></span>: --}} <span id='adults_modal'></span> {{trans('base.adults')}} <span id='children_modal'></span></p>
                        </div>
                        <div class="col-sm-5 text-md-right text-center">
                            <p class="text-muted">{{ trans('base.from_')}}<i class="fas fa-calendar-alt align-text-top text-orange desktop-invisible"></i>  <span class='date_from'></span> {{ trans('base.to') }} <span class='date_to'></span> <i class="fas fa-calendar-alt align-text-top text-orange mobile-invisible"></i></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <h2 class="section-header-huge pb-4 pt-2"><span id='sum_price'></span> {{ trans('base.grn')}}</h2>
                        </div>
                    </div>
                    <div class="row text-center py-4 px-4 no-gutters back-f4f4f4">
                        <div class="col-md-6 my-1">
                            <div class="input-pattern">
                                <input type="text" required="true" name='name' placeholder="{{ trans('base.name') }}"/>
                            </div>
                        </div>
                        <div class="col-md-6 my-1">
                            <div class="input-pattern">
                                <input type="number"  name='phone' placeholder="{{ trans('base.phone') }}"/>
                            </div>
                        </div>
                        <div class="col my-1">
                            <div class="input-pattern">
                                <input type="email" required="true" name='email' placeholder="Email"/>
                            </div>
                        </div>
                    </div>
                    <div class="row  justify-content-center my-3">
                        <div class="col-md-6 col-10">
                            <button name='reserved' type="button" class="btn btn-yellow" data-dismiss="modal">{{ trans('base.reservation') }}</button>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name='lang' value="{{ App::getLocale() }}"/>
    <input type="hidden" name='csrf-token' value="{{csrf_token()}}"/>
