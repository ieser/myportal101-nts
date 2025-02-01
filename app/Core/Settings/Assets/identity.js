$(document).ready(function () {
    fetch('/api/settings/identity')
    .then(response => response.json())  
    .then(response => { 
        if(response.success){
            $("#identity-loading").hide();
            $("#identity-content").show();
            if(!response.data.identity){
                throw new Execption("Identity not found")   
            }
            identity = response.data.identity;
            if(identity.title){
                $("#identity-title").val(identity.title);
            }
            
            if(identity.logo){
               // $("#identity-logo").val(identity.logo);
                $("#identity-logo-img").attr("src", identity.logo);
                $("#identity-logo-img").data("current", identity.logo);
            }
        }
    })
    .catch(error => {
        console.error('Errore nel recupero delle impostazioni correnti:', error);
        $("identity-loading").hide();
        $("identity-error").show();
    });

});   

//Reset logo preview 
$(document).find("#identity-form").on('reset', function(event) {
    current = $("#identity-logo-img").data("current");
    $("#identity-logo-img").attr("src", current);
    
});


//Create logo preview
$(document).find("#identity-logo").on('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        $('#identity-logo-img').attr("src",URL.createObjectURL(file));
    }
});

//Create logo preview
$(document).find("#identity-form").on('submit', function(event) {
    event.preventDefault();

    const form = $(this)[0]; 
    const formData = new FormData(form);
    
    
    fetch('/api/settings/identity', {
        method: form.method || 'POST', 
        body: formData, 
    })
    .then(response => response.json())  
    .then(response => { 
        if (response.success) { 
            $(".identity-success").show();
            $(".identity-error").hide();
        }else{
            throw new Exception("Response not succeded");
        }
        
    })
    .catch(error => {
        $(".identity-success").hide();
        $(".identity-error").show();
        console.error('Errore nel recupero degli utenti:', error);
    });
});

   

