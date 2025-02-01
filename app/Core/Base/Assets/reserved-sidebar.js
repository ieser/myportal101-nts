

if($("#sidebar").length){
    $("#sidebar").find(".nav-item").each(function( index ) {
        this.hide;
    });
}

function setSidebarSize(){
    isBig = $(window).width() > 768;
    isActive = $('#sidebar').hasClass('active');
    if( isActive == isBig){ 
        //Sidebar chiusa
        $('#sidebarTrigger').addClass('active');
        $('#sidebarTrigger').addClass('fa-caret-right').removeClass("fa-caret-left");
        $('.nav-voice').hide();
        $('.nav-link').addClass('text-center');
    }else{
        //Sidebar aperta
        $('#sidebarTrigger').removeClass('active');
        $('#sidebarTrigger').addClass('fa-caret-left').removeClass("fa-caret-right");
        $('.nav-voice').show();
        $('.nav-link').removeClass('text-center');
    }
}

function setSidebarActive(){
    active = $('#sidebar-active').html();
    $("#sidebar-"+active).toggleClass("active"); 
    $("#dropdown-"+active).toggleClass("show"); 

}

$(document).ready(function () {
    setSidebarSize();
    setSidebarActive();


    $(window).resize(function(){
        setSidebarSize();  
    })

    $('#sidebar .nav-link').on('click', function () {
        setSidebarActive();        
    });

    $('#sidebar .dropdown-trigger').on('click', function () {
        target = $(this).data("dropdown");   
        $("#dropdown-"+target).toggleClass("show"); 
    });


    $('#sidebarTrigger').on('click', function () {

        $('#sidebar').toggleClass('active');
        $('#sidebar .collapse.show').collapse("hide");        
        setSidebarSize();
    }); 
});