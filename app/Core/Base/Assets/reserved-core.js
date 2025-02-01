

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));



$(document).ready(function() {
    account = JSON.parse(sessionStorage.getItem('account'));
    $("#profile-picture").attr("src", "/img/profile-pictures/"+account.image );
    
    
    identity = JSON.parse(sessionStorage.getItem('identity'));
    if(!identity){
        fetch('/api/settings/identity')
        .then(response => response.json())
        .then(response => {
            if(response.success && response.data.identity){
                identity = response.data.identity;
                sessionStorage.setItem('identity', JSON.stringify(identity));
            }else{
                throw new Error(response.error);
            }
        });
    }

    
    identity = JSON.parse(sessionStorage.getItem('identity'));
    console.log(identity);
    $("#sidebar-logo").attr("src", identity.logo );
    $(".sidebar-logo-loading").hide();
});





function isGranted(section, operation) {
    const permissions = JSON.parse(sessionStorage.getItem('userPermissions'));
    if (permissions && permissions[section] && permissions[section][operation]) {
        return true;
    }
    return false;
}
