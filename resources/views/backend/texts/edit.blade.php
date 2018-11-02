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
    <a href="{{ route('text_index') }}">{{ trans('backend.texts') }}</a>

        <span class="divider">
            <i class="icon-angle-right arrow-icon"></i>
        </span>
</li>

<li class="active">{{$admin_text->id}}</li>

@stop

@section('content')

<div class="page-content">
    <div class="page-header position-relative">
        <h1>
            {{ trans('backend.edit') }}
        </h1>
    </div><!--/.page-header-->

    <div class="row-fluid">
        <div class="span12">
            <!--PAGE CONTENT BEGINS-->

            <form class="form-horizontal" id="resource-form" method="POST" action="" />

                <div class="hr hr-18 dotted hr-double"></div>

                <h4 class="pink">
                    <i class="icon-hand-right icon-animated-hand-pointer blue"></i>
                    <a href="#modal-table" role="button" class="green" data-toggle="modal"> Открыть подробную форму редактирования </a>
                </h4>

                <div class="hr hr-18 dotted hr-double"></div>

                <div id="modal-table" class="modal hide fade" tabindex="-1">
                    <div class="modal-header no-padding">
                        <div class="table-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            Дополнительние параметры данного блока
                        </div>
                    </div>

                    <div class="modal-body no-padding">
                        <div class="row-fluid">
                            <div class="space-12"></div>
                            <div class="control-group">
                                <label class="control-label" for="type">Тип блока</label>

                                <div class="controls">
                                    {{--<input type="text" name="type" value='{{$admin_text->type}}' />--}}
                                    <select name="type">
                                        <option>
                                            </option><option value="input" @if($admin_text->type == 'input')selected="selected"@endif>Обычное поле
                                            </option><option value="textarea" @if($admin_text->type == 'textarea')selected="selected"@endif>Текстовое поле
                                            </option><option value="textarea-no-wysiwyg" @if($admin_text->type == 'textarea-no-wysiwyg')selected="selected"@endif>Текстовое поле (без редактора)
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label" for="title">Название блока</label>

                                <div class="controls">
                                    <input type="text" name="title" value='{{$admin_text->title}}' placeholder=">Название блока" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="title">Альтернативное название блока</label>

                                <div class="controls">
                                    <input type="text" name="name" value='{{$admin_text->name}}' placeholder="Альтернативное название блока" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="priority">Приоритет</label>

                                <div class="controls">
                                    <input type="text" name="priority" value='{{$admin_text->priority}}' placeholder="Приоритет" />
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="lang_active">Мультиязычность</label>

                                <div class="controls">
                                    {{--<input type="text" name="lang_active" value='{{$admin_text->lang_active}}' placeholder="1 або 0" />--}}
                                    <select name="lang_active">
                                        <option>
                                        </option><option value="1" @if($admin_text->lang_active)selected="selected"@endif>На днескольки языках
                                        </option><option value="0" @if(!$admin_text->lang_active)selected="selected"@endif>Одно значение для всех языков
                                        </option></select>
                                </div>
                            </div>
                            <div class="space-12"></div>
                        </div>
                    </div>

                </div>


                <div class="space-12"></div>
                <div class="row-fluid">
                    <div class="span12">

                    @if(!$admin_text->lang_active)
                        @if($admin_text->type == 'input' OR $admin_text->type == 'settings' )
                            <div class="control-group">
                                <label class="control-label" for="description">{{$admin_text->title}}</label>

                                <div class="controls">
                                    <input type="text" name="description" value='{{ $admin_text->getTranslate('description') }}' placeholder="Текст" />
                                </div>
                            </div>
                        @elseif ($admin_text->type == 'textarea' )
                            <h4 class="header blue clearfix">{{$admin_text->title}}</h4>
                            <div class="control-group">
                                <textarea name="description" class="span12" id="description" placeholder="Описание">{{ $admin_text->description }}</textarea>
                            </div>
                        @elseif ($admin_text->type == 'textarea-no-wysiwyg' )
                            <h4 class="header blue clearfix">{{$admin_text->title}}</h4>
                            <div class="control-group">
                                <textarea name="description" class="span12 no-wysiwyg" id="description" placeholder="Описание">{{ $admin_text->description }}</textarea>
                            </div>
                        @endif

                    @else
                        <div class="tabbable">
                            <ul class="nav nav-tabs" id="myTab2">
                                @foreach($langs as $lang)
                                <li @if(($lang->lang) == config('app.locale')) class="active" @endif >
                                    <a data-toggle="tab" href="#{{$lang->lang}}">{{$lang->lang}}</a>
                                </li>
                                @endforeach

                            </ul>
                        </div>

                        <div class="tab-content">
                            @foreach($langs as $lang)
                            <div id="{{$lang->lang}}" @if(($lang->lang) == config('app.locale')) class="tab-pane in active" @else class="tab-pane" @endif>
                                @if($admin_text->type == 'input' )
                                <div class="control-group">
                                    <label class="control-label" for="description_{{$lang->lang}}">{{$admin_text->title}}</label>

                                    <div class="controls">
                                        <input type="text" name="description_{{$lang->lang}}" value='{{ $admin_text->getTranslate('description', $lang->lang) }}' placeholder="Текст" />
                                    </div>
                                </div>
                                @elseif ($admin_text->type == 'textarea' )
                                    <h4 class="header blue clearfix">{{$admin_text->title}}</h4>
                                    <div class="control-group">
                                        <textarea name="description_{{$lang->lang}}" class="span12" id="description_{{$lang->lang}}" placeholder="Опис" >{{ $admin_text->getTranslate('description',$lang->lang) }}</textarea>
    
    
                                    </div>
                                @elseif ($admin_text->type == 'textarea-no-wysiwyg' )
                                    <h4 class="header blue clearfix">{{$admin_text->title}}</h4>
                                    <div class="control-group">
                                        <textarea name="description_{{$lang->lang}}" class="span12 no-wysiwyg" id="description_{{$lang->lang}}" placeholder="Описание">{{ $admin_text->getTranslate('description',$lang->lang) }}</textarea>
                                    </div>
                                @endif

                            </div>
                            @endforeach
                        </div>
                    @endif

                    </div>
                </div>
                <div class="space-4"></div>
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
