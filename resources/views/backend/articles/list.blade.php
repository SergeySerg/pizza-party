@extends('adminpanel')


@section('breadcrumbs')
    <li>
        <i class="icon-home home-icon"></i>
        <a href="{{ $url }}">{{ trans('backend.main') }}</a>
        <span class="divider">
            <i class="icon-angle-right arrow-icon"></i>
        </span>
    </li>
    @if(isset($admin_category_parent))
    <li>
        <a href="{{ $url }}/articles/{{ $admin_category_parent->link }}">{{ $admin_category_parent->getTranslate('title') }}</a>
        <span class="divider">
            <i class="icon-angle-right arrow-icon"></i>
        </span>
    </li>
    @endif
    <li class="active">{{ $admin_category->getTranslate('title') }}</li>
@stop

@section('content')
@if($type == 'seasons')
    @include('backend.articles.custom_sections.seasons_list')
@elseif($type == 'prices')
    @include('backend.articles.custom_sections.prices_list')
@else
<div class="page-content">
    <div class="row-fluid">
        <div class="span12">
             <!--PAGE CONTENT BEGINS-->
            <div class="row-fluid">

                <h3 class="header smaller lighter blue">
                    {{$admin_category->getTranslate('title')}}&nbsp;&nbsp;&nbsp;&nbsp;
                    @if( (Auth::user()->name) == 'root' )
                        <a href='{{ $url }}/categories/{{$type}}' class="line_none">
                            <button class="btn btn-mini btn-success">
                                <i class="icon-edit bigger-120"></i>
                            </button>
                        </a>
                    <a href='{{ $url }}/categories/{{$type}}' data-id="{{ $admin_category->id }}" class="category-delete">
                        <button class="btn btn-mini btn-danger"  >
                            <i class="icon-trash bigger-120"></i>
                        </button>
                    </a>
                    @endif
                </h3>

                <div class="table-header">
                    {{ trans('backend.list_category') }} {{$admin_category->getTranslate('title')}}
                    <a href="{{ $url }}/articles/{{$type}}/create" class="line_none">
                        <button class="btn btn-warning">
                            <i class="icon-plus"></i>
                            {{ trans('backend.add_element') }} {{$admin_category->getTranslate('title')}}
                        </button>
                    </a>
                </div>
                <table id="sample-table-2" class="table table-striped table-bordered table-hover" >
                    <thead>
                    <tr>
                        <th class="center">
                            ID
                        </th>
                        <th class="center">{{ trans('backend.title') }}</th>
                        <th class="center">
                            @if($type == 'marketings'                                
                                OR $type == 'reviews'                                
                                OR $type == 'slides'
                                
                            )
                                Відображення на Brand Page                              
                            @else
                                <i class="icon-time bigger-110 hidden-phone"></i>
                                {{ trans('backend.date_create') }}
                            @endif     
                            
                        </th>
                        <th class="center">
                            @if($type == 'marketings' 
                                OR $type == 'rooms' 
                                OR $type == 'contacts'
                                OR $type == 'servicespaid'
                                OR $type == 'servicesfree'
                                OR $type == 'reviews'
                                OR $type == 'discounts'
                                OR $type == 'slides' 
                                OR $type == 'advantages'
                                OR $type == 'seoarticles'
                                )
                                Готель                               
                            @else
                                <i class="icon-time bigger-110 hidden-phone"></i>
                                {{ trans('backend.date_update') }}
                            @endif                            
                        </th>

                       <!-- <th class="hidden-phone">
                            <i class="icon-time bigger-110 hidden-phone"></i>
                            Update
                        </th>-->
                        <th class="center">{{ trans('backend.status') }}</th>
                        <th>{{ trans('backend.priority') }}</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                        @foreach($admin_articles as $admin_article)
                        
                            <tr>
                                <td class="center">
                                    <label>
                                        <span class="lbl">{{ $admin_article->id }}</span>
                                    </label>
                                </td>
                                <td>
                                    <a href="{{ $url }}/articles/{{$type}}/{{$admin_article->id}}">{!! $admin_article->getTranslate('title') !!}</a>
                                    @if(!$admin_article->active AND $type == 'reviews')
                                        <span class="label label-info arrowed-in-right arrowed">New</span>                                   
                                    @endif                                    
                                </td>
                                @if($type == 'marketings' 
                                    OR $type == 'reviews'                                    
                                    OR $type == 'slides'                                   
                                    )                                
                                    <td class="center">
                                        @if($admin_article->getAttributeTranslate('show_main_page') == 1) 
                                            <span class="badge badge-success"><i class="icon-ok bigger-120"></i></span> 
                                        @else 
                                            <span class="badge badge-important"><i class="icon-remove"></i></span>
                                        @endif
                                    </td>
                                @else
                                    <td  class="hidden-phone">{{ $admin_article->created_at }}</td>
                                @endif 
                                @if($type == 'marketings' 
                                    OR $type == 'rooms'
                                    OR $type == 'contacts'
                                    OR $type == 'servicespaid'
                                    OR $type == 'servicesfree'
                                    OR $type == 'reviews'
                                    OR $type == 'discounts'
                                    OR $type == 'slides'
                                    OR $type == 'advantages'
                                    OR $type == 'seoarticles'
                                    
                                    )
                                    <td>@if($admin_article->article_parent) {{ $admin_article->article_parent->getTranslate('title') }}@else 
                                    @if($type == 'discounts')
                                        На всіх сторінках
                                    @else
                                        Brand Page
                                    @endif
                                    @endif</td>
                                @else
                                    <td  class="hidden-phone">{{ $admin_article->updated_at }}</td>
                                @endif                               

                                <td class="center">
                                    @if($admin_article->active)
                                        <span class="badge badge-success"><i class="icon-ok bigger-120"></i></span>
                                    @else
                                        <span class="badge badge-important"><i class="icon-remove"></i></span>
                                    @endif
                                </td>

                                <td class="center">{{ $admin_article->priority }}</td>

                                <td class="td-actions">
                                    <div class="hidden-phone visible-desktop action-buttons">
                                        <a class="green" href="{{ $url }}/articles/{{$type}}/{{$admin_article->id}}">
                                            <i class="icon-pencil bigger-130"></i>
                                        </a>

                                        <a href='{{ $url }}/articles/{{$type}}/{{$admin_article->id}}' data-id='{{$admin_article->id}}' class='resource-delete'>
                                            <i class="icon-trash bigger-130"></i>
                                        </a>
                                    </div>

                                    <div class="hidden-desktop visible-phone">
                                        <div class="inline position-relative">
                                            <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon-caret-down icon-only bigger-120"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
                                                <li>
                                                    <a href="{{ $url }}/articles/{{$type}}/{{$admin_article->id}}" class="tooltip-info" data-rel="tooltip" title="View">
                                                        <span class="blue">
                                                            <i class="icon-zoom-in bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href="{{ $url }}/articles/{{$type}}/{{$admin_article->id}}" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                        <span class="green">
                                                            <i class="icon-edit bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a href='{{ $url }}/articles/{{$type}}/{{$admin_article->id}}' data-id='{{$admin_article->id}}' class='resource-delete' class="tooltip-error" data-rel="tooltip" title="Delete">
                                                        <span class="red">
                                                            <i class="icon-trash bigger-120"></i>
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                         @endforeach
                    </tbody>
                </table>
            </div>
         <!--PAGE CONTENT ENDS-->
        </div><!--/.span-->
    </div><!--/.row-fluid-->
</div>
<div id="token" style="display: none">{{csrf_token()}}</div>

<script>
    $( document ).ready(function() {
        $(function(){
            var oTable1 = $('#sample-table-2').dataTable( {
                "aaSorting": [[3,'asc']],
                "iDisplayLength": 25,
                "aoColumns": [
                    { "bSortable": false },
                    null, null,null, null,null,
                    { "bSortable": false }
                ] } );
        });
    })
</script>
@endif


@stop
