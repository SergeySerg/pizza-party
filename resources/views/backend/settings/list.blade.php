@extends('adminpanel')


@section('breadcrumbs')
    <li>
        <i class="icon-home home-icon"></i>
        <a href="{{ route('admin_dashboard') }}">{{ trans('backend.main') }}</a>
        <span class="divider">
            <i class="icon-angle-right arrow-icon"></i>
        </span>
    </li>
    <li class="active">{{ trans('backend.settings') }}</li>
@stop

@section('content')

    <div class="page-content">
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <div class="row-fluid">
                    <h3 class="header smaller lighter blue">{{ trans('backend.settings') }}</h3>

                    <div class="table-header">
                        {{ trans('backend.list_in_setting') }}
                        <a href="{{ route('settings_create') }}">
                            <button class="btn btn-warning">
                                <i class="icon-plus"></i>
                                {{ trans('backend.add_elements') }}
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
                                {{ trans('backend.field') }}
                            </th>
                            <th class="center">
                                {{ trans('backend.item') }}
                            </th>
                            <th class="hidden-phone center">
                                {{ trans('backend.altern') }}
                            </th>

                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($settings as $setting)
                                <tr>
                                    <td class="center">
                                        <label>
                                            <span class="lbl">{{ $setting->id }}</span>
                                        </label>
                                    </td>
                                    <td>
                                        <a href="{{ $url }}/settings/{{ $setting->id }}">{{ $setting->title }}</a>
                                    </td>
                                    <td>{{ $setting->description }}</td>
                                    <td>{{ $setting->name }}</td>
                                    <td class="td-actions">
                                        <div class="visible-phone visible-desktop action-buttons">
                                            <a class="green" href="{{ $url }}/settings/{{ $setting->id }}">
                                                <i class="icon-pencil bigger-130"></i>
                                            </a>
                                            <a href='{{ $url }}/settings/{{ $setting->id }}' data-id='{{ $setting->id }}' class='resource-delete'>
                                                <i class="icon-trash bigger-130"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if (count($settings_deleted))
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
                    @endif
                </div>

            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div>
    <div id="token" style="display: none">{{csrf_token()}}</div>
    <script>
        $(function(){
            var oTable1 = $('#sample-table-2').dataTable( {
                "aaSorting": [[4,'desc']],
                "aoColumns": [
                    { "bSortable": false },
                    null, null,null,
                    { "bSortable": false }
                ] } );
        });
    </script>
@stop