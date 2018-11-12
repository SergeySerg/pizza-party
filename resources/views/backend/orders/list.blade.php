@extends('adminpanel')


@section('breadcrumbs')
    <li>
        <i class="icon-home home-icon"></i>
        <a href="{{ route('admin_dashboard') }}">{{ trans('backend.main') }}</a>
        <span class="divider">
            <i class="icon-angle-right arrow-icon"></i>
        </span>
    </li>
    <li class="active">Заказы</li>
@stop

@section('content')

    <div class="page-content">
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <div class="row-fluid">
                    <h3 class="header smaller lighter blue">Заказы</h3>

                    <div class="table-header">
                        Список заказов
                        {{--<a href="{{ route('settings_create') }}">
                            <button class="btn btn-warning">
                                <i class="icon-plus"></i>
                                {{ trans('backend.add_elements') }}
                            </button>
                        </a>--}}
                    </div>
                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>

                            <th class="center">
                                ID
                            </th>
                            <th class="center">
                                Имя клиента
                            </th>
                            <th class="center">
                                Телефон
                            </th>
                            <th class="center">
                                Адрес доставки
                            </th>
                            <th class="center">
                                Время получения заказа
                            </th>
                            <th class="center">
                                Сумма к оплате
                            </th>
                            <th class="center">
                                Пожелания от клиента
                            </th>
                            <th class="center">
                                Статус
                            </th>

                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="center">
                                        <label>
                                            <a href="{{ $url }}/orders/{{ $order->id }}">
                                                <span data-id ={{ $order->id }} class="lbl">
                                                    {{ $order->id }}
                                                </span>
                                            </a>
                                        </label>
                                    </td>
                                    <td class="center">{{ $order->name }}</td>
                                    <td class="center">{{ $order->phone }}</td>
                                    <td class="center">{{ $order->address }}</td>
                                    <td class="center">{{ $order->created_at }}</td>
                                    <td class="center">{{ $order->sum }} грн</td>
                                    <td class="center">{{ $order->short_description }}</td>
                                    <td class="center">
                                        @if($order->status)
                                            <a href=''><span data-id = {{ $order->status}} class="label label-warning arrowed arrowed-right change-status">Обработан</span></a>

                                            @else

                                            <a href=''><span data-id = {{ $order->status}} class="label label-important arrowed change-status">Не обработан</span></a>
                                        @endif
                                    </td>
                                    <td class="td-actions">
                                        <div class="visible-phone visible-desktop action-buttons">
                                            <a class="green" href="#modal-table-{{$order->id}}" data-toggle="modal">
                                                <i class="icon-zoom-in bigger-130"></i>
                                            </a>    
                                            {{--<a class="green" href="{{ $url }}/orders/{{ $order->id }}">
                                                <i class="icon-pencil bigger-130"></i>
                                            </a>
                                            <a href='{{ $url }}/orders/{{ $order->id }}' data-id='{{ $order->id }}' class='resource-delete'>
                                                <i class="icon-trash bigger-130"></i>
                                            </a>--}}
                                        </div>
                                    </td>
                                </tr>
                                
                            @endforeach
                            
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div>
    @foreach($orders as $order)
        {{--Modal--}}
            <div id="modal-table-{{$order->id}}" class="modal hide fade in" tabindex="-1" aria-hidden="false">
                <div class="modal-header no-padding">
                    <div class="table-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        Содержание заказа #{{ $order->id }}
                    </div>
                </div>

                <div class="modal-body no-padding">
                    <div class="row-fluid">
                        <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                            <thead>
                                <tr>
                                    <th class="center">Номер</th>
                                    <th class="center">Название товара</th>
                                    <th class="center">Количество</th>
                                    <th class="center">Параметры</th>
                                    <th class="center">
                                        Цена
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->getAttributes() as $attribute)
                                    <tr>
                                        <td class="center">
                                            @if(isset($attribute['number_id']) AND $attribute['number_id']) 
                                                {{$attribute['category_id']}}{{$attribute['number_id']}}
                                            @endif    
                                        </td>
                                        <td class="center">
                                            <a href="{{ $url }}/articles/{{$attribute['category']}}/{{$attribute['id']}}" target='_blank'>{{$attribute['title']}}</a>
                                         </td>
                                        <td class="center">{{$attribute['qty']}}</td>
                                        <td class="center">{{$attribute['params']}}</td>
                                        <td class="center">{{$attribute['price']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        {{--/Modal--}}
                @endforeach
    <div id="token" style="display: none">{{csrf_token()}}</div>
    {{--<script>
        $(function(){
            var oTable1 = $('#sample-table-2').dataTable( {
                "aaSorting": [[4,'desc']],
                "aoColumns": [
                    { "bSortable": false },
                    null,null,null, null,null,null,
                    { "bSortable": false }
                ] } );
        });
    </script>--}}
@stop