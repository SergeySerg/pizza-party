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

<li class="active">Добавить новый</li>
@stop

@section('content')

<div class="page-content">
    <div class="page-header position-relative">
        <h1>
            {{ trans('backend.ad') }}
        </h1>
    </div><!--/.page-header-->

    <div class="row-fluid">
        <div class="span12">
            <!--PAGE CONTENT BEGINS-->

            <form class="form-horizontal" id="resource-form" method="POST" action="" />


                    <div class="control-group">
                        <label class="control-label" for="type">Тип блока</label>

                        <div class="controls">
                            <select name="type">
                                <option>
                                    </option><option value="input" selected="selected">Обычное поле
                                    </option><option value="textarea">Текствое поле
                                    </option><option value="textarea-no-wysiwyg">Текствое поле(без редактора)
                                 </option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="title">Название блока</label>

                        <div class="controls">
                            <input type="text" name="title" value='' placeholder="Название блока" />
                        </div>
                    </div>

                     <div class="control-group">
                    <label class="control-label" for="title">Альтернативное название блока</label>

                    <div class="controls">
                        <input type="text" name="name" value='' placeholder="Альтернативное название блока" />
                    </div>
                </div>

                    <div class="control-group">
                        <label class="control-label" for="priority">Приоритет</label>

                        <div class="controls">
                            <input type="text" name="priority" value='' placeholder="Приоритет" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="lang_active">Мультиязычность</label>

                        <div class="controls">
                            <select name="lang_active">
                                <option>
                                    </option><option value="1" selected>На нескольки языках
                                    </option><option value="0">Одно значение для всех языков
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="space-12"></div>
                    <div class="row-fluid">
                        <div class="span12">
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

                                    <div class="control-group">
                                        <label class="control-label" for="description_{{$lang->lang}}">Значение</label>

                                        <div class="controls">
                                            <input type="text" name="description_{{$lang->lang}}" value='' placeholder="Значение" />
                                        </div>
                                    </div>

                                </div>
                                @endforeach
                            </div>

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
