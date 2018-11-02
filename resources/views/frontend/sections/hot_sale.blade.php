<div id="freedates-bar">
        <div id="close-button-container" >
            <button type="button" id="close-button" onclick="hideFreedatesBar()">&times;</button>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-lg-right text-center align-self-center">
                    <h2 class="mb-lg-0 freedates-bar-text">{{ $texts->get('hot_sale_1') }}</h2>
                </div>
                <div class="col-lg-2 col-6 px-1 order-hotsale">
                    <a href="{{ route('article_category', [setLangToRedirect(App::getLocale()), $categories_data['discounts']->getTranslate('url')]) }}" class="btn btn-yellow">{{ trans('base.order')}}</a>
                </div>
                <div class="col-lg-5 text-lg-left text-center align-self-center">
                    <h2 class="mb-0 mt-lg-0 mt-2 freedates-bar-text">{{ $texts->get('hot_sale_2') }}</h2>
                </div>
            </div>
        </div>
    </div>