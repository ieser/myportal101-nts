
$( document ).ready(function() {

    fetch('/api/auth/logout', {
        method: "POST"
    }).then(response => { 
        
        if(response.ok){
            $("#logout-spinner").hide();
            $("#logout-confirmation").show();
            sessionStorage.removeItem('account');
            sessionStorage.removeItem('privileges');
            sessionStorage.removeItem('authToken');
            localStorage.removeItem('authToken');
            setTimeout(1000,
                window.location.replace("/login")
            );
            
        }else{
            return response.json().then(error => {
                throw new Error(error.response); 
            });
        }
    }).catch(error => {
    });
        
});
