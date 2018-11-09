jQuery(document).ready(function($) {
    $(function () {
    /*Add review*/ 
    $('.send_review').click(function(e){
        alert('Тут');
        e.preventDefault();        
        //e.preventDefault();
        var data = $('form.add_review').serialize();

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
})
})
function saveLocalStorage(){
    localStorage.setItem('dateStart', dateStart);
    localStorage.setItem('dateFinish', dateFinish);
    localStorage.setItem('adults', adults);
    localStorage.setItem('children', children);
}

