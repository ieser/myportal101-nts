function confirmDialog(handler){
    var message 
    if(message){
        $("#confirm-modal #confirm-modal-message").html(message);
    }
    $("#confirm-modal").modal("show");
    
    $("#confirm-modal #confirm-modal-yes").click(function () {
        handler(true);
        $("#confirm-modal").modal("hide");
    });
    
    $("#confirm-modal  #confirm-modal-no").click(function () {
        handler(false);
        $("#confirm-modal").modal("hide");
    });
}