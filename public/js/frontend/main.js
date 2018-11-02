$(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  
  //Sliders start
  $('.rest-slider').slick({
      //autoplay: true,
      autoplaySpeed: 2000,
      infinite: true,
      fade: true,
      prevArrow: '.left-click',
      nextArrow: '.right-click',
      speed: 2000,
      dots: true,
      adaptiveHeight: true,
      appendDots: $('.rest-dots'),
      dotsClass: 'custom-dots',
      customPaging: function (slider, i) {
          return '<a class="dot" role="button"></a>';
      }
  });
  
  $('.slider-class').slick({
      infinite: true,
      prevArrow: '#p-arrow',
      nextArrow: '#n-arrow',
      speed: 1000,
      dots: true,
      appendDots: $('.main-dots'),
      dotsClass: 'custom-dots',
      customPaging: function (slider, i) {
          return '<a class="dot" role="button"></a>';
      }
  });
  
  $('.feedback-slider').slick({
      infinite: true,
      prevArrow: '#feedback-arrow-left',
      nextArrow: '#feedback-arrow-right',
      adaptiveHeight: true,
      speed: 1000
  });
  
  if ($(window).width() > 1199) {
      $('.slider-class-2').slick({
          slidesToShow: 3,
          infinite: true,
          prevArrow: '#p-arrow',
          nextArrow: '#n-arrow',
          speed: 1000,
          slidesToShow: 1,
          centerMode: true,
          variableWidth: true, 
          dots: true,
          appendDots: $('.main-dots-2'),
          dotsClass: 'custom-dots',
          customPaging: function (slider, i) {
              return '<a class="dot" role="button"></a>';
          }
      });
  
      $(".slider-class-2").find(".slick-slide").width(60 + "vw");
      $(".slider-class-2").find(".slick-slide").css({
          "padding-left": "8px",
          "padding-right": "8px"
      });
  } else {
      $('.slider-class-2').slick({
          slidesToShow: 3,
          infinite: true,
          prevArrow: '#p-arrow',
          nextArrow: '#n-arrow',
          speed: 1000,
          slidesToShow: 1,
          dots: true,
          appendDots: $('.main-dots-2'),
          dotsClass: 'custom-dots',
          customPaging: function (slider, i) {
              return '<a class="dot" role="button"></a>';
          }
      });
  
      $(".slider-class-2").find(".slick-slide").height(60 + "vh");
      $(".slider-class-2").find(".slick-slide").height($(".slider-class-2").find(".slick-slide").height() + 52);
      $(".slider-class-2").find(".slick-slide").css("padding", "0px");
  }
  
  $(".apart-image-slider").each(function() {
      var nArrow = $(this).parent().find('.n-apart-arrow');
      var pArrow = $(this).parent().find('.p-apart-arrow');
  
      $(this).slick({
          infinite: true,
          prevArrow: pArrow,
          nextArrow: nArrow,
          speed: 1000
      });
  });
  
  
  $(".apart-image").height($(".apart-image-slider").height());
  //END SLiders
  
  var unvisibleDatepicker = true;
  var selectedData = "";
  
  //Start form 
  $(document).ready(function() {
      /*Custom js*/
      /*VAR from localStorage*/
        var dateStartFromStorage, dateFinishFromStorage;
        var adultsFromStorage = localStorage.getItem('adults');
        var childrenFromStorage = localStorage.getItem('children');
        var dateStartFromStorage = localStorage.getItem('dateStart');
        var dateFinishFromStorage = localStorage.getItem('dateFinish');
        var diffMaxQuantityGuests = 0; 
        var timeNow = (new Date()).getTime();
        if(dateStartFromStorage || dateFinishFromStorage){
            var dateStartFromStorageTs = getDateTimestamp(dateStartFromStorage); 
            var dateFinishFromStorageTs = getDateTimestamp(dateFinishFromStorage); 
            
            
            if(((timeNow - dateStartFromStorageTs) > 1000 * 60 * 60 * 24) || ((timeNow - dateStartFromStorageTs) > 1000 * 60 * 60 * 24)){
                localStorage.removeItem('dateStart');
                localStorage.removeItem('dateFinish');
                dateStartFromStorage, dateFinishFromStorage = ''; 
            }

        }       
      
      if(dateStartFromStorage && dateFinishFromStorage){
        $("#datepicker").val(dateStartFromStorage + '-' + dateFinishFromStorage);
      }
      getDaysIntervalAndCalc();
      if(adultsFromStorage || childrenFromStorage){
        diffMaxQuantityGuests = +adultsFromStorage + +childrenFromStorage;  
        $("#adults").val(adultsFromStorage || 0); 
        $("#children").val(childrenFromStorage || 0); 
        if(adultsFromStorage !== 1) {
            $("#guests").text(adultsFromStorage + ' ' + trans['base.adults_many'] + " , " + childrenFromStorage + " " + trans['base.kids']);   
        }
        $("#guests").text(adultsFromStorage + ' ' + trans['base.adults_one'] + " , " + childrenFromStorage + " " + trans['base.kids']);   

      }
      /*VAR from localStorage*/
      var maxQuantityGuests =  $('#max_guests').text() || 8;     
      //diffMaxQuantityGuests = 0;      
      var val = 0;  
      //console.log('Максимальна кількість', maxQuantityGuests);
      //console.log('Значення', val);
        
      
        $("#adults_plus").click(function() { 
            val = 1 + +$("#adults").val();
            //console.log('Кількість дорослих', val);
            //console.log('maxQuantityGuestsдорослих', maxQuantityGuests);
            if (diffMaxQuantityGuests == maxQuantityGuests || maxQuantityGuests < val) { 
                val = maxQuantityGuests;
                if(maxQuantityGuests > 8) {
                    val = 8;
                }
                alert(trans['base.warn_max'] + ' ' + maxQuantityGuests);
                return false;
            }
            $("#adults").val(val);
            check_input_guests();
            diffMaxQuantityGuests++;
        });
        $("#children_plus").click(function() {           
            //console.log('Кількість дітей', val);
            val = 1 + +$("#children").val();  
            //val = maxQuantityGuests;          
            if (val > 4){                
                alert(trans['base.warn_max_children'] + ' - 4'); 
                val = 4;  
                return false; 
            }
            console.log('diffMaxQuantityGuests ', diffMaxQuantityGuests);
            if (diffMaxQuantityGuests == maxQuantityGuests || maxQuantityGuests < val) {                
                alert(trans['base.warn_max'] + ' ' + maxQuantityGuests );
                return false;
                
            }
            $("#children").val(val);
                check_input_guests();
                //console.log('Різниця фікс', diffMaxQuantityGuests);
                diffMaxQuantityGuests++;
            
            });
        /*/Custom js*/
        $('#div-datepicker').hover(function() {
            //alert(1);
            $('#datepicker').focus();
            unvisibleDatepicker = true;
        }, function() {
            $('#datepicker').blur();
        });
      
      $('.datepicker').hover(function() {
        //alert(2);
          if (unvisibleDatepicker == true) {
              $('#datepicker').focus();
          }
  
          $('.datepicker--cell-day').hover(function() {
            //alert(3);
              if (!$(this).hasClass("-disabled-")) {
                  var month = (parseInt($(this).attr("data-month")) + 1).toString();
                  var day = $(this).text();
  
                  if (day.length == 1) {
                      day = "0" + $(this).text();
                  }
  
                  if (month.length == 1) {
                      month = "0" + (parseInt($(this).attr("data-month")) + 1).toString();
                  }
  
                  if(selectedData.length < 10) {
                      $("#datepicker").val(selectedData + day + "." + month);
                  }
              }
          }, function() {
            //alert(4);
              if (selectedData.length > 5 && selectedData.length < 10) {
                  $("#datepicker").val(selectedData + trans['base.date_arrived']);
              } else if(selectedData.length > 10) {
                  $("#datepicker").val(selectedData);
              } else {
                  $("#datepicker").val("");
              }
          });
      }, function() {
          //alert(4);
          $('#datepicker').blur();
      });
  
  
       var selectorbarheight = $('#selector-bar-id').height() + "px";
       
      $('.overflow-hidden').css("height", selectorbarheight);
  
      var inputwidth = $('#div-datepicker').width() + "px";
      $('.datepicker').css("width", inputwidth);
  
      $('.input-location').click(function() {
          $("#location").val($(this).text());
          /*Custom for send hotelId*/
          $("input[name='article_id']").val($(this).data("id"));
          /*Custom for send hotelId*/

      });
      $("#adults_minus").click(function() {
        diffMaxQuantityGuests--;
          var val = -1 + +$("#adults").val();
          if (val < 0) {
              val = 0;
          }
  
          $("#adults").val(val);
          check_input_guests();
      });
      $("#children_minus").click(function() {
        diffMaxQuantityGuests--;
          var val = -1 + +$("#children").val();
          if (val < 0) {
              val = 0;
          }
          $("#children").val(val);
          check_input_guests();
      });
  
    //   function check_input_guests() {
    //       var adults = $("#adults").val();
    //       var children = $("#children").val();
    //       //console.log('Кількість дорослих  на вході', adults);
    //       //console.log('Кількість дітей  на вході', children);
    //       setPriceAfterEnterGuests(adults, children);
    //       if (adults == "0" && children == "0") {
    //           $("#guests").text(trans['base.count_guestі']);
    //       } else {
    //           $("#guests").text(adults + " " + trans['base.adults_many'] + ", " + children + " " + trans['base.kids']);
    //       }
    //   }
    //   /*Custom js*/

    //   function setPriceAfterEnterGuests(adults, children){
    //       //alert('re');
    //       var sumQuantityGuests = (+adults) + (+children);
    //       //console.log('Cума гостей', sumQuantityGuests);
    //       var baseQuantityGuests =  $('#base_guests').text();          
    //       var surcharge = $('#surcharge').text();
    //       var surcharge_children = $('#surcharge_children').text();
    //       if(sumQuantityGuests > baseQuantityGuests || sumQuantityGuests == baseQuantityGuests){
    //           var diff = baseQuantityGuests - (+adults);
    //           var price = $('span.price').text();
    //           var days = $('.days').text();
    //           var result;
    //           if(diff > 0){
    //               result = Math.abs(diff - (+children)) * surcharge_children;
    //               //console.log('Різниця', result);
    //           }else{
    //               result = (Math.abs(diff) * surcharge) + (children * surcharge_children);
    //               //console.log('Різниця', result);
    //           }
    //           $('p.color-black').text(days * (+(price) + result));
    //           $('.result_price').text(1 * (+(price) + result));
    //       }
    //       //   console.log('Загальна кількість', sumQuantityGuests);
    //       //   console.log('Дорослі', adults);
    //       //   console.log('Діти', children);
    //       //   console.log('Доплата за дорослого', surcharge);
    //       //   console.log('Доплата за дитину', surcharge_children);
    //       //   console.log('Дні', days);
  
  
    //   }
  });
  //end form
  
  //start functions
  function setBookingIcon() {
      $('.booking-icon').css({
          "border-style": "solid",
          "border-color": "#ff8c00",
          "border-width": $("#feature").find(".col-md-3").width() * 0.01,
          "width": $(".bb-toy-thin").height(),
          "border-radius": "50%",
          "color": "#ff8c00",
          "font-size": $(".bb-toy-thin").width() * 0.4,
          "padding": $(".bb-toy-thin").height() * 0.16,
          "line-height": "120%"
      });
  
      $('.booking-icon').css("margin", "auto");
      $('.booking-icon').height($('.booking-icon').width());
  }
  
  function animateValue(id, start, end, duration, step) {
      var range = end - start;
      var current = start;
      var increment = end > start? step : -step;
      var stepTime = Math.abs(Math.floor(duration / range));
      var obj = document.getElementById(id);
  
  
      var timer = setInterval(function() {
          current += increment;
          obj.innerHTML = current;
          if (current == end) {
              clearInterval(timer);
          }
      }, stepTime);
  }
  
  function isScrolledIntoView(elem) {
      var $window = $(window),
          docViewTop = $window.scrollTop(),
          docViewBottom = docViewTop + $window.height(),
          elemTop = $(elem).offset().top,
          elemBottom = elemTop + $(elem).outerHeight();
      return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
  }
  //end functions
  
  $(document).ready(function(){
      setBookingIcon();
      $(".input-location").click(function() {
          $(this).parent().removeClass("add-drop");
      });
  
      $(".input-pattern").mouseover(function() {
          $(this).find(".input-dropdown").addClass("add-drop");
      });
  
      $(".input-pattern").mouseout(function() {
          $(this).find(".input-dropdown").removeClass("add-drop");
      });
  
      if ($('.raty').length) {
        $('.raty').each(function() {
          $(this).raty({
              starOff: 'icon-star-empty',
              starOn: 'icon-star-full',
              starType: 'i',
              hints: ['', '', '', '', ''],
              scoreName: $(this).attr("data-scorename")
          });
        });
      }
  });
  
  $('#datepicker').datepicker({
      range: true,
      minDate: new Date(),
      dateFormat: "dd.mm.yyyy",
      position: "bottom left",
      ignoreReadonly: true,
      autoClose: true,
      onSelect: function() {
          var temp = $("#datepicker").val();
          selectedData = temp;
  
          if (temp.length == 10) {
              $("#datepicker").val($("#datepicker").val() + " - " + trans['base.date_arrived']);
              selectedData += " - ";
  
          } else {
            TODO:
              unvisibleDatepicker = false;
              getDaysIntervalAndCalc();
              getPrices();
            }
        } 
  });
  /* get prices */
  $('.search').on('click', function(){
    var token = $("input[name='csrf-token']").val();
        var range_date = $("#datepicker").val();
        if(range_date){
            var dates = range_date.split("-");
            var dateStart = dates[0];
            var dateFinish = dates[1];
            var days = (daydiff(parseDate(dateFinish), parseDate(dateStart)));
            var price = $('.result_price').text();
            data = {            
                dateStart: dateStart,
                dateFinish: dateFinish                 
            }
            //console.log('range_date', price);
            //var old_price_item = $('.old_price').text(); 
            /*For search page*/
            $('.calc-price').each(function(item, value){
                //console.log('iter', item);
                var token = $("input[name='csrf-token']").val();
                var dataToController = {
                    room_id: $(this).find('.room_id').text(),
                    parent_id: $(this).find('.parent_id').text()
                }
                console.log('_______', dataToController);
                $.ajax({
                    url: '/set_dates',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token              
                    },            
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        console.info('/set_dates data', data);
                        if(data.status === 'success'){
                            
                            console.log('_______', dataToController);
                            $.ajax({
                                url: '/get_prices',
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': token
                                },
                                data: dataToController,
                                dataType: "json",
                                success: function (data) {
                                    console.info('/get_prices', data);
                                    var result = data.data;
                                    if (data.success) {
                                        var discountPrice = $('div#discount[data-attribute-id="' + item + '"]').text();
                                        var days = (daydiff(parseDate(dateFinish), parseDate(dateStart)));
                                        console.log('Дні',days);
                                        console.log('Знижка',discountPrice);
                                        
                                        var priceFinish = result.base_price*days;
                                        console.log('Кінцева ціна',discountPrice);
                                        if(!discountPrice){
                                            $('.apart-total-price[data-id="' + item + '"]').text(priceFinish);

                                        }else{
                                            $('.apart-total-price[data-id="' + item + '"]').text((result.base_price - (result.base_price*discountPrice)/100)*days);
                                        }
                                        $('.old-price-apart[data-attribute-id="' + item + '"]').text(priceFinish);
                                        $('.apart-price-h[data-attribute-id="' + item + '"]').text(result.base_price - (result.base_price*discountPrice)/100);
                                        $('.apart-old-price[data-attribute-id="' + item + '"]').text(result.base_price);

                                        $('[data-class=discount_price]').text(result.base_price - (result.base_price*discountPrice)/100);

                                        // var discountPrice = $('#discount').text();
                                        //$(this).find('.apart-total-price').text('result.base_price');
                                        //price_item = $(this).find('.result_price').text();
                                        //var i = $('.apart-total-price').attr('data-id', item).text(result.base_price*days);
                                       
                                        //$(this).find('.old-price-apart').text(1*old_price_item*days);
                                        // $('[data-class=discount_price]').text(result.base_price - (result.base_price*discountPrice)/100);
                                        // $('#surcharge').text(result.surchange);
                                        // $('#surcharge_children').text(result.surchange_children);
                                        // check_input_guests();
                                    }
                                    // else {
                                    //     alert('Error get Prices 1');
                                                                            
                                    // }
                                },
                                error: function (data) {
                                    console.log('/get_prices', data.message);
                                    alert('Error get Prices 2');
                                }
                
                            }); 
                        }
                    },
                    error: function (data) {
                        alert('Error get Prices 3');
                    }          

                })
                // var old_price_item = $(this).find('.old_price').text();
                // console.log('Стара ціна', old_price_item);
                // price_item = $(this).find('.result_price').text();
                // $(this).find('.apart-total-price').text(1*price_item*days);
                // $(this).find('.old-price-apart').text(1*old_price_item*days);
        
            }) 
        }
         
})
/*/get prices */
  /*Custom js*/
  function getDaysIntervalAndCalc(){
    var range_date = $("#datepicker").val();
    if(range_date){
        var dates = range_date.split("-");
        var dateStart = dates[0];
        var dateFinish = dates[1];
        localStorage.setItem('dateStart', dateStart);
        localStorage.setItem('dateFinish', dateFinish);
        var days = (daydiff(parseDate(dateFinish), parseDate(dateStart)));
        var price = $('.result_price').text();
        //console.log('range_date', range_date);
        //var old_price_item = $('.old_price').text(); 
        /*For search page*/
        $('.calc-price').each(function(){
            var old_price_item = $(this).find('.old_price').text();
            //console.log('Стара ціна', old_price_item);
            price_item = $(this).find('.result_price').text();
            $(this).find('.apart-total-price').text(1*price_item*days);
            $(this).find('.old-price-apart').text(1*old_price_item*days);
    
        }) 
        /*/For search page*/       
         //console.log('Ціна', price);
        $('.days').text(days);
        $('p.color-black').text(days*price);
        //$('.apart-total-price').text('');
        if(days == 1){        
            $('.quantity_days').text(trans['base.cost_one_day']);
            $('.quantity_days_search').text('(' + 1 + " " + trans['base.one_night'] + ')');
        }
        else if(days <= 4){
            $('.quantity_days').text(trans['base.grn'] + ' ' + trans['base.pear'] + " " + days + ' ' + trans['base.more_night']);
            $('.quantity_days_search').text('(' + days + ' ' + trans['base.more_night'] + ')');
        }
        else {
            $('.quantity_days').text(trans['base.grn'] + ' ' + trans['base.pear'] + " " + days + ' ' + trans['base.many_night']);
            $('.quantity_days_search').text('(' + days + ' ' + trans['base.many_night'] + ')');
        }    
        
        $('.date_from').text(dateStart);
        $('.date_to').text(dateFinish);
    }
   
  }
  function parseDate(str) {
    //console.log('Строка', str);
      var mdy = str.split('.');
      return new Date(mdy[2], mdy[1]-1, mdy[0]);
  }
  function daydiff(second, first) {
      return (second-first)/(1000*60*60*24);
  }
  function getDateTimestamp(date){
    myDate=date.split(".");
    var newDate=myDate[1]+"/"+myDate[0]+"/"+myDate[2];
    return dateTs = new Date(newDate).getTime();
  }
  $('#datepicker').data('datepicker');

if (document.getElementById('datepicker')) {
    if ($('.input-pattern').offset().top + $('.input-pattern').height() + $('.datepicker').height() > $(window).innerHeight() + $(window).scrollTop()) {
        $('.datepickers-container').css("top", 0);

        $('.datepickers-container').css("top", $('.datepickers-container').offset().top - $('.datepicker').height() - $('.input-pattern').height());
    }
}

if (document.getElementById('datepicker')) {
    $('.datepicker').click(function() {
        if ($('.input-pattern').offset().top + $('.input-pattern').height() + $('.datepicker').height() > $(window).innerHeight() + $(window).scrollTop()) {
            $('.datepickers-container').css("top", 0);

            $('.datepickers-container').css("top", $('.datepickers-container').offset().top - $('.datepicker').height() - $('.input-pattern').height());
        } else {
            $('.datepickers-container').css("top", 0);
        }
    });
}

$(".input-dropdown").each(function() {
    $(this).css({
        top: 100 + "%"
    });

    if ($(this).offset().top + $(this).outerHeight() > $(window).innerHeight() + $(window).scrollTop()){
        $(this).css({
            top: - $(this).height()
        });
    }
});

var check = true;

$(window).scroll(function() {
    $(".input-dropdown").each(function() {
        $(this).css({
            top: 100 + "%"
        });

        if ($(this).offset().top + $(this).outerHeight() > $(window).innerHeight() + $(window).scrollTop()){
            $(this).css({
                top: - $(this).height()
            });
        }
    });

    if (document.getElementById('datepicker')) {
        if ($('.input-pattern').offset().top + $('.input-pattern').height() + $('.datepicker').height() > $(window).innerHeight() + $(window).scrollTop()) {
            $('.datepickers-container').css("top", 0);

            $('.datepickers-container').css("top", $('.datepickers-container').offset().top - $('.datepicker').height() - $('.input-pattern').height());
        } else {
            $('.datepickers-container').css("top", 0);
        }
    }   

    if (document.getElementById('giant-number')) {
        if (isScrolledIntoView("#giant-number")) {
            if (check == true) {
                check = false;
                animateValue("giant-number", 9821, 10000, 5000, 1);   
            }
        }
    }
});

$(window).resize(function() {
    setBookingIcon();

    var selectorbarheight = $('#selector-bar-id').height() + "px";
    $('.overflow-hidden').css("height", selectorbarheight);

    var inputwidth = $('#div-datepicker').width() + "px";
    $('.datepicker').css("width", inputwidth);  
});

var lastScrollTop = 0;
// element should be replaced with the actual target element on which you have applied scroll, use window in case of no target element.
window.addEventListener("scroll", function(){ // or window.addEventListener("scroll"....
   var st = window.pageYOffset || document.documentElement.scrollTop; // Credits: "https://github.com/qeremy/so/blob/master/so.dom.js#L426"
   if (st > lastScrollTop){
        if (document.getElementById("breadcrumb")) {
            console.log("scrolldown");
            document.getElementById("breadcrumb").classList.add("hided");
        }
   } else {
        if (document.getElementById("breadcrumb")) {
            console.log("scrollup");
            document.getElementById("breadcrumb").classList.remove("hided");
        }
   }
   lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
}, false);
function hideFreedatesBar() {
    document.getElementById('freedates-bar').remove();
} 
function check_input_guests() {
    console.log('check_input_guests');
    var adults = $("#adults").val();
    var children = $("#children").val();
    //console.log('Кількість дорослих  на вході', adults);
    //console.log('Кількість дітей  на вході', children);
    setPriceAfterEnterGuests(adults, children);
    if (adults == "0" && children == "0") {
        $("#guests").text(trans['base.count_guestі']);
    } else {
        $("#guests").text(adults + " " + trans['base.adults_many'] + ", " + children + " " + trans['base.kids']);
    }
}
/*Custom js*/

function setPriceAfterEnterGuests(adults, children){
    console.log('setPriceAfterEnterGuests');
    //alert('re');
    var sumQuantityGuests = (+adults) + (+children);
    //console.log('Cума гостей', sumQuantityGuests);
    var baseQuantityGuests =  $('#base_guests').text();          
    var surcharge = $('#surcharge').text();
    console.log('surcharge',surcharge);
    var surcharge_children = $('#surcharge_children').text();
    console.log('surcharge_children',surcharge_children);
    if(sumQuantityGuests > baseQuantityGuests || sumQuantityGuests == baseQuantityGuests){
        var diff = baseQuantityGuests - (+adults);
        var price = $('span.price').text();
        console.log('цена');
        var days = $('.days').text();
        var result;
        if(diff > 0){
            result = Math.abs(diff - (+children)) * surcharge_children;
            //console.log('Різниця', result);
        }else{
            result = (Math.abs(diff) * surcharge) + (children * surcharge_children);
            //console.log('Різниця', result);
        }
        $('p.color-black').text(days * (+(price) + result));
        $('.result_price').text(1 * (+(price) + result));
    }
    //   console.log('Загальна кількість', sumQuantityGuests);
    //   console.log('Дорослі', adults);
    //   console.log('Діти', children);
    //   console.log('Доплата за дорослого', surcharge);
    //   console.log('Доплата за дитину', surcharge_children);
    //   console.log('Дні', days);


}
function getPrices(){
    var range_date = $("#datepicker").val();
            if(range_date){
                var dates = range_date.split("-");
                var dateStart = dates[0];
                var dateFinish = dates[1];
                // localStorage.setItem('dateStart', dateStart);
                // localStorage.setItem('dateFinish', dateFinish);
                data = {            
                    dateStart: dateStart,
                    dateFinish: dateFinish                 
                }
                var token = $("input[name='csrf-token']").val();
                $.ajax({
                    url: '/set_dates',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token              
                    },            
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        console.info('/set_dates data', data);
                        if(data.status === 'success'){
                            data = {
                                room_id: $('#room_id').text(),
                                parent_id: $('#parent_id').text()
                            }
                            $.ajax({
                                url: '/get_prices',
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': token
                                },
                                data: data,
                                dataType: "json",
                                success: function (data) {
                                    console.info('/get_prices', data);
                                    var result = data.data;

                                    if (data.success) {
                                        var days = (daydiff(parseDate(dateFinish), parseDate(dateStart)));
                                        var discountPrice = $('#discount').text();
                                        $('[data-class=base_price]').text(result.base_price);
                                        $('[data-class=discount_price]').text(result.base_price - (result.base_price*discountPrice)/100);
                                        $('#surcharge').text(result.surchange);
                                        $('#surcharge_children').text(result.surchange_children);
                                        //TODO::fix 28.10.2018
                                        $('p.color-black').text(days*result.base_price);
                                        if(!discountPrice){
                                            $('p.color-black').text(days*result.base_price);

                                        }else{
                                            $('p.color-black').text((result.base_price - (result.base_price*discountPrice)/100)*days);
                                        }
                                        check_input_guests();
                                    }
                                    // else {
                                    //     alert('Error get Prices 1');
                                                                            
                                    // }
                                },
                                error: function (data) {
                                    console.log('/get_prices', data.message);
                                    alert('Error get Prices 2');
                                }
                
                            }); 
                        }
                    },
                    error: function (data) {
                        alert('Error get Prices 3');
                    }          

                })
            }
}

