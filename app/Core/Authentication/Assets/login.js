
$("#login-button").click(function(){
    $(".spinner-grow").show();
    $(".continue").hide();

    const loginform = document.querySelector("#login-form");
    dataForm = new FormData(loginform);
    dataForm.set("password", $.md5(dataForm.get("password")));

    fetch('/api/auth/login', {
        method: "POST",
        body: dataForm
    })
    .then(response => response.json())  
    .then(response => { 
        
        if(response.success){
            data = response.data;
            $("#login").toggleClass("btn-danger", false).toggleClass("btn-success", true);
            $("#loginform input").addClass("is-valid");
            sessionStorage.setItem('account', JSON.stringify(data.account));
            sessionStorage.setItem('privileges', JSON.stringify(data.account.privileges));
            if($("#remember-me").is(':checked')){
                localStorage.setItem('authToken', data.authToken);
            }else{
                sessionStorage.setItem('authToken', data.authToken);
            }
            window.location.replace(data.reroute);
        }else{
            throw new Error(response.error);
        }
    }).catch(error => {
        error = error.message;
        $("#login-button").toggleClass("btn-danger", true);
        $(document).find("#login-form .invalid-feedback").hide();

        if(error == "css-detected"){
            $("#email").addClass("is-invalid");
            $(document).find("#css-detected-feedback").show();

        }else if(error == "invalid-email"){
            $("#email").addClass("is-invalid");
            $(document).find("#invalid-email-feedback").show();

        }else if(error == "login-incorrect"){
            $("#email").addClass("is-invalid");
            $("#password").addClass("is-invalid");
            $(document).find("#login-incorrect-feedback").show();
        }else{
            $("#email").addClass("is-invalid");
            $("#password").addClass("is-invalid");
            $(document).find("#login-incorrect-feedback").show();
            console.error("Errore sconosciuto:", error);
        }
    });
        
});


$("#show-password").click(function(){
    if($("#password").attr("type") == "password"){
        $("#password").attr("type", "text");
        $('#show-password i').addClass( "fa-eye-slash" ).removeClass( "fa-eye" );
    }else{
        $("#password").attr("type", "password");
        $('#show-password i').addClass( "fa-eye" ).removeClass( "fa-eye-slash" );
    }

});

$("#email, #password").keyup(function(){
    $("#login").toggleClass("btn-danger", false);
    $("#loginform input").removeClass("is-invalid");
    $("#loginform input").removeClass("is-valid");

});

const token = localStorage.getItem('authToken');
if (token) {
    dataForm = new FormData();
    dataForm.set("token", token);
    fetch('/api/auth/token', {
        method: 'POST',
        body: dataForm
    })
    .then(response => response.json())
    .then(response => {
        if(response.success){
            data = response.data;
            console.log("Token valido");
            $("#login").toggleClass("btn-danger", false).toggleClass("btn-success", true);
            $("#loginform input").addClass("is-valid");
            sessionStorage.setItem('account', JSON.stringify(data.account));
            sessionStorage.setItem('privileges', JSON.stringify(data.account.privileges));
            window.location.replace(data.reroute);
        }else{
            console.log("Token expired");
            localStorage.removeItem('authToken');
            throw new Error(response.error);
        }
    });
} else{
    console.log("No token found");
}


fetch('/api/auth/oauth-enabled')
.then(response => response.json())
.then(response => {
    if(response.success && response.data.oauths){
        $.each(response.data.oauths, function( index, value ) {
            $.each(value, function( destination, enabled ) {
                if(!enabled){
                    $("#login-"+destination).remove();
                }
            });
        });
    }else{
        throw new Error(response.error);
    }
});



            