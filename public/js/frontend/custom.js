$(function () {
    // setCookie('dateStart', (localStorage.getItem(dateStart)) ? localStorage.getItem(dateStart) : '');
    // setCookie('dateFinish', (localStorage.getItem(dateFinish)) ? localStorage.getItem(dateFinish) : '');

    var adults, dateStart, dateFinish, children, sumPrice, redirectPath;
    /*Chech show hotsale*/
    (function () {

        var lastclear = localStorage.getItem('lastclear'),
            time_now  = (new Date()).getTime();
      
        // .getTime() returns milliseconds so 1000 * 60 * 60 * 24 = 24 days
        if ((time_now - lastclear) > 1000 * 60 * 60 * 24) {
      
          localStorage.setItem('hotsate', true);
      
          localStorage.setItem('lastclear', time_now);
        }
      
      })();
    if(localStorage.getItem('hotsate') === 'false'){
        $('#freedates-bar').hide();    
    }
    
    /*Add check*/
    $('div.small-features div.col-md-4 p').prepend('<i class="fas fa-check text-orange"></i> ');  
    /* Reserved room in search page*/
    $('.apart-card .reserved').click(function(){    
       
        iterId = $(this).attr('data-id');
        //console.log('ціна', iterId);
        var roomName = $('.apart-header[data-id='+ iterId +']').text();
        var hotelName = $('.apart-hotel[data-id='+ iterId +']').text();
        sumPrice = $('.apart-total-price[data-id='+ iterId +']').text();
        adults = $("#adults").val();
        range_date = $("#datepicker").val();
        dates = range_date.split("-");
        dateStart = dates[0];
        dateFinish = dates[1];
        
        if(!dateStart || !dateFinish){
            alert(trans['base.date_comes_arrives']);   
            return false; 
        }
        if(adults == 0 ){
            alert(trans['base.enter_count_guests']);
            return false;     
        }
        children = $("#children").val();        
        $('#sum_price').text(sumPrice);    
        $('#adults_modal').text(adults);
        if(children != 0 && children == 1){
            $('#children_modal').text(trans['base.and'] + ' ' + children + " " + trans['base.child']);
        }else{
            $('#children_modal').text(trans['base.and'] + ' ' + children + " "+ trans['base.kids']);    
        }        
        //$('#sum_guests').text((+children) + (+adults));
        $('.date_from').text(dateStart);
        $('.date_to').text(dateFinish);
        $('#room').text(roomName);
        $('#hotel').text(hotelName);
        //console.log('елемент', sumPrice);	        
    })
    /* /Reserved room in search page*/
    /*get params for redirect to search page*/
    $('a.redirect').click(function(e){        
        var selectHotelName = $('#location').val();
        adults = $("#adults").val();
        range_date = $("#datepicker").val();
        dates = range_date.split("-");
        dateStart = dates[0];
        dateFinish = dates[1];
        console.log('дата виїзду====>', dates);
        console.log('дата заїзду', dateStart);
        var token = $("input[name='csrf-token']").val();        
        
        if(!dateStart && !dateFinish || dateFinish== " " ){
            alert(trans['base.date_comes_arrives']);   
            return false; 
        }
        if(adults == 0 ){
            alert(trans['base.enter_count_guests']);
            return false;     
        }
        children = $("#children").val();
        data = {            
            adults: adults,
            children: children,
            dateStart: dateStart,
            dateFinish: dateFinish                 
        }
        data = JSON.stringify(data);
        //console.log('Дата', data);
        // localStorage.setItem('dateStart', dateStart);
        // localStorage.setItem('dateFinish', dateFinish);
        localStorage.setItem('adults', adults);
        localStorage.setItem('children', children);
        /* save var in cookies */
        // deleteCookie('dateStart');
        // deleteCookie('dateFinish');
        
        // setCookie('dateStart', dateStart);
        // setCookie('dateFinish', dateFinish);


        

        // $.ajax({
        //     url: 'get_dates',
        //     method: 'POST',
        //     headers: {
        //         'X-CSRF-TOKEN': token              
        //     },            
        //     data: data,
        //     dataType: "json"            

        // });  
        if(!selectHotelName){
            e.preventDefault();
            alert(trans['base.enter_hotel']);
            return false;
        }
        
        
    })   
    $('.input-location').click(function(){        
        redirectPath = $(this).attr('data-redirect');  
        $("a.redirect").prop('href', redirectPath);
        //console.log('Ссилка для переходу', redirectPath);      
        //console.log('Шлях', redirectPath);    
    }) 
    /*/get params for redirect to search page*/

   
    $('.apart-buy').click(function(e){
        e.preventDefault();
        //getCount();
        adults = $("#adults").val();
        range_date = $("#datepicker").val();
        dates = range_date.split("-");
        dateStart = dates[0];
        dateFinish = dates[1];
        
        if(!dateStart && !dateFinish || dateFinish== " " ){
            alert(trans['base.date_comes_arrives']);   
            return false; 
        }
        if(adults == 0 ){
            alert(trans['base.enter_count_guests']);
            return false;     
        }
        children = $("#children").val();
        sumPrice = $('p.color-black').text();
        $('#sum_price').text(sumPrice);    
        $('#adults_modal').text(adults);
        if(children != 0 && children == 1){
            $('#children_modal').text(trans['base.and'] + ' ' + children + " " + trans['base.child']);
        }else{
            $('#children_modal').text(trans['base.and'] + ' ' + children + " "+ trans['base.kids']);    
        }        
        $('#sum_guests').text((+children) + (+adults));
        $('.date_from').text(dateStart);
        $('.date_to').text(dateFinish);
        //saveLocalStorage();
        //console.log('Кількість дорослих - ', adults);
        //console.log('Кількість дітей - ', children);       
    }) 
    $("button[name='reserved']").click(function(e){
        e.preventDefault();
        var locationData = window.location.href.split('#');
        var data = {};
        var roomName = $('#room').text();
        var hotelName = $('#hotel').text();
        var name = $("input[name='name']").val();
        var phone = $("input[name='phone']").val();
        var email = $("input[name='email']").val();
        var lang =  $("input[name='lang']").val();
        var token = $("input[name='csrf-token']").val();
        data = {
            roomName: roomName,
            hotelName: hotelName,
            adults: adults,
            children: children,
            dateStart: dateStart,
            dateFinish: dateFinish,
            sumPrice: sumPrice,
            name: name,
            phone: phone,
            email: email       
        }
        data = JSON.stringify(data);
        //console.log('дата', data);
        $.ajax({
            url: '/' + lang + '/reserved',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            //processData: false,
            //contentType: false,
            data: data,
            dataType: "json",
            success: function (data) {
                if (data.success) {
                    //$('#exampleModal4').modal('toggle');
                    window.location.replace(locationData[0] + '?status=success');
                    //alert('OK');
                    //swal(trans['base.success'], "", "success");
                    //jQuery("#callback-order").trigger("reset");
                    //$("#submit-send").attr('disabled', false);
                }
                else {
                    swal(trans['base.error'], data.message, "error");
                   // $("#submit-send").attr('disabled', false);
                }
            },
            error: function (data) {
                swal(trans['base.error']);
                //$("#submit-send").attr('disabled', false);
            }

        });        
    
    /**********END call-back**************/
    })

    $('#submit-callback').click(function(e){
        e.preventDefault();        
        //e.preventDefault();
        var data = $('form#callback').serialize();
        var lang =  $("input[name='lang']").val();
        var token = $("input[name='csrf-token']").val();      
        var locationData = window.location.href.split('#');

        $.ajax({
            url: '/' + lang + '/callback',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            //processData: false,
            //contentType: false,
            data: data,
            dataType: "json",
            success: function (data) {
                // console.log('Data ', data);
                if (data.success) {
                    // alert('urlParam ' + urlParam); 
                    if(!$.urlParam('status')){
                        window.location.replace(locationData[0] + '?status=callback');

                    }else{
                        window.location.replace(window.location.href);   
                    }
                    //$('#exampleModal3').modal('toggle');
                    //swal(trans['base.success'], "", "success");
                    //jQuery("#callback-order").trigger("reset");
                    //$("#submit-send").attr('disabled', false);
                }
                else {
                    swal(trans['base.error'], data.message, "error");
                   // $("#submit-send").attr('disabled', false);
                }
            },
            error: function (data) {
                swal(trans['base.error']);
                //$("#submit-send").attr('disabled', false);
            }

        });  
    }) 
    /*Show popup after callback*/
    if($.urlParam('status') == 'callback'){
       $('#exampleModal3').modal('toggle');

    }  

    /*Show popup after callback*/
    /*Show popup after reservation*/
    if($.urlParam('status') == "success"){
        $('#exampleModal4').modal('toggle');
 
     }  
 
     /*Show popup after reservation*/
    /*Add review*/ 
    $('#send_review').click(function(e){
        e.preventDefault();        
        //e.preventDefault();
        var data = $('form#add_review').serialize();

        //console.log('дата відгуку', data);
        var lang =  $("input[name='lang']").val();
        var token = $("input[name='csrf-token']").val();      
       
        $.ajax({
            url: '/' + lang + '/add_review',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            //processData: false,
            //contentType: false,
            data: data,
            dataType: "json",
            success: function (data) {
                if (data.success) {
                    //alert('OK');
                    swal(trans['base.success_add_review'], "", "success");
                    //jQuery("#callback-order").trigger("reset");
                    //$("#submit-send").attr('disabled', false);
                }
                else {
                    swal(trans['base.error_add_review'], data.message, "error");
                   // $("#submit-send").attr('disabled', false);
                }
            },
            error: function (data) {
                swal(trans['base.error']);
                //$("#submit-send").attr('disabled', false);
            }

        });  
    }) 

    /*/Add review*/ 
    /*Hide hotsale*/
    $('.order-hotsale, #close-button-container').click(function(){
        localStorage.setItem('hotsate', false); 
        localStorage.setItem('lastclear', (new Date()).getTime());

    })
        
    /*Hide hotsale*/
    
/*Pagination*/
    //  $('#more_reviews').click(function(e){
    //     e.preventDefault();    
    //     window.location.replace(window.location.href + '?page=2');    
    //     //e.preventDefault();
    //     //var data = $('form#add_review').serialize();
    //  });
    /*/Pagination*/


    
   
})
// function getQuantityDays() {
//     var range_date = $("#datepicker").val();
//     var dates = range_date.split("-");
//     var dateStart = dates[0];
//     var dateFinish = dates[1];   
//     var days = (daydiff(parseDate(dateFinish), parseDate(dateStart)));

// }
// function parseDate(str) {
//     console.log('Строка', str);
//     var mdy = str.split('.');    
//     return new Date(mdy[2], mdy[1]-1, mdy[0]);
// }
// function daydiff(second, first) {   
//     return (second-first)/(1000*60*60*24);
// }
// function getCount(){
//     adults = $("#adults").val();
//         range_date = $("#datepicker").val();
//         dates = range_date.split("-");
//         dateStart = dates[0];
//         dateFinish = dates[1];
        
//         if(!dateStart || !dateFinish){
//             alert('Введіть дати заїзду та виїзду');   
//             return false; 
//         }
//         if(adults == 0 ){
//             alert('Введіть кількість гостей');
//             return false;     
//         }
//         children = $("#children").val();
// }
function saveLocalStorage(){
    localStorage.setItem('dateStart', dateStart);
    localStorage.setItem('dateFinish', dateFinish);
    localStorage.setItem('adults', adults);
    localStorage.setItem('children', children);
}
$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return decodeURI(results[1]) || 0;
    }
}

