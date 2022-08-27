$('document').ready(function(){

    // $('#login-form').on('change',function(){
    //     var form = $('input[name="login"]:checked').val();
    //     if(form == 'otp'){
    //         $('.email-section').hide();
    //         $('.mobile-section').show();
    //         $('#login-type').val('otp');
    //     }
    //     if(form == 'email'){
    //         $('.email-section').show();
    //         $('.mobile-section').hide();
    //         $('#login-type').val('email');
    //     }
    // });



    // login ajax code.
    // $('#login-form').on('submit',function(event){
    //     event.preventDefault();

    //     $('#email-error').text('');
    //     $('#password-error').text('');
    //     $('#mobile-error').text('');
        
    //     var data = $('#login-form').serialize();
    //     var path = $('#path').val();

    //     $.ajax({
    //         url: path,
    //         type: "POST",
    //         data:data,
    //         success:function(response){
    //             // console.log(response);
    //             // alert(response);

    //         },
    //         error: function(response) {
    //             console.log(response);
    //             $('#email-error').text(response.responseJSON.errors.email);
    //             $('#password-error').text(response.responseJSON.errors.password);
    //             $('#mobile-error').text(response.responseJSON.errors.mobile);
    //         }   
    //     });

    // });


    // code for resend otp 30 seconde timer.
    // var time_limit = 40;
    // var time_out = setInterval(() => {
    //     if(time_limit == 0) {
    //         $('#otp_timer').html('Time Over');
    //     } else {            
    //         if(time_limit < 10) {
    //             time_limit = 0 + '' + time_limit;
    //         }
    //         $('#otp_timer').html('00:' + time_limit);
    //         time_limit -= 1;
    //     }
    // }, 1000);

    
      
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.submit',this).on('submit', function(event){
        
        event.preventDefault();
        var url = $(this).attr('data-action');
        var form_data = $(this).serialize();

        $.ajax({
            url: url,
            method: 'POST',
            data: form_data,
            success:function(response)
            {
                // console.log(response);
                // alert(response);
                location.reload();   
            },
            error: function(response) {
                // console.log(response);
                $('.print-error-msg').empty();
                var errors = response.responseJSON.errors;
                var str = "";
                $.each(errors, function(key,value){
                    str += '<p>' + value + '</p>' // build the list
                });
                $('.print-error-msg').append(str);

            }
        });
    });



    $('.upcoming-task input[type=checkbox]').click(function () {
        var status = $(this).attr('data-status');
        var id = $(this).attr('data-id');
        var url = $(this).attr('data-action');

        $.ajax({
            url: url,
            method: 'POST',
            data: {id:id,status:status},
            success:function(response)
            {
                if(response.status == '0') {
                    $('#customCheck-'+id).next().addClass("checked-label-text");
                }else{
                    $('#customCheck-'+id).next().removeClass("checked-label-text");
                }  
            },
            error: function(response) {
                // console.log(response);
            }
        });
        
    });


    $('.open-modal-check').click(function(){
        $('.print-error-msg').empty();
    });


    
    $(function() {
        // Multiple images preview with JavaScript
        var previewImages = function(input, imgPreviewPlaceholder) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                }
                reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#gallery').on('change', function() {
        previewImages(this, 'div.images-preview-div');
        });
    });

});

