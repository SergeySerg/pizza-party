
jQuery(function ($) {
     /* Custom flexweb */
        var total_cart_my = localStorage.getItem("total_cart") || 0;
        var total_price_my = localStorage.getItem("total_price") || 0;
        // console.log('Локал загрузка',total_cart_my);
        // console.log('Локал загрузка', total_price_my);

        
        var token = $("input[name='csrf-token']").val(); 
        var lang =  $("input[name='lang']").val();

     var cart_my = JSON.parse(localStorage.getItem("cart")) || [];
     
     if(cart_my.length == 0){
        //alert('nen');
        localStorage.removeItem("total_cart");
        localStorage.removeItem("total_price");
        $("div#order_process").hide();
        $("div#order_empty").removeClass('hidden');
        $('#total_cart').text(0);
        $('#total_price').text(0);
    }else{
        $('#total_cart').text(total_cart_my);
        $('#total_price').text(total_price_my);
    }
    //Add product to cart and write to localStorage 
    // $('.add_to_cart').click(function(e){
    jQuery(document).on('click touch', '.add_to_cart', function () {
        // alert('Nen');
        //var button_add_cart = $('.item_button_done').addClass('done')
        var check_price = $(this).attr('data-price');
        var check_id = $(this).attr('data-id');
        var check_size = $(this).attr('data-size');
        var check_weight = $(this).attr('data-weight');
        var check_category = $(this).attr('data-category');
        // console.log('Корзина',cart_my);
        total_cart_my ++;
        total_price_my = +total_price_my + +check_price;
        var data = {
            id: check_id,
            size: check_size,
            weight: check_weight,
            price: check_price,
            category: check_category
        }
        cart_my.push(data);

        // console.log('Корзина',cart_my);
        // console.log('total_cart', total_cart_my);
        // console.log('total_price', total_price_my);

        jQuery('#total_cart').text(total_cart_my);
        jQuery('#total_price').text(total_price_my);

        // console.log('Цена',check_price);
        // console.log('ID',check_id);
        // console.log('Size',check_size);
        // console.log('weight',check_weight);

            localStorage.setItem("total_cart", total_cart_my);
            localStorage.setItem("total_price", total_price_my);
            localStorage.setItem("cart", JSON.stringify(cart_my));
        



        var $button_parent = jQuery(this).parents('.item_button').first();
        $button_parent.find('.item_button_done').addClass('done');
        setTimeout(function(){
            $button_parent.find('.item_button_done').removeClass('done');
        },7000);

        //addToCart( jQuery(this) );
        return false;
    });
    
    //write to localStorage cart
    if(window.location.href.indexOf("cart") > -1  && cart_my.length >= 1) {
       console.log('В корзини', cart_my);
        var data_to_server = {
            order: cart_my
        }
        $.ajax({
            url: '/get_articles',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: data_to_server,
            dataType: "json",
            success: function (response) {
                if (response.success) {
            
                    var products = response.data;
                    $('.cart_totals_price, #total_price').text(response.total_sum);
                    $('#total_cart').text(response.total_count);

                    $.each( products, function( key, product ) {
                        if(JSON.parse(product.id)){
                            html = '<tr id="cart_row_' + JSON.parse(product.id) + '" >' +
                            '<td class="mdl-data-table__cell--non-numeric cart_img">' +
                                '<div class="cart_img_block" style="background: url(' + JSON.parse(product.img) + ') 50% 50% no-repeat;-webkit-background-size: contain;background-size: contain;"></div>' +
                            '</td>' +
                            '<td class="mdl-data-table__cell--non-numeric cart_product">'+
                                '<h3>' + JSON.parse(product.title)[lang] + '</h3>'+
                                JSON.parse(product.short_description)[lang] +
                            '</td>'+
                            '<td class="cart_break"></td>';
    
                            if(JSON.parse(product.size) && JSON.parse(product.category_id) == 1 ){
                                html += '<td data-id=' + JSON.parse(product.id)+ ' class="mdl-data-table__cell--non-numeric cart_info_td"><span>' + JSON.parse(product.size) + ' см</span> <span>' + JSON.parse(product.weight) + ' гр</span> </td>';
        
                            }
                            else if(JSON.parse(product.size) && JSON.parse(product.category_id) == 4 ){
                                switch(JSON.parse(product.size)){
                                    case ('pint'): 
                                        html += '<td data-id=' + JSON.parse(product.id)+ ' class="mdl-data-table__cell--non-numeric cart_info_td"><span> 0.5 л</span></td>';
                                    break;
                                    case ('liter'): 
                                        html += '<td data-id=' + JSON.parse(product.id)+ ' class="mdl-data-table__cell--non-numeric cart_info_td"><span> 1 л</span></td>';
                                    break;
                                }
                            }
                            else{
                                html += '<td data-id=' + JSON.parse(product.id)+ ' class="mdl-data-table__cell--non-numeric cart_info_td"><span>' + JSON.parse(product.weight) + ' гр</span> </td>';
                            }
                            html += '<td class="mdl-data-table__cell--non-numeric cart_num_td">'+
                                    '<div class="cart_num" data-size=' + JSON.parse(product.size) + ' data-id=' + JSON.parse(product.id)+ ' data-weight=' + JSON.parse(product.weight)+ ' data-price=' + JSON.parse(product.price) + ' data-category=' + JSON.parse(product.category)+ '>'+
                                        '<div class="cart_num_plus">'+
                                            '<button class="mdl-button mdl-js-button mdl-button--icon cart_num_plus_btn">'+
                                                '<i class="material-icons">add</i>'+
                                            '</button>'+
                                        '</div>'+
                                        '<div class="cart_num_curr">' + JSON.parse(product.qty) +'</div>'+
                                        '<div class="cart_num_minus">'+
                                            '<button class="mdl-button mdl-js-button mdl-button--icon cart_num_minus_btn">'+
                                                '<i class="material-icons">remove</i>'+
                                            '</button>'+
                                        '</div>'+
                                    '</div>'+
                                '</td>'+
                                '<td class="mdl-data-table__cell--non-numeric cart_price_td">'+
                                    '<span>'+
                                        '<span class="price" id="cart_price_' + JSON.parse(product.id)+ '">' + JSON.parse(product.qty) * JSON.parse(product.price) + '</span> грн'+
                                    '</span>'+
                                '</td>'+
                                '<td class="mdl-data-table__cell--non-numeric cart_delete_td">'+
                                    '<button class="mdl-button mdl-js-button mdl-button--icon cart_remove_btn" data-size=' + JSON.parse(product.size) + ' data-id=' + JSON.parse(product.id)+ ' data-weight=' + JSON.parse(product.weight) + ' data-category-id=' + JSON.parse(product.category_id) + ' data-number=' + JSON.parse(product.number_id) + '>'+
                                        '<i class="material-icons">clear</i>'+
                                    '</button>'+
                                '</td>'+
                            '</tr>'
                                $('tbody').append(html);
                                //console.log('язик', JSON.parse(product.title)[lang] );
                                
                            //};
                   

                        }
                           
                      });
                }
                else {
                    alert('Ошибка получения продуктов');
                }
            },
            error: function (data) {
                alert('Серверная ошибка');
            }

        });  
    }
    jQuery(document).on('click touch', '.cart_remove_btn', function () {
        var current_id = $(this).attr('data-id');
        var current_size = $(this).attr('data-size');
        var current_weight = $(this).attr('data-weight');
        var current_qty = $(this).parents('tr').find('.cart_num_curr').text();
        var current_sum = $(this).parents('tr').find('.price').text();
        var current_total_sum_bottom = $('.cart_totals_price').text();
        var current_total_sum_top = $('#total_price').text();
        var current_total_qty = $('#total_cart').text();

        $('.cart_totals_price').text(current_total_sum_bottom - current_sum);
        $('#total_price').text(current_total_sum_top - current_sum);
        $('#total_cart').text(current_total_qty - current_qty);

        //$('#total_price').text()
        $(this).parents('tr').remove();
        var current_cart = JSON.parse(localStorage.getItem("cart"));
        var current_total_cart_qty = JSON.parse(localStorage.getItem("total_cart"));
        var current_total_price = JSON.parse(localStorage.getItem("total_price"));
        for(var i = current_cart.length - 1; i >= 0; i--) {
            if(current_cart[i].id === current_id && (current_cart[i].size === current_size || current_cart[i].weight === current_weight)) {
                current_cart.splice(i, 1);
            }
        }      
            
          
        console.log('ДО запису', current_cart);
        localStorage.setItem("cart", JSON.stringify(current_cart));
        localStorage.setItem("total_cart", JSON.stringify(current_total_cart_qty - current_qty));
        localStorage.setItem("total_price", JSON.stringify(current_total_price - current_sum));

        console.log('Сумма удаления', current_sum);
        console.log('ID====', current_id);
        console.log('CART====', current_cart);
        console.log('Количество', current_qty);
        console.log('Розмер', current_size);



    //  jQuery(this).    
    
    });
    jQuery(document).on('click touch', '.cart_num_minus_btn', function () {
        var current_id = $(this).parents('div.cart_num').attr('data-id');
        var current_weight = $(this).parents('div.cart_num').attr('data-weight');
        var current_size = $(this).parents('div.cart_num').attr('data-size');
        var current_price = $(this).parents('div.cart_num').attr('data-price');
        var current_qty = $(this).parents('div.cart_num').find('.cart_num_curr').text();
        var current_cart = JSON.parse(localStorage.getItem("cart"));
        var current_total_cart_qty = JSON.parse(localStorage.getItem("total_cart"));
        var current_total_price = JSON.parse(localStorage.getItem("total_price"));

        
        console.log('Количество текущ', current_qty);
        var current_total_sum_bottom = $('.cart_totals_price').text();
        
        var current_total_sum_top = $('#total_price').text();
        var current_total_sum_line = $(this).parents('tr').find('#cart_price_' + current_id).text();
        var current_total_qty = $('#total_cart').text();
        $(this).parents('div.cart_num').find('.cart_num_curr').text(current_qty -1);
        $('.cart_totals_price').text(current_total_sum_bottom - current_price);
        $('#total_price').text(current_total_sum_top - current_price);
        $('#total_cart').text(current_total_qty - 1);
        var current_total_sum_line = $(this).parents('tr').find('#cart_price_' + current_id).text(current_total_sum_line - current_price);
        
        
        for(var i = current_cart.length - 1; i >= 0; i--) {
            if(current_cart[i].id === current_id && (current_cart[i].size === current_size || current_cart[i].weight === current_weight)) {
                console.log('nen',current_cart);
                current_cart.splice(i, 1);
                break;
            }
        }      
        localStorage.setItem("cart", JSON.stringify(current_cart));
        localStorage.setItem("total_cart", JSON.stringify(current_total_cart_qty - 1));
        localStorage.setItem("total_price", JSON.stringify(current_total_price - current_price));
        if(current_qty == 1){
            $(this).parents('tr').hide();
        }
        console.log('Сумма удаления', current_price);
        console.log('ID====', current_id);
        console.log('Количество закал', current_total_qty);
        
        console.log('Общ цена в линии текущ', current_total_sum_line);
        console.log('Розмер', current_size);

        
    })
    jQuery(document).on('click touch', '.cart_num_plus_btn', function () {
        var current_id = $(this).parents('div.cart_num').attr('data-id');
        var current_weight = $(this).parents('div.cart_num').attr('data-weight');
        var current_category = $(this).parents('div.cart_num').attr('data-category');
        var current_size = $(this).parents('div.cart_num').attr('data-size');
        var current_price = $(this).parents('div.cart_num').attr('data-price');
        var current_qty = $(this).parents('div.cart_num').find('.cart_num_curr').text();

        var current_cart = JSON.parse(localStorage.getItem("cart"));
        var current_total_cart_qty = JSON.parse(localStorage.getItem("total_cart"));
        var current_total_price = JSON.parse(localStorage.getItem("total_price"));

        var current_total_sum_bottom = $('.cart_totals_price').text();
        var current_total_sum_top = $('#total_price').text();
        var current_total_sum_line = $(this).parents('tr').find('#cart_price_' + current_id).text();
        var current_total_qty = $('#total_cart').text();


        $(this).parents('div.cart_num').find('.cart_num_curr').text(+current_qty + 1);
        $('.cart_totals_price').text(+current_total_sum_bottom + +current_price);
        var total_price_my = $('#total_price').text(+current_total_sum_top + +current_price);
        var total_cart_my = $('#total_cart').text(+current_total_qty + 1);
        var current_total_sum_line = $(this).parents('tr').find('#cart_price_' + current_id).text(+current_total_sum_line + +current_price);
        var data = {
            id: current_id,
            size: current_size,
            weight: current_weight,
            price: current_price,
            category: current_category
        }
        current_cart.push(data);
        localStorage.setItem("total_cart", JSON.stringify(+current_total_cart_qty + 1));
        localStorage.setItem("total_price", JSON.stringify(+current_total_price + +current_price));
        localStorage.setItem("cart", JSON.stringify(current_cart));
    })
    jQuery(document).on('click touch', '#order_btn', function (e) {
        e.preventDefault();
        var locationData = window.location.href.split('?');
        var total_price = $('span#total_price').text();
        console.log("Сума", total_price);

        $('input[name=sum]').val(total_price);
        var data_to_backend = [];
        $('.cart_table tr').each(function(item, value){
            console.log("Iter", value);
            var id = $(this).find('.cart_remove_btn').attr('data-id');
            var category_id = $(this).find('.cart_remove_btn').attr('data-category-id');
            var category = $(this).find('.cart_num').attr('data-category');
            console.log("Кат", category_id);
            //var phone = $('#cart_phone').val();
            var title = $(this).find('.cart_product h3').text();
            var params = $(this).find('.cart_info_td').text();
            var qty = $(this).find('.cart_num_curr').text();
            var price = $(this).find('.price').text();
            var number_id = $(this).find('.cart_remove_btn').attr('data-number');
            console.log("Параметри", params);
            var data = {
                id: id,
                title: title,
                params: params,
                category: category,
                qty: qty,
                price: price,
                number_id: number_id,
                category_id: category_id
            }  
            data_to_backend.push(data);  
        })
        $('input[name=order_details]').val(JSON.stringify(data_to_backend));
        console.log("Дата на админку", data_to_backend);
        var data_serialize = $('form#order_form').serialize();
        $.ajax({
            url: '/add_order',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: data_serialize,
            dataType: "json",
            success: function (data)  {
                if (data.success) {
                    localStorage.removeItem("total_cart");
                    localStorage.removeItem("total_price");
                    localStorage.removeItem("cart");
                    //window.location.replace(locationData[0] + '?status=success');

                    
                    $("div#order_process").remove();
                    $("div#order_empty").remove();
                    $("div#order_done").show();
                    $('#order_done_phone').text(data.phone);


                        
                    
                }
                else {
                    swal(trans['base.error'], data.message, "error");
                }


            },
            error: function (data) {
                alert('Серверная ошибка');
            }
        });
    });
    /* /Custom flexweb */
    delete $.jMaskGlobals['translation']['0'];
    $("#cart_phone").mask("+38 099 999-99-99");

    $('.gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
                var title = item.el.attr('data-site-title');

                var caption = item.el.attr('title');
                if( caption !== '' ) {
                    caption += '<br>';
                }
                return caption;// + '<div class="share_facebook" data-src="' + item.src + '" data-title="' + title + '" data-description="' + caption + '">share</div>';
            }
        }
    });

    $('.sp_home_slider').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true
    });
    
    $('#cart_name, #cart_phone').keyup(function () {
        var val1 = $.trim($('#cart_name').val());
        var val2 = $.trim($('#cart_phone').val());
        if ( val1 !== '' && val2 !== '' ) {
            $('#order_btn')[0].disabled = false;
        }
        else {
            $('#order_btn')[0].disabled = true;
        }

        if( val2 !== '' ) {
            $('#order_done_phone').html(val2);
        }
    });
    $('.item .item_popup').click(function(e){


        var $fade = jQuery('.fade');
        var $popup = jQuery('.dt_popup');
    
        var html = '';
        var title = jQuery(this).attr('data-title');
        var description = jQuery(this).attr('data-description');
        var img = jQuery(this).attr('data-img');
        var info = jQuery(this).attr('data-info');
        var info_json = JSON.parse(info);
        console.log('Info in popup', info_json);
    
        html += '<div class="tac"><img src="' + img + '" alt=""></div>';
        html += '<h2 class="tac">' + title + '</h2>';
        if( description ) {
            html += '<p class="tac">' + description + '</p>';
        }
    
        if( info_json && info_json.length > 0 ) {
            for( var i=0; i<info_json.length; i++ ) {
                var params = [];
                var id = info_json[i]['id'];
                var price = info_json[i]['price'];
                var size = info_json[i]['size'];
                var category = info_json[i]['category'];
    
                if( info_json[i]['size'] ) {
                    params.push( info_json[i]['size'] + ' см' );
                }
                if( info_json[i]['weigth'] ) {
                    params.push( info_json[i]['weigth'] + ' г' );
                }
                
                if( info_json[i]['liters'] ) {
                    params.push( info_json[i]['liters'] + ' л' );
                }
                if( info_json[i]['persons'] ) {
                    params.push( info_json[i]['persons'] + ' чел.' );
                }
    
                var curr_w =  info_json[i]['liters'] ?  info_json[i]['liters'] : info_json[i]['weigth'];
                var params_str = params.join(' / ');
    
                html += '<div class="tac item">';
                html += params_str;
                html += ' &mdash; ';
                html += '<span>' + price + '</span> грн';
                html += '<div class="item_button">';

                if(size){
                    html += '<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-category="' + category + '"  data-size="' + size + '" data-id="' + id + '" data-price="' + price + '" data-weight="' + curr_w + '">Заказать</button>';
                }else{
                    html += '<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored add_to_cart" data-category="' + category + '"  data-id="' + id + '" data-price="' + price + '" data-weight="' + curr_w + '">Заказать</button>';
                }
                html += '<div class="item_button_done"><div><a href="/cart">Добавлено в корзину</a></div></div>';
                html += '</div>';
                html += '</div>';
                //console.log('HTML',html);
            }
        }
    
        $popup.find('.dt_popup_content').html(html);
        $fade.show();
        $popup.show();
    
        setTimeout(function () {
            var h = $popup.outerHeight();
            var bh = jQuery(window).height();
    
            var t = ( h > bh ) ? jQuery(window).scrollTop() : (bh-h)/2 + jQuery(window).scrollTop();
            if(t < 0) {
                t = 0;
            }
            $popup.css({
                top: t
            });
        }, 50);
    
        return false;
    });

});

/* Custom flexweb */
function clearCart(){
    $("div#order_process").hide();
    $("div#order_empty").removeClass('hidden');

}

/* Custom flexweb */
function inArray(val, arr) {
    var in_array = false;
    for( var i=0; i<arr.length; i++ ) {
        if( arr[i] === val ) {
            in_array = true;
            break;
        }
    }

    return in_array;
}

function makeid(num) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < num; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}

// jQuery(document).on('click touch', '.cart_num_plus_btn', function () {
//     var $parent = jQuery(this).parents('.cart_num').first();

//     var data_id = ($parent.attr('data-id'));
//     var data_weight = parseFloat($parent.attr('data-weight'));

//     var cookieJson = getCookie('cart');
//     var json_obj = JSON.parse(cookieJson) ;

//     var num = 0;
//     var price = 0;
//     for( var i=0; i<json_obj['order'].length; i++ ) {
//         var curr_id   = (json_obj['order'][i]['id']);
//         var curr_num   = parseInt(json_obj['order'][i]['total']);
//         var curr_price = parseInt(json_obj['order'][i]['price']);
//         var curr_weight = parseFloat(json_obj['order'][i]['weight']);
        
//         console.log(curr_id, data_id);

//         if( curr_id == data_id && curr_weight === data_weight ) {
//             num = curr_num + 1;
//             price = curr_price * num;

//             json_obj['order'][i]['total'] = num;
//         }
//     }

//     var json_str = JSON.stringify(json_obj);
//     setCookie('cart',json_str, {path:'/'});
//     $parent.find('.cart_num_curr').html(num);

//     var dw = data_weight.toString().replace('.', '-');
//     jQuery('#cart_price_' + data_id + '_' + dw).html(price);


//     var cart_total_num   = 0;
//     var cart_total_price = 0;

//     for( var i=0; i<json_obj['order'].length; i++ ) {
//         var curr_num   = parseInt(json_obj['order'][i]['total']);
//         var curr_price = parseInt(json_obj['order'][i]['price']);

//         cart_total_num   += curr_num;
//         cart_total_price += curr_num * curr_price;
//     }

//     jQuery('#total_cart').html(cart_total_num + ' С€С‚.');
//     jQuery('#total_price').html(cart_total_price + ' РіСЂРЅ');
//     jQuery('.cart_totals_price').html(cart_total_price);
// });
// jQuery(document).on('click touch', '.cart_num_minus_btn', function () {
//     var $parent = jQuery(this).parents('.cart_num').first();

//     var data_id = ($parent.attr('data-id'));
//     var data_weight = parseFloat($parent.attr('data-weight'));

//     var cookieJson = getCookie('cart');
//     var json_obj = JSON.parse(cookieJson) ;

//     var num = 0;
//     var price = 0;
//     for( var i=0; i<json_obj['order'].length; i++ ) {
//         var curr_id   = (json_obj['order'][i]['id']);
//         var curr_num   = parseInt(json_obj['order'][i]['total']);
//         var curr_price  = parseInt(json_obj['order'][i]['price']);
//         var curr_weight = parseFloat(json_obj['order'][i]['weight']);

//         if( curr_id == data_id && curr_weight === data_weight ) {
//             num = curr_num - 1;
//             if( num < 1 ) {
//                 num = 1
//             }
//             price = curr_price * num;

//             json_obj['order'][i]['total'] = num;
//         }
//     }

//     var json_str = JSON.stringify(json_obj);
//     setCookie('cart',json_str, {path:'/'});
//     $parent.find('.cart_num_curr').html(num);

//     var dw = data_weight.toString().replace('.', '-');
//     jQuery('#cart_price_' + data_id + '_' + dw).html(price);


//     var cart_total_num   = 0;
//     var cart_total_price = 0;

//     for( var i=0; i<json_obj['order'].length; i++ ) {
//         var curr_num   = parseInt(json_obj['order'][i]['total']);
//         var curr_price = parseInt(json_obj['order'][i]['price']);

//         cart_total_num   += curr_num;
//         cart_total_price += curr_num * curr_price;
//     }

//     jQuery('#total_cart').html(cart_total_num + ' С€С‚.');
//     jQuery('#total_price').html(cart_total_price + ' РіСЂРЅ');
//     jQuery('.cart_totals_price').html(cart_total_price);
// });
// jQuery(document).on('click touch', '.cart_remove_btn', function () {
//     var data_id = (jQuery(this).attr('data-id'));
//     var data_weight = parseFloat(jQuery(this).attr('data-weight'));

//     var cookieJson = getCookie('cart');
//     var json_obj = JSON.parse(cookieJson) ;

//     var index = null;
//     for( var i=0; i<json_obj['order'].length; i++ ) {
//         var curr_id   = (json_obj['order'][i]['id']);
//         var curr_weight = parseFloat(json_obj['order'][i]['weight']);

//         if( curr_id == data_id && curr_weight === data_weight ) {
//             index = i;
//             break;
//         }
//     }


//     var dw = data_weight.toString().replace('.', '-');
//     json_obj['order'].splice(index, 1);
//     jQuery( '#cart_row_' + data_id + '_' + dw).remove();

//     var json_str = JSON.stringify(json_obj);
//     setCookie('cart',json_str, {path:'/'});

//     var cart_total_num   = 0;
//     var cart_total_price = 0;

//     for( var i=0; i<json_obj['order'].length; i++ ) {
//         var curr_num   = parseInt(json_obj['order'][i]['total']);
//         var curr_price = parseInt(json_obj['order'][i]['price']);

//         cart_total_num   += curr_num;
//         cart_total_price += curr_num * curr_price;
//     }

//     jQuery('#total_cart').html(cart_total_num + ' С€С‚.');
//     jQuery('#total_price').html(cart_total_price + ' РіСЂРЅ');
//     jQuery('.cart_totals_price').html(cart_total_price);

//     if( json_obj['order'].length < 1 ) {
//         jQuery('#order_process').addClass('hidden');
//         jQuery('#order_empty').removeClass('hidden');
//     }
// });
// jQuery(document).on('click touch', '#order_btn', function () {
//     var $btn = jQuery(this);
//     $btn.addClass('hidden');
//     jQuery('#order_loader').removeClass('hidden');

//     var data = {
//         action: 'cart_order',
//         nonce: cart_order.nonce,
//     };

//     var data_info = {};
//     jQuery('#order_form input, #order_form textarea').each(function () {
//         var curr_data_val = jQuery.trim(jQuery(this).val());
//         data_info[jQuery(this).attr('id')] = curr_data_val;
//     });
//     data['info'] = JSON.stringify(data_info);

//     jQuery.post( cart_order.url, data, function(response) {

//         var res = JSON.parse(response);
//         var done = parseInt(res['done']);

//         if( done === 1 ) {
//             jQuery('#order_process').addClass('hidden');
//             jQuery('#order_done').removeClass('hidden');
//             deleteCookie('cart');

//             jQuery('#total_cart').html('0 С€С‚.');
//             jQuery('#total_price').html('0 РіСЂРЅ');
//         }
//         else {
//             $btn.removeClass('hidden');
//             jQuery('#order_loader').addClass('hidden');
//         }

//     });

//     return false;
// });
// jQuery(document).on('click touch', '.item_button_size', function () {
//     var $checkbox = jQuery('#' + jQuery(this).attr('data-id'));
//     var $parent = $checkbox.parents('.mdl-switch').first();

//     var pos = parseInt(jQuery(this).attr('data-pos'));
//     var chk = pos === 0 ? false : true;

//     $checkbox[0].checked = chk;

//     if( chk ) {
//         $parent.addClass('is-checked');
//     }
//     else {
//         $parent.removeClass('is-checked');
//     }

//     componentHandler.upgradeElement($parent[0]);

//     var $item = jQuery(this).parents('.item').first();
//     $item.find('.item_button').addClass('hidden');
//     $item.find('.item_button').eq(pos).removeClass('hidden');

//     if( $checkbox.parents('.ingredient_size').length > 0 ) {
//         $checkbox.parents('.ingredient_size').first().find('.item_price_span').html(jQuery(this).data('price'));
//         $checkbox.parents('.ingredient_size').first().find('.item_price_span').attr('data-weight',jQuery(this).data('weight'));

//         if( jQuery(this).data('size') ) {
//             $checkbox.parents('.ingredient_size').first().find('.item_price_span').attr('data-size',jQuery(this).data('size'));
//         }

//         var $constr_list_val = jQuery('#constructor_list li[data-id="' + $checkbox.parents('.ingredient').first().data('id') + '"]');
//         if( $constr_list_val.length > 0 ) {
//             var html = '';
//             if( jQuery(this).data('size') ) {
//                 $constr_list_val.attr('data-size', jQuery(this).data('size'));
//                 var size =  jQuery(this).data('size') + ' СЃРј, ';
//             }
//             else {
//                 var size = '';
//             }
//             html += '<div>' + size + jQuery(this).data('weight') + ' Рі, ' + jQuery(this).data('price') + ' РіСЂРЅ</div>';

//             $constr_list_val.attr('data-weight', jQuery(this).data('weight'));
//             $constr_list_val.attr('data-price', jQuery(this).data('price'));

//             $constr_list_val.find('.mdl-list__item-sub-title').html(html);
//         }

//         setTimeout(IngrTotal, 0);
//     }

// });
jQuery(document).on('click touch', '.mdl-switch__input', function () {

    var pos = jQuery(this)[0].checked === false ? 0 : 1;
    var $item = jQuery(this).parents('.item').first();
    $item.find('.item_button').addClass('hidden');
    $item.find('.item_button').eq(pos).removeClass('hidden');

    if( jQuery(this).parents('.ingredient_size').length > 0 ) {
        var price = jQuery(this).parents('.ingredient_size').first().find('.item_button_size').eq(pos).data('price');
        var weight = jQuery(this).parents('.ingredient_size').first().find('.item_button_size').eq(pos).data('weight');
        var size = jQuery(this).parents('.ingredient_size').first().find('.item_button_size').eq(pos).data('size');

        jQuery(this).parents('.ingredient_size').first().find('.item_price_span').html(price);
        jQuery(this).parents('.ingredient_size').first().find('.item_price_span').attr('data-weight', weight);

        if( size ) {
            jQuery(this).parents('.ingredient_size').first().find('.item_price_span').attr('data-size', size);
        }

        var $constr_list_val = jQuery('#constructor_list li[data-id="' + jQuery(this).parents('.ingredient').first().data('id') + '"]');
        if( $constr_list_val.length > 0 ) {
            var html = '';
            if( size ) {
                $constr_list_val.attr('data-size', size);
                size =  size + ' СЃРј, ';
            }
            else {
                size = '';
            }
            html += '<div>' + size + weight + ' Рі, ' + price + ' РіСЂРЅ</div>';

            $constr_list_val.attr('data-weight', weight);
            $constr_list_val.attr('data-price', price);

            $constr_list_val.find('.mdl-list__item-sub-title').html(html);
        }

        setTimeout(IngrTotal, 0);
    }

});



jQuery(document).on('click touch', '.dt_popup_bg', function (e) {
    e.stopPropagation();
    e.preventDefault();

    return false;
});
jQuery(document).on('click touch', '.dt_popup_close, .fade, .dt_popup', function () {
    var $fade = jQuery('.fade');
    var $popup = jQuery('.dt_popup');

    $fade.hide();
    $popup.hide();

    return false;
});
jQuery(document).on('click touch', '.ingr_btn', function () {
    jQuery(this).toggleClass('done');

    var $total_list = jQuery('#constructor_list');
    var $parent = jQuery(this).parents('.ingredient').first();
    var id = $parent.attr('data-id');

    if( jQuery(this).hasClass('done') ) {
        var background = 'white';
        if( $parent.attr('data-icon') ) {
            
            background = 'url(' + $parent.attr('data-icon') + ') 50% 50% no-repeat';
        }
        var title =  jQuery.trim($parent.find('.ingredient_name').text());
        var weight = $parent.find('.item_price_span').attr('data-weight');
        var price = $parent.find('.item_price_span').text();

        var img = $parent.attr('data-img');

        var size = '';
        if( $parent.find('.item_price_span').data('size') ) {
            size =  $parent.find('.item_price_span').data('size') + ' СЃРј, ';
        }

        var html = '<li class="mdl-list__item mdl-list__item--two-line" data-id="' + id + '" data-price="' + price + '" data-weight="'+ weight + '" data-title="'+ title + '">';
        html += '<span class="mdl-list__item-primary-content">';
        if(background === 'white') {
            html += '<span class="files_list_content" style="margin-left: 0;">';
        }
        else {
            html += '<i class="material-icons mdl-list__item-avatar" style="background: ' + background + ';-webkit-background-size: contain;background-size: contain;"></i>';
            html += '<span class="files_list_content">';
        }
        html += '<span>' + title + '</span>';
        html += '<span class="mdl-list__item-sub-title">';

        html += '<div>' + size + weight + ' Рі, ' + price + ' РіСЂРЅ</div>';

        html += '</span>';
        html += '</span>';
        html += '</span>';
        html += '<span class="mdl-list__item-secondary-action">';
        html += '<button class="mdl-button mdl-js-button mdl-button--icon ingr_btn_remove" data-id="' + id + '">';
        html += '<i class="material-icons">clear</i>';
        html += '</button>';
        html += '</span>';
        html += '</li>';

        $total_list.append(html);

        if( img ) {
            var $images = jQuery('#images');
            var zindex = $images.find('img').length;

            $images.append('<img data-id="' + id + '" src="' + img + '" alt="" style="z-index: ' + zindex + '">');
        }

        jQuery(this).html( jQuery(this).data('done') );
    }
    else {
        $total_list.find('li[data-id="' + id + '"]').remove();

        jQuery(this).html( jQuery(this).data('add') );
        jQuery('#images img[data-id="' + id + '"]').remove();
    }

    jQuery('.ingredient_btn_error').html('');
    jQuery('.ingredient_btn_error').addClass('hidden');

    setTimeout(IngrTotal, 0);

    return false;
});

jQuery(document).on('click touch', '.ingr_btn_remove', function () {
    var $total_list = jQuery('#constructor_list');
    var id = jQuery(this).attr('data-id');

    var $ingr_btn = jQuery('.ingredient[data-id="' + id + '"] .ingr_btn');
    $ingr_btn.toggleClass('done');
    $ingr_btn.html( $ingr_btn.data('add') );

    $total_list.find('li[data-id="' + id + '"]').remove();
    setTimeout(IngrTotal, 0);

    jQuery('#images img[data-id="' + id + '"]').remove();

    return false;
});


var constructor_timer = null;
jQuery(document).on('click touch', '#constructor_pizza_btn', function () {
    var $constructor_list = jQuery('#constructor_list');

    var req_list = constructorReqList();
    
    var idc = [];
    $constructor_list.find('.mdl-list__item').each(function () {
        var id = parseInt(jQuery(this).data('id'));
        if( id && id > 0 ) {
            idc.push( jQuery(this).data('id') );
        }
    });

    var str = null;
    for( var i in req_list ) {
        var in_arr = false;
        if( req_list[i].length > 0 ) {
            for( var j=0; j<idc.length; j++ ) {
                if( inArray(idc[j], req_list[i]) ) {
                    in_arr = true;
                    break;
                }
            }

            if( ! in_arr ) {
                if( str === null ) {
                    str = [];
                }
                var title = jQuery('.ingredients[data-id="' + i + '"]').attr('data-title');

                str.push('Р’С‹Р±РѕСЂ С…РѕС‚СЏ Р±С‹ РѕРґРЅРѕРіРѕ РёРіСЂРёРґРёРµРЅС‚Р° РёР· СЂР°Р·РґРµР»Р° "<strong>' + title + '</strong>" РѕР±СЏР·Р°С‚РµР»РµРЅ');
            }
        }
    }

    if( str !== null ) {
        var error_str = str.join('<br>');

        jQuery('.ingredient_btn_error').html(error_str);
        jQuery('.ingredient_btn_error').removeClass('hidden');
        return false;
    }

    var constructor_arr = [];
    var price = 0;
    var weight = 0;
    $constructor_list.find('.mdl-list__item').each(function () {
        var $elem = jQuery(this);

        var ingr_data = {
            'id': $elem.attr('data-id'),
            'price': $elem.attr('data-price')*1,
            'weight': $elem.attr('data-weight')*1,
            'title': $elem.attr('data-title')
        };

        if( $elem.attr('data-size') ) {
            ingr_data['size'] = $elem.attr('data-size')*1;
        }

        price += $elem.attr('data-price')*1;
        weight += $elem.attr('data-weight')*1;

        constructor_arr.push(ingr_data);
    });

    var data = {
        'id': makeid(20),
        'price': price,
        'weight': weight,
        'total': 1,
        'constructor': constructor_arr
    };

    var json = checkConstructorPizza(data);

    if( constructor_timer !== null ) {
        clearTimeout(constructor_timer);
        constructor_timer = null;
    }
    jQuery('.item_button_done').addClass('done');
    constructor_timer = setTimeout(function(){
        jQuery('.item_button_done').removeClass('done');
        clearTimeout(constructor_timer);
        constructor_timer = null;
    },7000);

    var json_str = JSON.stringify(json);
    setCookie('cart',json_str, {path:'/'});

    var data = {
        action: 'cart_update',
        nonce: cart_update.nonce,
        json: json_str
    };

    jQuery.post( cart_update.url, data, function(response) {

        var res = JSON.parse(response);
        if( parseInt(json['id']) === 0 ) {
            json['id'] = parseInt(res['id']);

            json_str = JSON.stringify(json);
            setCookie('cart',json_str, {path:'/'});

        }

        var cookieJson = getCookie('cart');
        var json_obj = JSON.parse(cookieJson) ;


        var cart_total_num   = 0;
        var cart_total_price = 0;

        for( var i=0; i<json_obj['order'].length; i++ ) {
            var curr_num   = parseInt(json_obj['order'][i]['total']);
            var curr_price = parseInt(json_obj['order'][i]['price']);

            cart_total_num   += curr_num;
            cart_total_price += curr_num * curr_price;
        }

        jQuery('#total_cart').html(cart_total_num + ' С€С‚.');
        jQuery('#total_price').html(cart_total_price + ' РіСЂРЅ');

    });


    return false;
});

jQuery(document).on('click touch', '.add_feedback', function () {
    var html = jQuery('.feedback_form_block').html();
    html = html.replace(/%ID%/g, 'feedback');
    html = html.replace(/%CLASS%/g, 'mdl');

    var $fade = jQuery('.fade');
    var $popup = jQuery('.dt_popup');
    
    $popup.find('.dt_popup_content').html(html);
    $fade.show();
    $popup.show();
    
    $popup.find('.mdl-textfield,.mdl-button,.mdl-spinner').each(function () {
        componentHandler.upgradeElement(jQuery(this)[0]);
    });

    setTimeout(function () {
        var h = $popup.outerHeight();
        var bh = jQuery(window).height();

        var t = ( h > bh ) ? jQuery(window).scrollTop() : (bh-h)/2 + jQuery(window).scrollTop();
        if(t < 0) {
            t = 0;
        }
        $popup.css({
            top: t
        });
    }, 0);

    return false;
});

jQuery(document).on('keyup', '#feedback_name, #feedback_msg', function () {
    var feedback_name = jQuery.trim(jQuery('#feedback_name').val());
    var feedback_msg = jQuery.trim(jQuery('#feedback_msg').val());

    if( feedback_name !== '' && feedback_msg !== '' ) {
        jQuery('#feedback_btn')[0].disabled = false;
    }
    else {
        jQuery('#feedback_btn')[0].disabled = true;
    }

    return false;
});

jQuery(document).on('click touch', '#feedback_btn', function (e) {
    e.preventDefault();
    var $btn = jQuery(this);
    $btn.addClass('hidden');
    jQuery('#feedback_loader').removeClass('hidden');
    var locationData = window.location.href.split('?');
    var data = jQuery('form.add_review').serialize();

    console.log('дата відгуку', data);
    var lang =  jQuery("input[name='lang']").val();
    var token = jQuery("input[name='csrf-token']").val();      
    
    jQuery.ajax({
        url: '/' + lang + '/add_review',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': token
        },
        data: data,
        dataType: "json",
        success: function (data) {
            if (data.success) {
            jQuery('#feedback_form_done').removeClass('hidden');
            jQuery('#feedback_form').addClass('hidden');
            window.location.replace(locationData[0] + '?status=success');

            }
            else {
                swal(trans['base.error_add_review'], data.message, "error");
            }
        },
        error: function (data) {
            swal(trans['base.error']);
        }

    });  

    // jQuery.post( feedback.url, data, function(response) {
    //     var res = JSON.parse(response);

    //     jQuery('.feedback_list').html(res['posts']);
    //     jQuery('.pgn').html(res['pgn']);


    // });

    return false;
});

jQuery(document).on('click touch', '.ingredients_header', function () {
    var $h2 = jQuery(this);
    var $span = $h2.find('span');

    if( $span.is(":visible") ) {
        if( $h2.hasClass('open') ) {
            $h2.removeClass('open');
            $h2.next('.ingredients').first().slideUp('300');
            setTimeout(function () {
                $h2.next('.ingredients').first().addClass('open');
            },400);
        }
        else {
            $h2.addClass('open');
            $h2.next('.ingredients').first().removeClass('open');
            $h2.next('.ingredients').first().slideDown('300');
        }
    }

    return false;
});

function checkConstructorPizza(data) {
    var cookieJson = getCookie('cart');

    if( cookieJson ) {
        var json = JSON.parse(cookieJson) ;

        var in_cookie = false;
        for( var i=0; i<json['order'].length; i++ ) {
            if( json['order'][i]['id'].toString().length === 20 ) {

                if( parseInt(json['order'][i]['price']) === parseInt(data['price']) && parseInt(json['order'][i]['weight']) === parseInt(data['weight']) && json['order'][i]['constructor'].length === data['constructor'].length ) {

                    var all_done = true;
                    for( var j=0; j < json['order'][i]['constructor'].length; j++ ) {
                        var elem = json['order'][i]['constructor'][j];

                        if( parseInt(elem['price']) !== parseInt(data['constructor'][j]['price']) || parseInt(elem['weight']) !== parseInt(data['constructor'][j]['weight']) ) {

                            if( elem['size'] !== undefined && parseInt(elem['size']) !== parseInt(data['constructor'][j]['size']) ) {
                                all_done = false;
                                break;
                            }
                            else {
                                all_done = false;
                                break;
                            }
                        }
                    }

                    if( all_done ) {
                        in_cookie = true;
                        json['order'][i]['total'] += 1;
                    }
                }
            }
        }

        if( ! in_cookie ) {
            json['order'].push(data);
        }
    }
    else {
        var json = {
            'id': 0,
            'order': [
                data
            ]
        };
    }


    return json;
}

function constructorReqList() {
    var req_list = {};
    jQuery('.ingredients').each(function () {
        var req = jQuery(this).data('req');
        var id  = jQuery(this).data('id');

        req_list[id] = [];

        if( parseInt(req) === 1 ) {
            jQuery(this).find('.ingredient').each(function () {
                req_list[id].push(jQuery(this).data('id'));
            });
        }
    });

    return req_list;
}

function IngrTotal() {
    var $list = jQuery('#constructor_list li');

    var price = 0;
    var weight = 0;

    $list.each(function () {
        price += jQuery(this).attr('data-price') * 1;
        weight += jQuery(this).attr('data-weight') * 1;
    });

    jQuery('#ingr_total_weight').html(weight);
    jQuery('#ingr_total_price').html(price);
}

function addToCart( $elem ) {
    // deleteCookie('cart');
    // return false;
    var cookieJson = getCookie('cart');

    if( cookieJson ) {
        var json = JSON.parse(cookieJson) ;
    }
    else {
        var json = {
            'id': 0,
            'order': []
        };
    }

    if( isNaN(parseInt($elem.data('id'))) || isNaN(parseInt($elem.data('price'))) ) {
        return false;
    }

    var order_data = {
        'id': parseInt($elem.data('id')),
        'price': parseInt($elem.data('price')),
        'weight': $elem.data('weight'),
        'total': 1
    };

    var in_order = false;
    for( var i=0; i<json['order'].length; i++ ) {
        if( parseInt(json['order'][i]['id']) === order_data['id'] && (json['order'][i]['weight']) === (order_data['weight']) ) {
            in_order = i;
            break;
        }
    }
    if( isNaN(parseInt(in_order)) ) {
        json['order'].push(order_data);
    }
    else {
        json['order'][in_order]['price'] = order_data['price'];
        json['order'][in_order]['total'] += 1;
    }

    var $button_parent = $elem.parents('.item_button').first();
    $button_parent.find('.item_button_done').addClass('done');
    setTimeout(function(){
        $button_parent.find('.item_button_done').removeClass('done');
    },7000);

    var json_str = JSON.stringify(json);
    setCookie('cart',json_str, {path:'/'});

    var data = {
        action: 'cart_update',
        nonce: cart_update.nonce,
        json: json_str
    };

    jQuery.post( cart_update.url, data, function(response) {

        var res = JSON.parse(response);
        if( parseInt(json['id']) === 0 ) {
            json['id'] = parseInt(res['id']);

            json_str = JSON.stringify(json);
            setCookie('cart',json_str, {path:'/'});

        }

        cookieJson = getCookie('cart');
        var json_obj = JSON.parse(cookieJson) ;


        var cart_total_num   = 0;
        var cart_total_price = 0;

        for( var i=0; i<json_obj['order'].length; i++ ) {
            var curr_num   = parseInt(json_obj['order'][i]['total']);
            var curr_price = parseInt(json_obj['order'][i]['price']);

            cart_total_num   += curr_num;
            cart_total_price += curr_num * curr_price;
        }

        jQuery('#total_cart').html(cart_total_num + ' С€С‚.');
        jQuery('#total_price').html(cart_total_price + ' РіСЂРЅ');

    });
}

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}
function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }

    document.cookie = updatedCookie;
}
function deleteCookie(name) {
    setCookie(name, "", {
        expires: -1,
        path: '/'
    })
}















