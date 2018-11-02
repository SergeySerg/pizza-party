@extends('adminpanel')


@section('breadcrumbs')
    <li>
        <i class="icon-home home-icon"></i>
        <a href="{{ route('admin_dashboard') }}">{{ trans('backend.main') }}</a>
        <span class="divider">
            <i class="icon-angle-right arrow-icon"></i>
        </span>
    </li>
    <li class="active">Локализация{{--{{ trans('backend.settings') }}--}}</li>
@stop

@section('content')

    <div class="page-content">
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <div class="row-fluid">
                    <h3 class="header smaller lighter blue">Локализация</h3>

                    <div class="table-header">
                        Список элементов в локализации
                        <a href="{{ route('langs_create') }}">
                            <button class="btn btn-warning">
                                <i class="icon-plus"></i>
                                Добавить элемент
                            </button>
                        </a>
                    </div>
                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>

                            <th class="center">
                                ID
                            </th>
                            <th class="center">
                                Флаг
                            </th>
                            <th class="center">
                                Страна
                            </th>
                            <th class="center">
                                Обозначение
                            </th>
                            <th class="hidden-phone center">
                                Статус
                            </th>
                            <th class="hidden-phone center">
                                Приоритет
                            </th>

                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($langs as $lang)
                            <tr>
                                <td class="center">
                                    <label>
                                        <span class="lbl">{{ $lang->id }}</span>
                                    </label>
                                </td>

                                <td class="center">
                                    <a href="{{ $url }}/langs/{{ $lang->id }}">@if($lang->img)<img style="width: 24px; height: 16px;" src="{{ asset($lang->img) }}" alt="{{ $lang->lang }}">@endif</a>
                                </td>
                                <td class="center">
                                    <a href="{{ $url }}/langs/{{ $lang->id }}">{{ $lang->country }}</a>
                                </td>
                                <td class="center">{{ $lang->lang }}</td>
                                <td class="center">
                                    @if($lang->active)
                                        <span class="badge badge-success"><i class="icon-ok bigger-120"></i></span>
                                    @else
                                        <span class="badge badge-important"><i class="icon-remove"></i></span>
                                    @endif
                                </td>
                                <td class="center">{{ $lang->priority }}</td>
                                <td class="td-actions">
                                    <div class="visible-phone visible-desktop action-buttons">
                                        <a class="green" href="{{ $url }}/langs/{{ $lang->id }}">
                                            <i class="icon-pencil bigger-130"></i>
                                        </a>
                                        {{--<a href='{{ $url }}/langs/{{ $lang->id }}' data-id='{{ $lang->id }}' class='resource-delete'>
                                            <i class="icon-trash bigger-130"></i>
                                        </a>--}}
                                    </div>
                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--@if (count($settings_deleted))
                        <h4 class="pink">

                            <a href="#modal-table" role="button" class="green" data-toggle="modal">
                                <i class="icon-trash icon icon-only"></i> {{ trans('backend.delete') }}
                            </a>
                            <div id="modal-table" class="modal hide fade" tabindex="-1">
                                <div class="modal-header no-padding">
                                    <div class="table-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        {{ trans('backend.delete') }}
                                    </div>
                                </div>

                                <div class="modal-body no-padding">
                                    <div class="row-fluid">
                                        <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top" style="font-size: 10px">
                                            <thead>
                                            <tr>
                                                <th>{{ trans('backend.field') }}</th>
                                                <th>{{ trans('backend.item') }}</th>
                                                <th>{{ trans('backend.altern') }}</th>

                                                <th>
                                                    <i class="icon-time bigger-110"></i>
                                                    Deleted_at
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            @foreach($settings_deleted as $setting_deleted)
                                                <tr>
                                                    <td>
                                                        <a href="#">{{ $setting_deleted->title }}</a>
                                                    </td>
                                                    <td>{{ $setting_deleted->description }}</td>
                                                    <td>{{ $setting_deleted->name }}</td>
                                                    <td>{{ $setting_deleted->deleted_at }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="{{ route('settings_delete')}}">
                                        <button class="btn btn-small btn-danger pull-left">
                                            <i class="icon-remove"></i>
                                            {{ trans('backend.delete_end') }}
                                        </button>
                                    </a>
                                    <a href="{{ route('settings_recovery')}}">
                                        <button class="btn btn-small btn-success btn-small">
                                            {{ trans('backend.recovery') }}
                                            <i class="icon-undo"></i>
                                        </button>
                                    </a>
                                </div>
                            </div><!--PAGE CONTENT ENDS-->
                        </h4>
                    @endif--}}
                </div>

            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div>
    <div id="token" style="display: none">{{csrf_token()}}</div>
    <script>
        $(function(){
            var oTable1 = $('#sample-table-2').dataTable( {
                "aaSorting": [[6,'desc']],
                "aoColumns": [
                    { "bSortable": false },
                    null, null,null,null,null,
                    { "bSortable": false }
                ] } );
        });
    </script>
@stop