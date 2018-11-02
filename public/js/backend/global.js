
$(function(){
    var fieldsString = $('input[name="fields"]').val();
    if(!fieldsString || fieldsString == ''){
        var fields = {
            base: [],
            attributes:{}
        };
    }
    else{
        var fields = JSON.parse(fieldsString);
    }
    console.log('var fields == ', fields);
    //Функция формирования таблицы
    function addAttributesRow(title, data){
        console.info('FUNC addAttributesRow(title, data)', arguments);

        //Определение состояния checkbox активности
        var checkBoxActive = '';
        if(data.active){
            checkBoxActive = '<span class="badge badge-success"><i class="icon-ok bigger-120"></i></span>';
        }else{
            checkBoxActive = '<span class="badge badge-important"><i class="icon-remove"></i></span>';
        }

        //Определение состояния checkbox мультиязычности
        var checkBoxLangActive = '';
        if(data.lang_active){
            checkBoxLangActive = '<span class="badge badge-success"><i class="icon-ok bigger-120"></i></span>';
        }else{
            checkBoxLangActive = '<span class="badge badge-important"><i class="icon-remove"></i></span>';
        }

        //добавление строки с параметрами в таблицу Аттрибутов
        $('#attributes-list tbody').append('' +
            '<tr data-id-row="' + title + '">' +
                '<td class="center">' + data['publick_name'] + '</td>' +
                '<td class="center">' + title + '</td>' +                
                '<td class="center">' + data['type'] + '</td>' +
                '<td class="center">' + checkBoxLangActive + '</td>' +
                '<td class="center">' + checkBoxActive + '</td>' +
                '<td class="center">' +
                    '<div class="hidden-phone visible-desktop action-buttons">' +
                        '<a href="#collapseOne" data-id="' + title + '" data-parent="#accordion2" data-toggle="collapse" class="edit-attribute green accordion-toggle collapsed"><i class="icon-pencil bigger-130"></i></a>' +
                        '<a class="red delete-attribute" href="#" data-id="' + title + '"><i class="icon-trash bigger-130"></i></a>' +
                    '</div>' +
                    '<div class="hidden-desktop visible-phone">' +
                        '<div class="inline position-relative">' +
                            '<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">' +
                            '<i class="icon-caret-down icon-only bigger-120"></i>' +
                            '</button>' +
                            '<ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">' +
                                '<li>' +
                                    '<a href="#" class="tooltip-success" data-rel="tooltip" title="" data-original-title="Edit"><span class="green"><i class="icon-edit bigger-120"></i></span></a>' +
                                '</li>' +
                                '<li>' +
                                    '<a href="#" class="tooltip-error" data-rel="tooltip" id="delete" data-id='+title+' title="" data-original-title="Delete"><span class="red"><i class="icon-trash bigger-120"></i></span></a>' +
                                '</li>' +
                            '</ul>' +
                        '</div>' +
                    '</div>' +
                '</td> ' +
            '</tr>');
    }
    //Функция инициализации базовых аттрибутов
    function renderBaseAttributes(){
        var base = fields.base.length;
        if(base != 0) {
            for(var key in fields.base){
                var item = fields.base[key];
                var check_fields_base = $('#sample-table-1 input[name='+item+']').prop('checked',true);
                //console.log('Список чекнутых полей=>', check_fields_base);
            }
        }
    }
    //Функция отрисовки таблицы
    function renderAttributesTable(){
        renderBaseAttributes();
        //console.info('FUNC renderAttributesTable()', arguments);
        $('#attributes-list tbody').html('');
        for(var title in fields.attributes){
            var data = fields.attributes[title];
            addAttributesRow(title, data);
        }
        $('input[name="fields"]').val(JSON.stringify(fields));//запись в поле fields значений attributes

/*Delete attributes*/
        $('.delete-attribute').on('click',function(event){
            event.preventDefault();
            var title_delete = $(this).attr('data-id');
            delete fields.attributes[title_delete];
            $('tr[data-id-row = "' + title_delete + '"]').fadeOut(300);
            $('input[name="fields"]').val(JSON.stringify(fields));//запись в поле fields значений attributes
            //console.log('Після видалення ==>', fields.attributes);
        });
/*/Delete attributes*/

/*Edit attributes*/
        $('.edit-attribute').on('click',function(event){            
            event.preventDefault();
            $('#label-add').hide();
            $('#label-edit').show();         
            var title = $(this).attr('data-id');
            var data = fields.attributes[title];
            $('#modal-table-attributes input[name=title]').val(title);
            $('#modal-table-attributes input[name=publick_name]').val(data.publick_name);
            $('#modal-table-attributes select option[value='+data.type+']').prop('selected', true);
            $('#modal-table-attributes input[name=lang_active]').prop('checked',data.lang_active);
            $('#modal-table-attributes input[name=active]').prop('checked',data.active);
            console.log('Ключ ==>', title);
            console.log('PЗначення по ключу', data);
            //сворачивание формы добавления аттрибутов после успешного добавления
            $('div#collapseOne').removeClass("in").css("height",'0px');
        });
/*/Edit attributes*/
    }
    renderAttributesTable();//Отрисовка таблицы

/*Add new attributes*/
    $('.resource-add-attribute').on('click', function(event){
        event.preventDefault();
        $('#label-add').show();
        $('#label-edit').hide();
        var serializedData = $('form#resource-form-attributes').serializeArray();
        var data = {};
        //console.log("Масив серіалізе", serializedData);
        for(var key in serializedData){
            var item = serializedData[key];
            data[item['name']] = item['value'];
        }
        // delete fields.attributes[data['title']];
        if(data['title'] == ''){
            swal('Поле: Название атрибута обязательно для заполнения');
        }
        else{
            fields.attributes[data['title']] = {
                publick_name: data['publick_name'],
                type: data['type'],
                lang_active: parseInt(data['lang_active']) ? true : false,
                active: parseInt(data['active']) ? true : false
            };
            //сброс данніх в форме добавления аттрибутов
            $("#resource-form-attributes").trigger("reset");
            //сворачивание формы добавления аттрибутов после успешного добавления
            $('div#collapseOne').removeClass("in").css("height",'0px');
            renderAttributesTable();//Отрисовка таблицы
        }

        //console.log('serializedData:', serializedData);
        //console.log('data:', data);
        //console.log('fields:', fields);

    });
/*/Add new attributes*/

/*Save Category*/
    $('.resource-save-category').on('click', function(event){
        get_wysiwyg();
        fields.base = [];
        // create arr[] checked checkbox elements
       $('#sample-table-1 input:checked').each(function(){
            fields.base.push($(this).attr('name'));
       });
        $('#fields').val(JSON.stringify(fields));
        var attr_list = $('#attr-list').serializeArray();
        console.log(attr_list);

        var data = new FormData($('form#resource-form-category')[0]);
           /* var data = $('form#resource-form-category').serialize();
            var $input = $("#uploadimage");
            var fd = new FormData();
            fd.append('img', $input.prop('files')[0]);*/
        console.log(data);
        $.ajax({
            url: '',
            method: "POST",
            processData: false,
            contentType: false,
            data: data,
            dataType : "json",
            success: function(data){
                console.info('Server response: ', data);
                if(data.status == 'success'){
                    alert(data.message);
                }else{
                    alert('Ошибка: ' + data.message)
                }

                if(data.redirect){
                     document.location = data.redirect;
                }
                if(data.status == 'fail'){
                    alert(data.message);
                }
            },
            error: function(data, type, details){
                console.info('Server error: ', arguments);

                var message = 'Ошибка сохранения:\n';
                if(data.responseJSON){
                    for(var key in data.responseJSON){
                        message += data.responseJSON[key] + '\n';
                    }
                }else{
                    message += details;
                }

                alert(message);
            }
        },"json");
        event.preventDefault();

    });
/*/Save Category*/
/*Delete Category*/
    $('.category-delete').on('click', function(event){
        event.preventDefault();
        if(confirm('Вместе с категорией будут удаделены все записи в ней. Вы уверенны?')){
            var $thisEl = $(this);
            var id = $(this).attr('data-id');
            $.ajax({
                url: $thisEl.attr('href'),
                method: "POST",
                data: {
                    '_method': 'Delete',
                    '_token' : $('#token').text(),
                    'id': id
                },
                success: function(data){
                    console.info('Server response: ', data);
                    if(data.status == 'success'){

                    }
                    if(data.redirect){
                        document.location = data.redirect;
                    }
                    if(data.status == 'fail'){
                        alert(data.message);
                    }
                    alert(data.message);
                }
            })
        }
        });
/*/Delete Category/
/*Delete Article*/
    $('.resource-delete').on('click', function(event){
        console.log("Я тут");
        if(confirm('Вы уверены?')){
            var $thisEl = $(this);
            $.ajax({
                url: $thisEl.attr('href'),
                method: "POST",
                data: {
                    '_method': 'Delete',
                    '_token' : $('#token').text()
                },
                success: function(data){
                    console.info('Server response: ', data);
                    if(data.status == 'success'){
                        $thisEl.parents('tr').fadeOut(3000);
                    }
                    alert(data.message);
                }
            })
        }
        event.preventDefault();

    });
/*/Delete Article*/

/*Save Article*/
    $('.resource-save').on('click', function(event){
        //alert('tut');
        get_wysiwyg();
        var data = new FormData($('form#resource-form')[0]);

        //console.info('Data to send', data.getAll());
        //return false;
        /*var data = $('form#resource-form').serialize();*/
        // var $thisEl = $(this);
        //console.log(data);
        $.ajax({
            url: '',
            method: "POST",
            processData: false,
            contentType: false,
            data: data,
            dataType : "json",
            success: function(data){
                console.info('Server response: ', data);
                if(data.status == 'success'){
                    alert(data.message);
                }else{
                    alert('Ошибка: ' + data.message)
                }

                if(data.redirect){
                   document.location = data.redirect;
                }
                if(data.status == 'fail'){
                    alert(data.message);
                }
            },
            error: function(data, type, details){
                console.info('Server error: ', arguments);

                var message = 'Ошибка сохранения:\n';
                if(data.responseJSON){
                    for(var key in data.responseJSON){
                        message += data.responseJSON[key] + '\n';
                    }
                }else{
                    message += details;
                }

                alert(message);
            }
        });
        event.preventDefault();

    });
/*/Save Article*/
/*show-hide image in category*/
    $('.image-close, .image-edit').on('click', function(event){
        //alert('тут');
        event.preventDefault();
        $('input[name=img_status]').prop('value', false);


        $(this).parents('.control-group').find('.show-image').hide();
        $(this).parents('.control-group').find('.show-image input[type=hidden]').removeAttr('value');
        $(this).parents('.control-group').find('.image-upload').show();
        //$('#show-image').hide();
        //$('#image-upload').show();
    });
/*show-hide image in category*/
    init_wysiwyg();  
    
/* get list articles for parent article */
    $('select[data-name=article_parent]').on('change', function(){
        $('select[name=article_id_2]').empty();
 
        var data = {};
        
        id = $(this).val();
        var token = $('#token').text();
        console.log('ID=====>', id );
        $.ajax({
            url: '',
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': token              
            }, 
            processData: false,
            contentType: false,
            data: 'id=' + id,
            dataType : "json",
            success: function(data){
                console.log('Server response: ', data);
                if(data.status == 'success'){
                    console.log(data.articles);
                    $.each(data.articles, function(key, element) {
                        $('select[name=article_id_2]').append($("<option></option>")
                        .attr("value",element['id'])
                        .text(JSON.parse(element['title']).ru));
                    });
                }

                // if(data.redirect){
                //      document.location = data.redirect;
                // }
                // if(data.status == 'fail'){
                //     alert(data.message);
                // }
            },
            error: function(data, type, details){
                console.info('Server error: ', arguments);

                var message = 'Ошибка сохранения:\n';
                if(data.responseJSON){
                    for(var key in data.responseJSON){
                        message += data.responseJSON[key] + '\n';
                    }
                }else{
                    message += details;
                }

                alert(message);
            }
        },"json");

    })
/* /get list articles for parent article */

/* get list seassons for hotel */
$('select[data-name=hotel_list]').on('change', function(){
    //$('select[name=article_id_2]').empty();
    var data = {};
    id = $(this).val();
    var token = $('#token').text();
    console.log('ID=====>', id );
    $.ajax({
        url: '',
        method: "GET",
        headers: {
            'X-CSRF-TOKEN': token              
        }, 
        processData: false,
        contentType: false,
        data: 'id=' + id,
        dataType : "json",
        success: function(data){
            console.log('Server response: ', data);
            if(data.status == 'success'){
                var typePage = data.type;
                //var articleName =  $( "select[data-name=hotel_list] option:selected" ).text();
                console.log(data.articles);
                $("#sample-table-2 tbody tr td").remove(); 
                
                $.each(data.articles, function(key, article) {
                    console.log('iter', article);
                    article.attributes = $.parseJSON(article.attributes);
                    article.title = $.parseJSON(article.title);
                    if(article.article_parent) {
                        article.article_parent.title = $.parseJSON(article.article_parent.title);
                        article.article_parent.attributes = $.parseJSON(article.article_parent.attributes);
                    }
                    if(article.parent_hotel) article.parent_hotel = $.parseJSON(article.parent_hotel);
                    if(article.article_parent_price) {
                        article.article_parent_price.title = $.parseJSON(article.article_parent_price.title);
                        article.article_parent_price.attributes = $.parseJSON(article.article_parent_price.attributes);
                    }
                    var renderTable;
                    switch(typePage){
                        case 'prices' : renderTable = renderPricesList(article);
                        break;
                        case 'seasons' : renderTable = renderSeasonsList(article);
                        break;
                    }
                    console.log('attributes', article.attributes);
                    //console.log('Удаленная строка', delete_row);
                    $('#sample-table-2 tbody').append($(
                        renderTable    
                    ));
                });
            }

            // if(data.redirect){
            //      document.location = data.redirect;
            // }
            // if(data.status == 'fail'){
            //     alert(data.message);
            // }
        },
        error: function(data, type, details){
            console.info('Server error: ', arguments);

            var message = 'Ошибка сохранения:\n';
            if(data.responseJSON){
                for(var key in data.responseJSON){
                    message += data.responseJSON[key] + '\n';
                }
            }else{
                message += details;
            }

            alert(message);
        }
    },"json");

})
/* /get list seassons for hotel */
});

function init_wysiwyg(){
    var id = '';
    var editors = $('textarea');
    editors.each(function(i, editor){
        if(!$(this).hasClass('no-wysiwyg')) {
            $(editor).attr('id', 'textarea-wysiwyg-' + i);
            CKEDITOR.replace('textarea-wysiwyg-' + i);
        }
    });
}

function get_wysiwyg(){
    var id = '';
    var editors = $('textarea');
    editors.each(function(i, editor){
        if(!$(this).hasClass('no-wysiwyg')){
            id = $(editor).attr('id');
            if(id && CKEDITOR.instances[id]) {
                $('#' + id).val(CKEDITOR.instances[id].getData());
            }
        }

    });
}
function renderSeasonsList(article){
    var active = '';
        if(article.active){
            active = '<span class="badge badge-success"><i class="icon-ok bigger-120"></i></span>';
        }
        else{
            active = '<span class="badge badge-important"><i class="icon-remove"></i></span>';
        };
        var delete_row = '';
        if(article.attributes.base_season == 0){
            delete_row = ' <a href=' + window.location.pathname + '/' + article.id + ' data-id='+ article.id +' class="resource-delete">' +
            '<i class="icon-trash bigger-130"></i>' +
            '</a>'

        }

    var table = '<tr>' +
    '<td class="center">' +
        '<label>' +
            '<span class="lbl">'+ article.id +'</span>' +
        '</label>' +
    '</td>' +
    '<td>' + 
        article.article_parent.title.ru +    
    '<td>' +
        '<a href="' + window.location.pathname + '/' + article.id + '">'+ article.title.ru +'</a>' +
    '</td>' +
    '<td  class="center">' + article.date_start + '</td>' +
    '<td  class="center">' + article.date_finish + '</td>' +
    '<td  class="center">' + article.attributes.season_year + '</td>' +
    '<td class="center">' +
        active +  
    '</td>' +
    '<td class="td-actions">' +
        '<div class="hidden-phone visible-desktop action-buttons">' +
            '<a class="green" href="' + window.location.pathname + '/' + article.id + '">' +
                '<i class="icon-pencil bigger-130"></i>' +
            '</a>' +
            delete_row + 
        '</div>' +

        '<div class="hidden-desktop visible-phone">' +
            '<div class="inline position-relative">' +
                '<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">' +
                '<i class="icon-caret-down icon-only bigger-120"></i>' +
                '</button>' +

                '<ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">' +
                    '<li>' +
                        '<a href="' + window.location.pathname + '/' + article.id + '>" class="tooltip-info" data-rel="tooltip" title="View">' +
                    '<span class="blue">' +
                    '<i class="icon-zoom-in bigger-120"></i>' +
                    '</span>' +
                    '</a>' +
                    '</li>' +

                    '<li>' +
                        '<a href="' + window.location.pathname + '/' + article.id + '>" class="tooltip-success" data-rel="tooltip" title="Edit">' +
                    '<span class="green">' +
                    '<i class="icon-edit bigger-120"></i>' +
                    '</span>' +
                    '</a>' +
                    '</li>' +
                    delete_row + 
                '</ul>' +
            '</div>' +
        '</div>' +
    '</td>'+
'</tr>'
return table;

}
function renderPricesList(article){
    var active = '';
    if(article.active){
        active = '<span class="badge badge-success"><i class="icon-ok bigger-120"></i></span>';
    }
    else{
        active = '<span class="badge badge-important"><i class="icon-remove"></i></span>';
    };
    var delete_row = '';
    if(article.article_parent && article.article_parent.attributes.base_season == 0){
        delete_row = ' <a href=' + window.location.pathname + '/' + article.id + ' data-id='+ article.id +' class="resource-delete">' +
        '<i class="icon-trash bigger-130"></i>' +
        '</a>'

    }
    console.log(' DELETE', delete_row);
    var roomName = (article.article_parent_price) ? article.article_parent_price.title.ru : '';

    var table = '<tr>' +
    '<td class="center">' +
        '<label>' +
            '<span class="lbl">'+ article.id +'</span>' +
        '</label>' +
    '</td>' +
    '<td>' + article.article_parent.title.ru + '</td>' +
    '<td>' + article.parent_hotel.ru + '</td>' +
    '<td  class="center">' + roomName + '</td>' +
    '<td  class="center">' + article.attributes.base_price + '</td>' +
    '<td  class="center">' + article.attributes.surchange + '</td>' +
    '<td class="center">' + article.attributes.surchange_children + '</td>' +
    '<td class="center">' + article.attributes.solo_settle + '</td>' +
    '<td class="center">' + active + '</td>' +

    '<td class="td-actions">' +
        '<div class="hidden-phone visible-desktop action-buttons">' +
            '<a class="green" href="' + window.location.pathname + '/' + article.id + '">' +
                '<i class="icon-pencil bigger-130"></i>' +
            '</a>' +
            delete_row + 
        '</div>' +

        '<div class="hidden-desktop visible-phone">' +
            '<div class="inline position-relative">' +
                '<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">' +
                '<i class="icon-caret-down icon-only bigger-120"></i>' +
                '</button>' +

                '<ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">' +
                    '<li>' +
                        '<a href="' + window.location.pathname + '/' + article.id + '>" class="tooltip-info" data-rel="tooltip" title="View">' +
                    '<span class="blue">' +
                    '<i class="icon-zoom-in bigger-120"></i>' +
                    '</span>' +
                    '</a>' +
                    '</li>' +

                    '<li>' +
                        '<a href="' + window.location.pathname + '/' + article.id + '>" class="tooltip-success" data-rel="tooltip" title="Edit">' +
                    '<span class="green">' +
                    '<i class="icon-edit bigger-120"></i>' +
                    '</span>' +
                    '</a>' +
                    '</li>' +
                    delete_row + 
                '</ul>' +
            '</div>' +
        '</div>' +
    '</td>'+
'</tr>'
return table;

}

