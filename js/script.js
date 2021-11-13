$(function () {
    $('.header_nav_auth_btn').click(function () {
        if(!$('.dark_background').hasClass('open')){ 
            $('.dark_background').addClass(' open');
            $('.enter').addClass(' open');
        }
    })

    $('.sign_in').click(function () {
        if(!$('.enter').hasClass('open')){ 
            $('.enter').addClass(' open');
        }        
        if($('.registration').hasClass('open')){ 
            $('.registration').removeClass(' open');
        }
    })

    $('.sign_up').click(function () {
        if(!$('.registration').hasClass('open')){ 
            $('.registration').addClass(' open');
        }        
        if($('.enter').hasClass('open')){ 
            $('.enter').removeClass(' open');
        }
    })

    $('.close').click(function () {
        $('.dark_background').removeClass(' open');
        if($('.enter').hasClass('open')){ 
            $('.enter').removeClass(' open');
        }
        if($('.registration').hasClass('open')){ 
            $('.registration').removeClass(' open');
        }
      });

    $('.add_content_btn').click(function(){
        lastId = $('.photo_card').filter(':last').attr('data-id');
        lastLine=$('.main_photos_row').filter(':last');
        $.ajax({
            url:'/page_script.php?lastId=' + lastId,  
            method: 'get',             /* Метод передачи (post или get) */
            dataType: 'html',
            success:function(data){
                lastLine.after(data);
            }
        });
    });
});

    $('.dark_background').mouseup(function (e) {
        let modal_win = $(".modal_win");
        if (!modal_win.is(e.target) && modal_win.has(e.target).length === 0) {
            $('.dark_background').removeClass(' open');
            if($('.enter').hasClass('open')){ 
                $('.enter').removeClass(' open');
            }
            if($('.registration').hasClass('open')){ 
                $('.registration').removeClass(' open');
            }
        }
    });

    

function pwd_validation(pwd){
    let amount_Nan=0;
    const pwd_len = pwd.length;
    for(var i=0; i<pwd_len; i++){
        if(isNaN(pwd[i])){
            amount_Nan++;
        }
    }
    num_amount=pwd_len-amount_Nan;
    if(pwd_len>num_amount){
        return true;
    }
    alert('Password can not be without letters');
    // pwd.focus();
    return false;
}

// function email_validation(email){
//     var mailformat = /^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-0-9A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/;
//     if(email.value.match(mailformat)){
//         return true;
//     }
//     else{
//         alert("You have entered an invalid email address!");
//         email.focus();
//         return false;
//     }
// }

// function phone_validation(phone){
//     var phoneformat= /^(\s*)?(\+)?([- _():=+]?\d[- _():=+]?){10,14}(\s*)?$/;
//     if(phone.value.match(phoneformat)){
//         return true;
//     }
//     else{
//         alert('Phone is not correct!');
//         phone.focus();
//         return false;
//     }
// }

function password_repeat_validation(pwd, pwd_repeat) {
    if(pwd==pwd_repeat){
        return true;
    }
    alert('Passwords are not equal!');
    // pwd_repeat.focus();
    return false;
}

function formValidation(){
    if($('.registration').hasClass('open')){
        var login = document.registration.login.value;
        var pwd = document.registration.password.value;
        // var pwd_repeat=document.registration.password_repeat;
        var email = document.registration.email.value;
        var phone = document.registration.phone.value;
        // console.log(login+' '+pwd+' '+email+' '+phone);
        if(pwd_validation(pwd)){
            if(password_repeat_validation(pwd, pwd_repeat)){
                console.log(login+' '+pwd+' '+email+' '+phone);
            }
        }
    }
    if($('.enter').hasClass('open')){
        var login = document.enter.login.value;
        var pwd = document.enter.password.value;
        // console.log(login+' '+pwd);
        if(pwd_validation(pwd)){
            console.log(login+' '+pwd);
        }
    }
    return false;
}