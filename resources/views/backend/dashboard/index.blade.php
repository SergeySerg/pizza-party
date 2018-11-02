@extends('adminpanel')


@section('breadcrumbs')

    <li class="active">
        <i class="icon-home home-icon"></i>
        {{ trans('backend.main') }}
    </li>
@stop

@section('content')
<div class="page-content">
    <div class="row-fluid">
        <div class="span12">
            <!--PAGE CONTENT BEGINS-->
            <div class="row-fluid">
                <h3 class="header smaller lighter blue">{{ trans('backend.panel') }}</h3>
                <div class="row-fluid">
                    <div class="span12 well">
                        {{ trans('backend.welcome_to_adminpanel') }} <strong style="text-transform: uppercase">{{$_SERVER['HTTP_HOST']}} !</strong>
                    </div>
                </div>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="icon-remove"></i>
                    </button>
                    <strong>{{ trans('backend.attention') }}!</strong>
                    {{ trans('backend.section') }}
                    <br>
{{--
                    {{ trans('backend.template') }} <a href='{{ asset("upload/instructions/instrukcia-sait.doc") }}' download>{{ trans('backend.instruction') }} <i class="icon-book"></i> </a>
--}}
                </div>
            </div>
        </div><!--/.span-->
    </div><!--/.row-fluid-->
</div>


@stop