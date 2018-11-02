@if(isset($reviews) AND count($reviews) !== 0 AND $categories_data['reviews']->active == 1)

<div class="container-fluid pb-5 back-f4f4f4">
    <div class="row text-center">
        <div class="col">
            <h2 id="feedbackAnchor" class="section-header-huge">{{ $categories_data['reviews']->getTranslate('title')}}</h2>
            <div class="section-description">{!! $categories_data['reviews']->getTranslate('short_description') !!}</div>
            <div class="container-fluid position-relative">
                <div class="feedback-slider">
                    @foreach((!$subdomain) ? $main_reviews : $children_reviews->take(5) as $review)
                        <div class="d-flex justify-content-center">
                            <div class="card feedback-card">
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
                <a href="{{ route('article_category', [setLangToRedirect(App::getLocale()), $categories_data['reviews']->getTranslate('url')]) }}">{{ trans('base.all_reviews') }}</a>
                <a href="#" data-toggle="modal" data-target="#exampleModal2">{{ trans('base.add_review') }}</a>
            </div>
        </div>
    </div>
</div> 
    <!-- modal modal_review -->
        @include('frontend.sections.modal_review')
    <!--  END modal modal_review -->
@endif
