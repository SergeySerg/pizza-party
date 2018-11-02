@extends('adminpanel')

@section('breadcrumbs')
    <li>
        <i class="icon-home home-icon"></i>
        <a href="{{ $url }}/">{{ trans('backend.main') }}</a>
        <span class="divider">
            <i class="icon-angle-right arrow-icon"></i>
        </span>
    </li>
    @if(isset($type))
        <li>
            <a href="{{ $url }}/articles/{{ $type }}">{{ $admin_category->getTranslate('title') }}</a>
        <span class="divider">
            <i class="icon-angle-right arrow-icon"></i>
        </span>
        </li>
    @else
        <li>
            <a href="{{ $url }}/articles/{{ $admin_category->link }}">{{ $admin_category->getTranslate('title') }}</a>
        <span class="divider">
            <i class="icon-angle-right arrow-icon"></i>
        </span>
        </li>
    @endif

    @if(isset($admin_article))
        <li class="active">{{$admin_article->id}}</li>
    @else
        <li class="active">{{ trans('backend.add_new_item') }}</li>
    @endif
@stop

@section('content')

    <div class="page-content">
        <div class="page-header position-relative">
            <h1>{{ isset($admin_article) ? trans('backend.edit') : trans('backend.ad') }}</h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <form class="form-horizontal" id="resource-form" method="POST" action="" />
                    @if(isset($attributes_fields))
                        @foreach($attributes_fields as $key => $attribute)
                            @if(isset($attribute)  AND !$attribute->lang_active)
                                @if($attribute->type == 'input' )
                                    <div class="control-group">
                                        <label class="control-label" for="form-field-2">{{ $attribute->publick_name }}</label>
                                            <div class="controls">
                                            <input type="text" id="form-field-2" name='attributes[{{ $key }}]'  value='{{ $attributes[$key]  or ''}}'/>
                                            </div>                                        
                                    </div>
                                @elseif($attribute->type == 'select')
                                <div class="control-group">
                                    <label class="control-label" for="form-field-222">{{ $attribute->publick_name }}</label>
                                        <div class="controls">
                                            <select name="attributes[{{ $key }}]" id="form-field-select-222">
                                                <option value="">
                                                    </option><option value="facebook" @if(isset($attributes[$key]) AND $attributes[$key] == 'facebook') selected="selected" @endif>facebook
                                                    </option><option value="instagram" @if(isset($attributes[$key]) AND $attributes[$key] == 'instagram') selected="selected" @endif>instagram
                                                    </option><option value="google" @if(isset($attributes[$key]) AND $attributes[$key] == 'google') selected="selected" @endif>google

                                                </option>
                                            </select>                                            
                                        </div>                                        
                                </div>
                                @elseif ($attribute->type == 'checkbox')
                                    <div class="control-group">
                                        <label class="control-label">{{ $attribute->publick_name }}</label>
                                        <div class="controls">
                                            <div class="row-fluid">
                                                <div class="span3">
                                                    <label>
                                                    <input name='attributes[{{ $key }}]' type='hidden' value='0'>
                                                    <input name='attributes[{{ $key }}]' class="ace-switch ace-switch-6" type="checkbox" value=1 @if(isset($attributes[$key]) AND $attributes[$key] == '1') checked="checked" @endif />
                                                        <span class="lbl"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($attribute->type == 'textarea' )
                                    <h4 class="header blue clearfix">{{ $attribute->publick_name }}</h4>
                                    <div class="control-group">
                                        <textarea name='attributes[{{ $key }}]' class="span12" data-id="{{ $key }}" placeholder="{{ trans('backend.description_category') }}">{{ $attributes[$key]  or ''}}</textarea>
                                    </div>
                                @elseif ($attribute->type == 'textarea-no-wysiwyg')
                                    <h4 class="header blue clearfix">{{ $attribute->publick_name }}</h4>
                                    <div class="control-group">
                                        <textarea name='attributes[{{ $key }}]' class="span12 no-wysiwyg" data-id="{{ $key }}" placeholder="{{ trans('backend.description_category') }}">{{ $attributes[$key]  or ''}}</textarea>
                                    </div>
                                @elseif ($attribute->type == 'files' )
                                    <div class="control-group">
                                    <label class="control-label" for="id-date-picker-1">{{ $attribute->publick_name }}</label>
                                    @if(isset($admin_article) && $admin_article->getAttributeTranslate($key))
                                        <div class="controls show-image">
                                            <div class="row-fluid">
                                                <div class="span3">
                                                    <div class="profile-activity clearfix" style="border-bottom: none">
                                                        <div>
                                                            <img class="pull-left" alt="#" style="max-width:200px;border-radius:0%" src="{{ asset( $admin_article->getAttributeTranslate($key)) }}">
                                                            <input type="hidden" name="saved-files-path[{{ $key }}]" value="{{ $admin_article->getAttributeTranslate($key) }}">
                                                        </div>

                                                        <div class="tools action-buttons">
                                                            <a href="#" class="blue">
                                                                <i class="icon-pencil bigger-125 image-edit" ></i>
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
                                                            <h4>{{ $key }}</h4>
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
                                                                <div class="ace-file-multiple">
                                                                    <input name='attributes[{{ $key }}]' type="file" id="id-input-file-3">
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
                                                <div class="span4">
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
                                                                    <input name='attributes[{{ $key }}]' type="file" id="id-input-file-3">
                                                                    <input type="hidden" name="saved-files-path[]" value="">


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
                                @elseif($attribute->type == 'date-range-picker')
                                    <div class="control-group">
                                        <label class="control-label" for="id-date-range-picker-1">{{ $attribute->publick_name }}</label>
                                            <div class="controls">
                                                <div class="row-fluid input-prepend">
                                                    <span class="add-on">
                                                        <i class="icon-calendar"></i>
                                                    </span>

                                                    <input type="text" name='attributes[{{ $key }}]' id="id-date-range-picker-1"  value='{{ $attributes[$key]  or ''}}'/>
                                                </div>
                                            </div>    
                                    </div>
                                @elseif($attribute->type == 'date-picker')
                                    <div class="control-group">
                                        <label class="control-label" for="id-date-picker-{{ $key }}">{{ $attribute->publick_name }}</label>
                                            <div class="controls">
                                                    <div class="row-fluid input-append">
                                                        <input class="span2 date-picker" name="attributes[{{ $key }}]" id="id-date-picker-{{ $key }}" type="text" data-date-format="dd-mm-yyyy" value='{{ $attributes[$key]  or ''}}'/>
                                                        <span class="add-on">
                                                            <i class="icon-calendar"></i>
                                                        </span>
                                                    </div>
                                            </div>
                                    </div>
                                
                                @endif
                            @endif
                        @endforeach
                    @endif
                    @if($admin_category->hasField('type'))
                        <div class="control-group">
                            <label class="control-label" for="form-field-2">Тип</label>

                            <div class="controls">
                                <input type="text" id="form-field-2" name="type" @if(isset($admin_article)) value='{{$admin_article->type}}'disabled @endif  />
                            </div>
                        </div>
                    @endif
                    @if($admin_category->hasField('subdomain'))
                        <div class="control-group">
                            <label class="control-label" for="form-field-2">Субдомен</label>

                            <div class="controls">
                                <input type="text" id="form-field-2" name="subdomain" @if(isset($admin_article)) value='{{$admin_article->subdomain}}' disabled @endif  />
                            </div>
                        </div>
                    @endif
                    @if($admin_category->hasField('priority'))
                        <div class="control-group">
                            <label class="control-label" for="form-field-2">{{ trans('backend.priority') }}</label>

                            <div class="controls">
                                <input type="number" id="form-field-2" name="priority" @if(isset($admin_article)) value='{{$admin_article->priority}}' @endif  />
                            </div>
                        </div>
                    @endif
                    @if($admin_category->hasField('active'))
                        <div class="control-group">
                            <label class="control-label">{{ trans('backend.status') }}</label>
                            <div class="controls">
                                <div class="row-fluid">
                                    <div class="span3">
                                        <label>
                                            <input name='active' type='hidden' value='0'>
                                            <input name='active' class="ace-switch ace-switch-6" type="checkbox" value=1 @if(isset($admin_article) AND $admin_article->active) checked="checked" @endif />
                                            <span class="lbl"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($admin_category->hasField('article_parent'))
                        <div class="control-group">
                            <label class="control-label" for="form-field-select-1">{{ trans('backend.relation') }}</label>
                            <div class="controls">
                                <select name="article_id" @if($admin_category->hasField('article_parent_2')) data-name= 'article_parent' @endif id="form-field-select-1">
                                    <option value="">
                                    @if($type == 'discounts')
                                        На всіх сторінках
                                    @else
                                        Brand Page
                                    @endif
                                    @foreach($article_group as $article)
                                        @if($article->getAttributeTranslate('is_base_hotel') == 1)
                                            </option><option value="{{ $article->id }}" @if(isset($article_id) && ($article_id == $article->id)) selected="selected" @endif>{{ $article->getTranslate('title') }}
                                        @elseif($type == 'rooms' OR $type == 'reviews' OR $type == 'hotels' OR $type == 'seoarticles' OR $type == 'prices' OR $type == 'seasons')
                                            </option><option value="{{ $article->id }}" @if(isset($article_id) && ($article_id == $article->id)) selected="selected" @endif>{{ $article->getTranslate('title') }} @if($type == 'prices')/ {{  $article->article_parent->getTranslate('title')}} @endif
                                        {{--@else
                                            </option><option value="{{ $article->id }}" @if(isset($article_id) && ($article_id == $article->id)) selected="selected" @endif>{{ $article->getTranslate('title') }}--}}
                                        @endif                        
                                    @endforeach
                                    </option>
                                </select>
                            </div>
                        </div>
                    @endif
                    @if($admin_category->hasField('article_parent_2'))
                        <div class="control-group">
                            <label class="control-label" for="form-field-select-2">{{ trans('backend.relation') }} (связь к Номеру)</label>
                            <div class="controls">
                                <select name="article_id_2" id="form-field-select-2">
                                    <option value="">
                                    @if(isset($rooms_for_check_price))
                                        @foreach($rooms_for_check_price as $room)
                                            </option><option value="{{ $room->id }}" @if($admin_article->article_id_2 == $room->id)) selected="selected" @endif>{{ $room->getTranslate('title') }}
                                        @endforeach
                                    @endif
                                    </option>
                                </select>
                            </div>
                        </div>
                    @endif
                    @if($admin_category->hasField('date'))
                        <div class="control-group">
                            <label class="control-label" for="id-date-picker-1">{{ trans('backend.date') }}</label>
                        <div class="controls">
                                <div class="row-fluid input-append">
                                    <input class="span2 date-picker" name="date" id="id-date-picker-1" type="text" data-date-format="dd-mm-yyyy" @if(isset($admin_article)) value='{{date('d-m-Y',strtotime($admin_article->date)) }}' @endif/>
                                    <span class="add-on">
                                        <i class="icon-calendar"></i>
                                   </span>
                                </div>
                            </div>
                    @endif
                    @if($admin_category->hasField('date_start'))
                        <div class="control-group">
                            <label class="control-label" for="id-date-picker-2">Дата начала сезона</label>
                        <div class="controls">
                                <div class="row-fluid input-append">
                                    <input class="span2 date-picker" name="date_start" id="id-date-picker-2" type="text" data-date-format="dd-mm-yyyy" @if(isset($admin_article)) value='{{date('d-m-Y',strtotime($admin_article->date_start)) }}' @endif/>
                                    <span class="add-on">
                                        <i class="icon-calendar"></i>
                                   </span>
                                </div>
                            </div>
                    @endif
                    @if($admin_category->hasField('date_finish'))
                        <div class="control-group">
                            <label class="control-label" for="id-date-picker-3">Дата окончания сезона</label>
                        <div class="controls">
                                <div class="row-fluid input-append">
                                    <input class="span2 date-picker" name="date_finish" id="id-date-picker-3" type="text" data-date-format="dd-mm-yyyy" @if(isset($admin_article)) value='{{date('d-m-Y',strtotime($admin_article->date_finish)) }}' @endif/>
                                    <span class="add-on">
                                        <i class="icon-calendar"></i>
                                   </span>
                                </div>
                            </div>
                    @endif
                    @if($admin_category->hasField('img'))
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
                        @if(isset($admin_article) && $admin_article->img)
                            {{--
                                                                <label class="control-label">Картинка категорії</label>
                            --}}
                            <div class="controls" id="show-image" >
                                <div class="row-fluid">
                                    <div class="span3">
                                        <div class="profile-activity clearfix" style="border-bottom: none">
                                            <div>
                                                <img class="pull-left" alt="{{ $admin_article->getTranslate('title') }}" style="max-width:200px;border-radius:0%" src="{{ asset($admin_article->img) }}">
                                            </div>

                                            <div class="tools action-buttons">
                                                <a href="#" class="blue">
                                                    <i class="icon-pencil bigger-125 image-edit"></i>
                                                </a>

                                                <a href="#" class="red">
                                                    <i class="icon-remove bigger-125 image-close" id=""></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="controls" id="image-upload" style="display:none">
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
                    @endif
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
                                        @if($admin_category->hasField('title'))
                                            <div class="control-group">
                                                <label class="control-label" for="form-field-3">{{ trans('backend.title') }}</label>

                                                <div class="controls">
                                                    <input type="text" name="title_{{$lang->lang}}" value='@if(isset($admin_article)){{ $admin_article->getTranslate('title', $lang->lang) }}@endif' id="form-field-3" placeholder="{{ trans('backend.title') }}" />
                                                </div>
                                            </div>
                                        @endif

                                        @if(isset($attributes_fields))
                                            @foreach($attributes_fields as $key => $attribute)
                                               @if(isset($attribute) AND $attribute AND ($attribute->lang_active))
                                                    @if($attribute->type == 'input' )
                                                        <div class="control-group">
                                                            <label class="control-label" for="form-field-2">{{ $attribute->publick_name }}</label>

                                                            <div class="controls">
                                                                <input type="text" name='attributes[{{ $key }}_{{$lang->lang}}]' value='@if(isset($admin_article)){{ $admin_article->getAttributeTranslate($key, $lang->lang) }}@endif' id="form-field-{{ $key }}" placeholder="{{ $key }}" />
                                                            </div>
                                                        </div>
                                                    @elseif ($attribute->type == 'textarea' )
                                                        <h4 class="header blue clearfix">{{ $attribute->publick_name }}</h4>
                                                        <div class="control-group">
                                                        <textarea name='attributes[{{ $key }}_{{$lang->lang}}]' class="span12" id="form-field-{{ $key }}" placeholder="Текст">@if(isset($admin_article)){{ $admin_article->getAttributeTranslate($key, $lang->lang) }}@endif </textarea>
                                                        </div>
                                                    @elseif ($attribute->type == 'textarea-no-wysiwyg' )
                                                        <h4 class="header blue clearfix">{{ $attribute->publick_name }}</h4>
                                                        <div class="control-group">
                                                            <textarea name='attributes[{{ $key }}_{{$lang->lang}}]' class="span12 no-wysiwyg" id="form-field-{{ $key }}" placeholder="Текст">@if(isset($admin_article)){{ $admin_article->getAttributeTranslate($key, $lang->lang) }}@endif</textarea>
                                                        </div>
                                                    @elseif (isset($attribute) AND$attribute->type == 'files' )
                                                        <div class="control-group">
                                                            <label class="control-label" for="id-date-picker-1">{{ $attribute->publick_name }}</label>
                                                            @if(isset($admin_article) && $admin_article->getAttributeTranslate($key, $lang->lang))
                                                                <div class="controls show-image">
                                                                    <div class="row-fluid">
                                                                        <div class="span3">
                                                                            <div class="profile-activity clearfix" style="border-bottom: none">
                                                                                <div>
                                                                                    <img class="pull-left" alt="#" style="max-width:200px;border-radius:0%" src="{{ asset( $admin_article->getAttributeTranslate($key, $lang->lang)) }}">
                                                                                    <input type="hidden" name="saved-files-path[{{ $key . '_' . $lang->lang }}]" value="{{ $admin_article->getAttributeTranslate($key, $lang->lang) }}">
                                                                                </div>

                                                                                <div class="tools action-buttons">
                                                                                    <a href="#" class="blue">
                                                                                        <i class="icon-pencil bigger-125 image-edit" ></i>
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
                                                                                    <h4>{{ $key }}</h4>
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
                                                                                            <input name='attributes[{{ $key }}_{{$lang->lang}}]' class="showing_img" type="file" id="id-input-file-{{$lang->lang}}">
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
                                                                        <div class="span4">
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
                                                                                            <input name='attributes[{{ $key }}_{{$lang->lang}}]' type="file" id="id-input-file-{{$lang->lang}}">
                                                                                            <input type="hidden" name="saved-files-path[]" value="">


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
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif

                                        @if($admin_category->hasField('meta_title'))
                                            <h4 class="header blue clearfix">SEO</h4>
                                            <div class="control-group">
                                                <label class="control-label" for="form-field-4">META Title</label>

                                                <div class="controls">
                                                    <input type="text" id="form-field-4" name="meta_title_{{$lang->lang}}" value="@if(isset($admin_article)){{ $admin_article->getTranslate('meta_title',$lang->lang) }}@endif"/>

                                                </div>
                                            </div>
                                        @endif
                                        @if($admin_category->hasField('meta_description'))
                                            <div class="control-group">
                                                <label class="control-label" for="form-field-5">META Description</label>

                                                <div class="controls">
                                                    <input type="text" id="form-field-5" name="meta_description_{{$lang->lang}}" value="@if(isset($admin_article)){{ $admin_article->getTranslate('meta_description',$lang->lang)}}@endif"/>
                                                </div>
                                            </div>
                                        @endif
                                        @if($admin_category->hasField('meta_keywords'))
                                            <div class="control-group">
                                                <label class="control-label" for="form-field-tags">META Keywords</label>

                                                <div class="controls">
                                                    <input type="text" name="meta_keywords_{{$lang->lang}}" class="form-field-tags" value="@if(isset($admin_article)){{ $admin_article->getTranslate('meta_keywords',$lang->lang)}}@endif" placeholder="{{ trans('backend.keywords') }}" />
                                                </div>
                                            </div>
                                        @endif
                                        @if($admin_category->hasField('short_description'))
                                            <h4 class="header blue clearfix">{{ trans('backend.short_description_category') }}</h4>
                                            <div class="control-group">
                                                <textarea name="short_description_{{$lang->lang}}"class="span12" id="form-field-8" placeholder="{{ trans('backend.short_description_category') }}">@if(isset($admin_article)){{ $admin_article->getTranslate('short_description',$lang->lang) }}@endif</textarea>


                                            </div>
                                        @endif
                                        @if($admin_category->hasField('description'))
                                            <h4 class="header blue clearfix">{{ trans('backend.description_category') }}</h4>
                                            <div class="control-group">
                                                <textarea name="description_{{$lang->lang}}"class="span12" id="form-field-8" placeholder="{{ trans('backend.description_category') }}">@if(isset($admin_article)){{ $admin_article->getTranslate('description',$lang->lang) }}@endif</textarea>


                                            </div>
                                        @endif

                                    </div>
                                @endforeach

                                @if ($admin_category->hasField('gallery'))
                                    @if(isset($admin_article))
                                        <h4 class="header green clearfix">
                                            {{ trans('backend.gallery') }}
                                        </h4>
                                        <iframe
                                                frameborder="0"
                                                src="/js/backend/kcfinder/browse.php?type=images&langCode=ru&homedir=/{{$admin_article->id}}/&config=articles"
                                                style="width: 100%; height: 400px"
                                                title="Визуальный файловый браузер"
                                                tabindex="0"
                                                allowtransparency="true"></iframe>
                                    @else
                                        <div class="alert alert-warning">
                                            <button type="button" class="close" data-dismiss="alert">
                                                <i class="icon-remove"></i>
                                            </button>
                                            <strong>Увага!</strong>
                                            {{ trans('backend.form_gallery') }}                                            <br>
                                        </div>
                                    @endif
                                @endif

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
                            {{ trans('backend.save') }}
                        </button>
                    </div><!--<input type="button" class='article-save' value="Сохранить">-->
                </form>
                        <!--PAGE CONTENT ENDS-->
            </div><!--/.span-->
            </div><!--/.row-fluid-->
        </div><!--/.page-content-->
        <div id="token" style="display: none">{{csrf_token()}}</div>
@stop

