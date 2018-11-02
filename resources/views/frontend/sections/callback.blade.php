<div class="container-fluid px-1 back-747474" id="contactAnchor">
    <form id="callback" method="POST">
        <div class="row justify-content-center no-gutters py-md-4 py-1">
            <div class="col-xl-2 col-md-3 my-1">
                <div class="input-pattern">
                    <input type="text" required name="callback_name" placeholder="{{ trans('base.name') }}"/>
                </div>
            </div>
            <div class="col-xl-2 col-md-3 my-1">
                <div class="input-pattern">
                    <input type="number" required name="callback_phone" placeholder="{{ trans('base.phone') }}"/>
                </div>
            </div>
            <input type="hidden" name='lang' value="{{ App::getLocale() }}"/>
            <input type="hidden" name='type' value="Велика Ведмедиця"/>

            <input type="hidden" name='csrf-token' value="{{csrf_token()}}"/>

            <div class="col-xl-2 col-md-3 my-1">
                <div class="input-pattern" >
                    <input class="btn btn-yellow get-in-touch-btn" id="submit-callback" type="submit" value="{{ trans('base.contacts') }}">
                </div>
            </div>
        </div>
    </form>
</div>