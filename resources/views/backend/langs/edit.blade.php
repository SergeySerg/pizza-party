@extends('adminpanel')

@section('breadcrumbs')
    <li>
        <i class="icon-home home-icon"></i>
        <a href="{{ route('admin_dashboard') }}">{{ trans('backend.main') }}</a>
        <span class="divider">
            <i class="icon-angle-right arrow-icon"></i>
        </span>
    </li>

    <li>
        <a href="{{ route('langs_index') }}">{{ trans('backend.langs') }}</a>

        <span class="divider">
            <i class="icon-angle-right arrow-icon"></i>
        </span>
    </li>
    @if(isset($lang))
        <li class="active">{{ $lang->id }}</li>
    @else
        <li class="active">Добавить новую cтрану</li>
    @endif
@stop

@section('content')

    <div class="page-content">
        <div class="page-header position-relative">
            <h1>
                @if(isset($lang))
                    {{ trans('backend.edit') }}
                @else
                    Добавить новую cтрану
                @endif
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <form class="form-horizontal" id="resource-form" method="POST" action="" />

                <div class="control-group">
                    <label class="control-label" for="title">Название</label>

                    <div class="controls">
                        <input type="text" name="country" value='{{ $lang -> country or '' }}' placeholder="Название страны" />
                    </div>
                </div>                

                <div class="control-group">
                    <label class="control-label" for="priority">Обозначение</label>

                    <div class="controls">
                        <input type="text" name="lang" value='{{ $lang -> lang or '' }}' placeholder="Обозначение типа ru,en,ua" />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="form-field-2">{{ trans('backend.priority') }}</label>

                    <div class="controls">
                        <input type="number" id="form-field-2" name="priority" value='{{ $lang -> priority or '' }}' />
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="id-date-picker-1">{{ trans('backend.img') }}</label>
                    {{--<div class="controls">
                        <div class="row-fluid input-append">
                            <input class="span2 date-picker" name="date" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" @if(isset($admin_article)) value='{{date('d-m-Y',strtotime($admin_article->date)) }}' @endif/>
                            <span class="add-on">
                                <i class="icon-calendar"></i>
                           </span>
                        </div>
                    </div>--}}
                    @if(isset($lang) && $lang->img)
                        {{--
                                                            <label class="control-label">Картинка категорії</label>
                        --}}
                        <div class="controls show-image" >
                            <div class="row-fluid">
                                <div class="span3">
                                    <div class="profile-activity clearfix" style="border-bottom: none">
                                        <div>
                                            <img class="pull-left" alt="{{ $lang->lang }}" style="max-width:200px;border-radius:0%" src="{{ asset($lang->img) }}">
                                        </div>

                                        <div class="tools action-buttons">
                                            <a href="#" class="blue">
                                                <i class="icon-pencil bigger-125 image-edit"></i>
                                            </a>

                                            <a href="#" class="red">
                                                <i class="icon-remove bigger-125 image-close"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="controls image-upload" style="display:none">
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="widget-box">
                                        <div class="widget-header">
                                            <h4>{{ trans('backend.img') }}</h4>
                                        <span class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                <i class="icon-chevron-up"></i>
                                            </a>
                                            {{-- <a href="#" data-action="close">
                                                 <i class="icon-remove"></i>
                                             </a>--}}
                                        </span>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                {{--
                                                 <div class="ace-file-input"><input type="file" name="img" id="id-input-file-2"><label data-title="Choose"><span data-title="No File ..."><i class="icon-upload-alt"></i></span></label><a class="remove" href="#"><i class="icon-remove"></i></a></div>
                                                --}}
                                                <div class="ace-file-input ace-file-multiple">
                                                    <input name='img' type="file" id="id-input-file-3">
                                                    <a class="remove" href="#"><i class="icon-remove"></i></a>
                                                </div>
                                                {{--<label>
                                                    <input type="checkbox" name="file-format" id="id-file-format">
                                                    <span class="lbl"> Allow only images</span>
                                                </label>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="controls">
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="widget-box collapsed">
                                        <div class="widget-header">
                                            <h4>{{ trans('backend.img') }}</h4>
                                        <span class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                <i class="icon-chevron-up"></i>
                                            </a>
                                            {{-- <a href="#" data-action="close">
                                                 <i class="icon-remove"></i>
                                             </a>--}}
                                        </span>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                {{--
                                                 <div class="ace-file-input"><input type="file" name="img" id="id-input-file-2"><label data-title="Choose"><span data-title="No File ..."><i class="icon-upload-alt"></i></span></label><a class="remove" href="#"><i class="icon-remove"></i></a></div>
                                                --}}
                                                <div class="ace-file-input ace-file-multiple">
                                                    <input name='img' type="file" id="id-input-file-3">
                                                    <a class="remove" href="#"><i class="icon-remove"></i></a>
                                                </div>
                                                {{--<label>
                                                    <input type="checkbox" name="file-format" id="id-file-format">
                                                    <span class="lbl"> Allow only images</span>
                                                </label>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="control-group">
                    <label class="control-label">{{ trans('backend.status') }}</label>
                    <div class="controls">
                        <div class="row-fluid">
                            <div class="span3">
                                <label>
                                    <input name='active' type='hidden' value='0'>
                                    <input name='active' class="ace-switch ace-switch-6" type="checkbox" value=1 @if(isset($lang) AND $lang->active) checked="checked" @endif />
                                    <span class="lbl"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-4"></div>
                <input type="hidden" name="img_status" value= 'true'/>
                <input type="hidden" name="_method" value='{{$action_method}}'/>
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="form-actions">
                    <button class="btn btn-info resource-save" type="button">
                        <i class="icon-ok bigger-110"></i>
                        Сохранить
                    </button>
                </div>
                </form>
                <!--PAGE CONTENT ENDS-->
            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div><!--/.page-content-->
    <div id="token" style="display: none">{{csrf_token()}}</div>
@stop
