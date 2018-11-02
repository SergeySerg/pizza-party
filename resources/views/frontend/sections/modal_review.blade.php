<!-- Модальне вікно відгуку -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id='add_review'>
            <div class="modal-dialog" role="document">
                <div class="modal-content no-rounds">
                    <div class="container-fluid px-0">
                        <button type="button" class="close-custom" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="row justify-content-center my-4 px-4">
                            <div class="col text-center">
                                <h5 class="section-header-huge pt-0 mb-0">{{ trans('base.add_review_rest')}}!</h5>
                            </div>
                        </div>
                        <div class="row text-center py-4 px-4 no-gutters back-f4f4f4">
                            <!-- <div class="col-md-6 my-1">
                                <div class="input-pattern">
                                    <input type="text" placeholder="Прізвище"/>
                                </div>
                            </div> -->
                            <div class="col-md-6 my-1">
                                <div class="input-pattern">
                                    <input type="text" name='name' placeholder="{{ trans('base.name')}}"/>
                                </div>
                            </div>
                            <div class="col-md-6 my-1">
                                <div class="input-pattern">
                                    <input disabled id="location" data type="text"  name="location" placeholder="{{ trans('base.hotel_city') }}" readonly="readonly" class="cursor-pointer"/>
                                    <div id="input-drop-location" class="input-dropdown px-2">
                                        @foreach($hotels as $hotel)
                                            <p data-id="{{ $hotel->id }} " class="input-location d-flex align-items-center text-left"><span>{{ $hotel->getTranslate('title')}}<br/><sub> ({{ $hotel->getAttributeTranslate('location') }})</sub></span></p>
                                        @endForeach
                                    </div>
                                </div>
                        </div>
                        </div>
                        <div class="row my-2">
                            <div class="col px-5">
                                @if($revsettings->first()->getAttributeTranslate('is_cleanness'))
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="section-text-small m-0 pt-2">{{ trans('base.cleanness')}}</p>
                                        <div class="raty pt-2 color-ff8c00" data-scorename="cleanness"></div>
                                    </div>
                                @endif
                                @if($revsettings->first()->getAttributeTranslate('is_сosiness'))    
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="section-text-small m-0 pt-2">{{ trans('base.сosiness')}}</p>
                                        <div class="raty pt-2 color-ff8c00" data-scorename="сosiness"></div>

                                    </div>
                                @endif 
                                @if($revsettings->first()->getAttributeTranslate('is_location'))
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="section-text-small m-0 pt-2">{{ trans('base.location')}}</p>
                                        <div class="raty pt-2 color-ff8c00" data-scorename="location"></div>

                                    </div>
                                @endif 
                                @if($revsettings->first()->getAttributeTranslate('is_food'))
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="section-text-small m-0 pt-2">{{ trans('base.food')}}</p>
                                        <div class="raty pt-2 color-ff8c00" data-scorename="food"></div>
                                    </div>
                                @endif
                                @if($revsettings->first()->getAttributeTranslate('is_wifi'))
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="section-text-small m-0 pt-2">WIFI</p>
                                        <div class="raty pt-2 color-ff8c00" data-scorename="wifi"></div>
                                    </div>
                                @endif
                                @if($revsettings->first()->getAttributeTranslate('is_price_quality'))
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="section-text-small m-0 pt-2">{{ trans('base.price_quality')}}</p>
                                        <div class="raty pt-2 color-ff8c00" data-scorename="price_quality"></div>

                                    </div>
                                @endif
                                @if($revsettings->first()->getAttributeTranslate('is_family_hotel'))
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="section-text-small m-0 pt-2">{{ trans('base.family_hotel')}}</p>
                                        <div class="raty pt-2 color-ff8c00" data-scorename="family_hotel"></div>

                                    </div>
                                @endif
                                @if($revsettings->first()->getAttributeTranslate('is_rest_children'))
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="section-text-small m-0 pt-2">{{ trans('base.rest_children')}}</p>
                                        <div class="raty pt-2 color-ff8c00" data-scorename="rest_children"></div>

                                    </div>
                                @endif
                                @if($revsettings->first()->getAttributeTranslate('is_young'))
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="section-text-small m-0 pt-2">{{ trans('base.young')}}</p>
                                        <div class="raty pt-2 color-ff8c00" data-scorename="young"></div>
                                    </div>
                                @endif
                                @if($revsettings->first()->getAttributeTranslate('is_polite'))
                                    <div class="d-flex justify-content-between mb-2">
                                        <p class="section-text-small m-0 pt-2">{{ trans('base.polite')}}</p>
                                        <div class="raty pt-2 color-ff8c00" data-scorename="polite"></div>

                                    </div>
                                @endif
                            </div>
                        </div>                    
                        <div class="row text-center py-4 px-4 no-gutters back-f4f4f4">
                            <div class="col my-1">
                                <textarea rows="3" name='review' placeholder="{{ trans('base.impresion_description')}}" class="impression-input" wrap="soft"></textarea>
                            </div>
                        </div>
                        <input type='hidden' name='article_id' value=''/>
                        <div class="row  justify-content-center my-3">
                            <div class="col-md-6 col-10">
                                <button type="button" id='send_review' class="btn btn-yellow" data-dismiss="modal">{{ trans('base.send_review')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>