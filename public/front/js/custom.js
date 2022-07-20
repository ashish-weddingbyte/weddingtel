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


    

    
});