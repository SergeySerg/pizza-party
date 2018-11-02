<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админ.панель</title>

    <link rel="shortcut icon" href="{{ asset('/img/favicon/favicon.png') }}?1" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('/img/favicon/apple-touch-icon.png') }}?1">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon/apple-touch-icon-72x72.png') }}?1">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/img/favicon/apple-touch-icon-114x114.png') }}?1">

    <!--basic styles-->
    <link href="{{ asset('/css/backend/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/bootstrap-responsive.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/font-awesome.min.css') }}" rel="stylesheet">
    <!--Тестовый css-->
    <link href="{{ asset('/css/backend/backend.css') }}" rel="stylesheet">
    <!--Sweetalert css-->
    <link href="{{ asset('/css/plugins/sweetalert.css') }}" rel="stylesheet">
    <!--[if IE 7]>
    <link href="{{ asset('/css/backend/font-awesome-ie7.min.css') }}" rel="stylesheet">
    <![endif]-->

    <!--page specific plugin styles-->

    <link href="{{ asset('/css/backend/jquery-ui-1.10.3.custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/chosen.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/bootstrap-timepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/colorpicker.css') }}" rel="stylesheet">

    <!--basic scripts-->
    <!--js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" type="text/javascript" ></script>


    <!--fonts-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300" type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

    <!--ace styles-->
    <link href="{{ asset('/css/backend/ace.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/ace-responsive.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/backend/ace-skins.min.css') }}" rel="stylesheet">
    <!--Font Awesome CDN-->

    <link rel="stylesheet" href="{{ asset('/libs\font-awesome-4.7.0\css\font-awesome.min.css') }}" >

    <!--[if lte IE 8]>
    <link rel="stylesheet" href="{{ asset('/css/backend/ace-ie.min.css') }} >
    <![endif]-->





    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    <![endif]-->
</head>
<body>
<!--<div class="admin-header">Админ панель</div>
    <div class="categoty-admin">
        <h3>Категории админки</h3>
        <ul class="list-admin">
            <li><a href="/adminorieT3/articles/rooms">Комнаты</a></li>
            <li><a href="/adminorieT3/articles/services">Услуги</a></li>
            <li><a href="/adminorieT3/articles/events">События</a></li>
        </ul>
    </div>-->

<div class="navbar hidden-print">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a href="{{ route('admin_dashboard') }}" class="brand">Велика Ведмедиця
                {{--<i class="icon-leaf"></i>--}}
               {{--<img style="display: block;position: absolute;margin-top: -3px;" width="105px" src="{{ asset('/img/backend/logo.png') }}" alt="{{$_SERVER['HTTP_HOST']}}" />--}}
                {{--<small style="margin-left: 40px;">
                    {{$_SERVER['HTTP_HOST']}}
                </small>--}}
            </a><!--/.brand-->

            <ul class="nav ace-nav pull-right">

                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="{{ asset('/img/backend/avatar.jpg') }}" alt="Admin" />
								<span class="user-info">
									<small>{{ trans('backend.welcome') }},</small>
									{{ Auth::user()->name }}
								</span>

                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
                        <li>
                            <a target="_blank" href="{{ asset('/') }}">
                                <i class="icon-cog"></i>
                                {{ trans('backend.go_to_site') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ url(getSetting('admin.prefix'). '/logout') }}">
                            <i class="icon-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!--/.ace-nav-->
        </div><!--/.container-fluid-->
    </div><!--/.navbar-inner-->
</div>

<div class="main-container container-fluid">
    <a class="menu-toggler" id="menu-toggler" href="#">
        <span class="menu-text"></span>
    </a>

    <div class="sidebar hidden-print" id="sidebar">
        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large">
                {{ trans('backend.menu') }}
            </div>

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>

                <span class="btn btn-info"></span>

                <span class="btn btn-warning"></span>

                <span class="btn btn-danger"></span>
            </div>
        </div><!--#sidebar-shortcuts-->

        <ul class="nav nav-list">
            <li @if( isset($type) && (Request::is('*/'.$type.'') OR Request::is('*/'.$type.'/*'))) class="active open" @endif>
                <a href="#" class="dropdown-toggle">
                    <i class="icon-list"></i>
                    <span class="menu-text"> {{ trans('backend.categories') }} </span>

                    <b class="arrow icon-angle-down"></b>
                </a>
                <!--With submenu-->
                <!-- <ul class="submenu">
                    @foreach($admin_categories as $admin_category)
                        <li @if(Request::is('*/'.$admin_category->link.'') || Request::is('*/'.$admin_category->link.'/*')) class="active" @endif>
                            <a href="{{ $url }}/articles/{{ $admin_category->link }}" @if($admin_category->active == 0) style="color:#e4e1e1" @endif @if($admin_category->category_children->count()) class="dropdown-toggle" @endif >
                                <i class="icon-double-angle-right"></i>
                                {{ $admin_category->getTranslate('title') }}
                                @if($admin_category->category_children->count())
                                    <b class="arrow icon-angle-down"></b>
                                @endif
                            </a>

                            <ul class="submenu">
                                <li>
                                    <a href="{{ $url }}/articles/{{ $admin_category->link }}" @if($admin_category->active == 0) style="color:#e4e1e1" @endif >
                                        {{ $admin_category->getTranslate('title') }}
                                    </a>
                                </li>
                                @foreach($admin_category->category_children as $admin_category_children)
                                <li @if(Request::is('*/'.$admin_category_children->link.'') || Request::is('*/'.$admin_category_children->link.'/*')) class="active" @endif>
                                    <a href="{{ $url }}/articles/{{ $admin_category_children->link }}" @if($admin_category_children->active == 0) style="color:#e4e1e1" @endif @if($admin_category_children->category_children->count()) class="dropdown-toggle" @endif>
                                        {{ $admin_category_children->getTranslate('title') }}
                                        @if($admin_category->category_children->count())
                                            <b class="arrow icon-angle-down"></b>
                                        @endif
                                    </a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="{{ $url }}/articles/{{ $admin_category_children->link }}" @if($admin_category_children->active == 0) style="color:#e4e1e1" @endif >
                                                {{ $admin_category_children->getTranslate('title') }}
                                            </a>
                                        </li>
                                        @foreach($admin_category_children->category_children as $admin_category_children_children)
                                            <li @if(Request::is('*/'.$admin_category_children_children->link.'') || Request::is('*/'.$admin_category_children_children->link.'/*')) class="active" @endif>
                                                <a href="{{ $url }}/articles/{{ $admin_category_children_children->link }}" @if($admin_category_children_children->active == 0) style="color:#e4e1e1" @endif>
                                                    {{ $admin_category_children_children->getTranslate('title') }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>

                        </li>

                    @endforeach
                    @if( (Auth::user()->name) == 'root' )
                        <li>
                            <a href="{{ route('admin_categories_create') }}">
                                <button style="float:left" class="btn btn-small btn-warning">
                                    <i class="icon-plus"></i>
                                    {{ trans('backend.add_category') }}
                                </button>
                            </a>
                        </li>
                    @endif
                </ul> -->
                <ul class="submenu">
                    @foreach($admin_categories_all as $admin_category)
                        <li @if(Request::is('*/'.$admin_category->link.'') || Request::is('*/'.$admin_category->link.'/*')) class="active" @endif>
                            <a href="{{ $url }}/articles/{{ $admin_category->link }}" >
                                <i class="icon-double-angle-right"></i>
                                {{ $admin_category->getTranslate('title') }}                                
                            </a>
                        </li>
                    @endforeach  
                    @if( (Auth::user()->name) == 'root' )
                        <li>
                            <a href="{{ route('admin_categories_create') }}">
                                <button style="float:left" class="btn btn-small btn-warning">
                                    <i class="icon-plus"></i>
                                    {{ trans('backend.add_category') }}
                                </button>
                            </a>
                        </li>
                    @endif  
                </ul>

            </li>


            <li @if(Request::is('*/texts'))class="active"@endif>
                <a href="{{ route('text_index') }}">
                    <i class="icon-list-alt"></i>
                    <span class="menu-text"> {{ trans('backend.texts') }} </span>
                </a>
            </li>

            <li @if(Request::is('*/langs'))class="active"@endif>
                <a href="{{ route('langs_index') }}">
                    <i class="icon-globe"></i>
                    <span class="menu-text"> {{ trans('backend.langs') }} </span>
                </a>
            </li>
            @if( (Auth::user()->name) == 'root' )
                <li @if(Request::is('*/settings'))class="active"@endif>
                    <a href="{{ route('settings_index') }}">
                        <i class="icon-cog"></i>
                        <span class="menu-text"> {{ trans('backend.settings') }} </span>
                    </a>
                </li>
            @endif


        </ul><!--/.nav-list-->

        <div class="sidebar-collapse" id="sidebar-collapse">
            <i class="icon-double-angle-left"></i>
        </div>
    </div>

    <div class="main-content">

        <div class="breadcrumbs hidden-print" id="breadcrumbs">
            <ul class="breadcrumb">
                @yield('breadcrumbs')
            </ul><!--.breadcrumb-->
        </div>
        <!--PAGE CONTENT BEGINS-->

        @yield('content')

        <!--PAGE CONTENT ENDS-->


        <div class="ace-settings-container hidden-print" id="ace-settings-container">
            <div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
                <i class="icon-cog bigger-150"></i>
            </div>

            <div class="ace-settings-box" id="ace-settings-box">
                <div>
                    <div class="pull-left">
                        <select id="skin-colorpicker" class="hide">
                            <option data-class="default" value="#438EB9" />#438EB9
                            <option data-class="skin-1" value="#222A2D" />#222A2D
                            <option data-class="skin-2" value="#C6487E" />#C6487E
                            <option data-class="skin-3" value="#D0D0D0" />#D0D0D0
                        </select>
                    </div>
                    <span>&nbsp; Choose Skin</span>
                </div>

                <div>
                    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" />
                    <label class="lbl" for="ace-settings-header"> Fixed Header</label>
                </div>

                <div>
                    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" />
                    <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                </div>

                <div>
                    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-breadcrumbs" />
                    <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                </div>

                <div>
                    <input type="checkbox" class="ace-checkbox-2" id="ace-settings-rtl" />
                    <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                </div>
            </div>
        </div><!--/#ace-settings-container-->
    </div><!--/.main-content-->
    <div id="token_rate" style="display: none">{{csrf_token()}}</div>
    </div><!--/.main-container-->

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-small btn-inverse hidden-print">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>

<!--basic scripts-->
<!--js-->
<script src="{{ asset('/js/backend/jquery-ui-1.10.3.custom.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/global.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/jquery.slimscroll.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/ckeditor/ckeditor.js') }}"></script>

<!--Bootstrap js-->
<script src="{{ asset('/js/backend/bootstrap.min.js') }}"></script>

<!--page specific plugin scripts-->

<script src="{{ asset('/js/backend/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/js/backend/jquery.dataTables.bootstrap.js') }}"></script>

<!--Для страницы form elements-->

<script src="{{ asset('/js/backend/chosen.jquery.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/fuelux.spinner.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/bootstrap-datepicker.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/bootstrap-timepicker.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/moment.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/daterangepicker.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/bootstrap-colorpicker.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/jquery.knob.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/jquery.autosize-min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/jquery.inputlimiter.1.3.1.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/jquery.maskedinput.min.js') }}"type="text/javascript"></script>
<script src="{{ asset('/js/backend/bootstrap-tag.min.js') }}"type="text/javascript"></script>

<!--ace scripts-->

<script src="{{ asset('/js/backend/ace-elements.min.js') }}"></script>
<script src="{{ asset('/js/backend/ace.min.js') }}"></script>

<!--Sweetalert scripts-->
<script src="{{ asset('/js/plugins/sweetalert.min.js') }}"></script>

{{--JS new--}}
<script src="{{ asset('/js/backend/jquery.ui.touch-punch.min.js') }}"type="text/javascript"></script>

<!--inline scripts related to this page-->

<script type="text/javascript">
    $(function() {



        $('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

        });


        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            var w2 = $source.width();

            if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
            return 'left';
        }
    })
</script>
<!--для Формы-->
<script type="text/javascript">
    $(function() {
        $('#id-disable-check').on('click', function() {
            var inp = $('#form-input-readonly').get(0);
            if(inp.hasAttribute('disabled')) {
                inp.setAttribute('readonly' , 'true');
                inp.removeAttribute('disabled');
                inp.value="This text field is readonly!";
            }
            else {
                inp.setAttribute('disabled' , 'disabled');
                inp.removeAttribute('readonly');
                inp.value="This text field is disabled!";
            }
        });


        $(".chzn-select").chosen();

        $('[data-rel=tooltip]').tooltip({container:'body'});
        $('[data-rel=popover]').popover({container:'body'});

        $('textarea[class*=autosize]').autosize({append: "\n"});
        $('textarea[class*=limited]').each(function() {
            var limit = parseInt($(this).attr('data-maxlength')) || 100;
            $(this).inputlimiter({
                "limit": limit,
                remText: '%n character%s remaining...',
                limitText: 'max allowed : %n.'
            });
        });

        $.mask.definitions['~']='[+-]';
        $('.input-mask-date').mask('99/99/9999');
        $('.input-mask-phone').mask('(999) 999-9999');
        $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
        $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});



        $( "#input-size-slider" ).css('width','200px').slider({
            value:1,
            range: "min",
            min: 1,
            max: 6,
            step: 1,
            slide: function( event, ui ) {
                var sizing = ['', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
                var val = parseInt(ui.value);
                $('#form-field-4').attr('class', sizing[val]).val('.'+sizing[val]);
            }
        });

        $( "#input-span-slider" ).slider({
            value:1,
            range: "min",
            min: 1,
            max: 11,
            step: 1,
            slide: function( event, ui ) {
                var val = parseInt(ui.value);
                $('#form-field-5').attr('class', 'span'+val).val('.span'+val).next().attr('class', 'span'+(12-val)).val('.span'+(12-val));
            }
        });


        $( "#slider-range" ).css('height','200px').slider({
            orientation: "vertical",
            range: true,
            min: 0,
            max: 100,
            values: [ 17, 67 ],
            slide: function( event, ui ) {
                var val = ui.values[$(ui.handle).index()-1]+"";

                if(! ui.handle.firstChild ) {
                    $(ui.handle).append("<div class='tooltip right in' style='display:none;left:15px;top:-8px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>");
                }
                $(ui.handle.firstChild).show().children().eq(1).text(val);
            }
        }).find('a').on('blur', function(){
            $(this.firstChild).hide();
        });

        $( "#slider-range-max" ).slider({
            range: "max",
            min: 1,
            max: 10,
            value: 2
        });

        $( "#eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
            // read initial values from markup and remove that
            var value = parseInt( $( this ).text(), 10 );
            $( this ).empty().slider({
                value: value,
                range: "min",
                animate: true

            });
        });


        $('#id-input-file-1 , #id-input-file-2').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change',
            droppable:false,
            onchange:null,
            thumbnail:false //| true | large
            //whitelist:'gif|png|jpg|jpeg'
            //blacklist:'exe|php'
            //onchange:''
            //
        });

        $( "input:file" ).ace_file_input({
            style:'well',
            btn_choose:'Drop files here or click to choose',
            btn_change:null,
            no_icon:'icon-cloud-upload',
            droppable:true,
            thumbnail:'small'
            //,icon_remove:null//set null, to hide remove/reset button
            /**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
            /**,before_remove : function() {
						return true;
					}*/
            ,
            preview_error : function(filename, error_code) {
                //name of the file that failed
                //error_code values
                //1 = 'FILE_LOAD_FAILED',
                //2 = 'IMAGE_LOAD_FAILED',
                //3 = 'THUMBNAIL_FAILED'
                //alert(error_code);
            }

        }).on('change', function(){
            //console.log($(this).data('ace_input_files'));
            //console.log($(this).data('ace_input_method'));
        });


        //dynamically change allowed formats by changing before_change callback function
        $('#id-file-format').removeAttr('checked').on('change', function() {
            var before_change
            var btn_choose
            var no_icon
            if(this.checked) {
                btn_choose = "Drop images here or click to choose";
                no_icon = "icon-picture";
                before_change = function(files, dropped) {
                    var allowed_files = [];
                    for(var i = 0 ; i < files.length; i++) {
                        var file = files[i];
                        if(typeof file === "string") {
                            //IE8 and browsers that don't support File Object
                            if(! (/\.(jpe?g|png|gif|bmp)$/i).test(file) ) return false;
                        }
                        else {
                            var type = $.trim(file.type);
                            if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif|bmp)$/i).test(type) )
                                    || ( type.length == 0 && ! (/\.(jpe?g|png|gif|bmp)$/i).test(file.name) )//for android's default browser which gives an empty string for file.type
                            ) continue;//not an image so don't keep this file
                        }

                        allowed_files.push(file);
                    }
                    if(allowed_files.length == 0) return false;

                    return allowed_files;
                }
            }
            else {
                btn_choose = "Drop files here or click to choose";
                no_icon = "icon-cloud-upload";
                before_change = function(files, dropped) {
                    return files;
                }
            }
            var file_input = $('#id-input-file-3');
            file_input.ace_file_input('update_settings', {'before_change':before_change, 'btn_choose': btn_choose, 'no_icon':no_icon})
            file_input.ace_file_input('reset_input');
        });




        $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
                .on('change', function(){
                    //alert(this.value)
                });
        $('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, icon_up:'icon-caret-up', icon_down:'icon-caret-down'});
        $('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, icon_up:'icon-plus', icon_down:'icon-minus', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});



        $('.date-picker').datepicker().next().on(ace.click_event, function(){
            $(this).prev().focus();
        });
        $('#id-date-range-picker-1').daterangepicker().prev().on(ace.click_event, function(){
            $(this).next().focus();
        });

        $('#timepicker1').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false
        })

        $('#colorpicker1').colorpicker();
        $('#simple-colorpicker-1').ace_colorpicker();


        $(".knob").knob();


        //we could just set the data-provide="tag" of the element inside HTML, but IE8 fails!
        var tag_input = $('.form-field-tags');
        if(! ( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase())) )
            tag_input.tag({placeholder:tag_input.attr('placeholder')});
        else {
            //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
            tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
            //$('#form-field-tags').autosize({append: "\n"});
        }


        /////////
        $('#modal-form input[type=file]').ace_file_input({
            style:'well',
            btn_choose:'Drop files here or click to choose',
            btn_change:null,
            no_icon:'icon-cloud-upload',
            droppable:true,
            thumbnail:'large'
        })

        //chosen plugin inside a modal will have a zero width because the select element is originally hidden
        //and its width cannot be determined.
        //so we set the width after modal is show
        $('#modal-form').on('show', function () {
            $(this).find('.chzn-container').each(function(){
                $(this).find('a:first-child').css('width' , '200px');
                $(this).find('.chzn-drop').css('width' , '210px');
                $(this).find('.chzn-search input').css('width' , '200px');
            });
        })
        /**
         //or you can activate the chosen plugin after modal is shown
         //this way select element has a width now and chosen works as expected
         $('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
         */

    });
</script>
<!--Для формы переключения языков-->
<script type="text/javascript">
    $(function() {

        $('#simple-colorpicker-1').ace_colorpicker({pull_right:true}).on('change', function(){
            var color_class = $(this).find('option:selected').data('class');
            var new_class = 'widget-header';
            if(color_class != 'default')  new_class += ' header-color-'+color_class;
            $(this).closest('.widget-header').attr('class', new_class);
        });


        // scrollables
        $('.slim-scroll').each(function () {
            var $this = $(this);
            $this.slimScroll({
                height: $this.data('height') || 100,
                railVisible:true
            });
        });




        // Portlets (boxes)
        $('.widget-container-span').sortable({
            connectWith: '.widget-container-span',
            items:'> .widget-box',
            opacity:0.8,
            revert:true,
            forceHelperSize:true,
            placeholder: 'widget-placeholder',
            forcePlaceholderSize:true,
            tolerance:'pointer'
        });

    });
</script>
<!-- Scripts -->
{{--JS new--}}
</body>
</html>
