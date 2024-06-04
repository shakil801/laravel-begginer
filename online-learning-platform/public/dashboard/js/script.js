$(document).ready(function(){
    $("#login").on('click',function(e){
        e.preventDefault();
        let username = $("#username").val();
        let password = $("#password").val();
        let rememberMe = $("#remember-me").is(':checked');
        $.ajax({
            url:'/login',
            type:'POST',
            dataType:'JSON',
            data:{username:username,password:password,rememberme:rememberMe},
            beforeSend: function(xhr) {
                // Add CSRF token to headers
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            },
            success:function(response){
                console.log(response.message);
            }
        });
    });

    $("#signup").on('click',function(e){
        e.preventDefault();
        let username = $("#username").val();
        let email = $("#email").val();
        let password = $('#password').val();
        $.ajax({
            url: '/signup',
            type: 'POST',
            dataType: 'JSON',
            data: {
                username: username,
                password: password,
                email: email
            },
            beforeSend: function(xhr) {
                // Add CSRF token to headers
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            },
            success:function(response){
                console.log(response.message);
            }
        });

    });
});