var pathSegments = window.location.pathname.split('/');
var mouldCode = pathSegments[pathSegments.length - 1]; 



$( document ).ready(function() {


    if (isGranted('moulds', 'add')) {
        $("#add-warranty-modal-trigger").show();
    }

    
    fetch('/api/moulds/'+mouldCode)
    .then(response => response.json())  
    .then(response => { 
        if (response.success) { 
            
            const mould = response.data.mould;
            $("#mould-name").val(mould.No_);
            $("#mould-description").val(mould.Description);
        } else {
            $("#mould-details").hide();
            $("#mould-loading-error").show();
        }
    })
    .catch(error => {
        $("#mould-details").hide();
        $("#mould-loading-error").show();
        console.error('Errore nel recupero degli stampi:', error);
    });


    
    fetch('/api/moulds/'+mouldCode+'/warranties')
    .then(response => response.json())  
    .then(response => { 
        if (response.success) { 
            
            const warranties = response.data.warranties;
            if (warranties.length === 0) {
                $("#warranties-loading-list").hide();
                $("#warranties-no-records").show();
            }else{
                $("#warranties-loading-list").hide();
                $("#warranties-table").show();
                $("#warranties-list").show();
                $.each(warranties, function(key, warranty) {
                    const row = generateWarrantyRow(warranty); 
                    $("#warranties-list").append(row);
                });
            }
        } else {
            $("#warranties-table").hide();
            $("#warranties-loading-error").show();
        }
    })
    .catch(error => {
        $("#warranties-loading-list").hide();
        $("#warranties-table").hide();
        $("#warranties-loading-error").show();
        console.error('Errore nel recupero delle garanzie stampi:', error);
    });

});



function generateWarrantyRow(warranty){
    if (!warranty || !warranty.id|| !warranty.start_date || !warranty.guaranteed_part || !warranty.guaranteed_strokes) {
        console.error("Dati garanzia incompleti:", warranty);
        return null; 
    }
    row = $("#warranty-example").clone();
    row.attr('id', ''+ warranty.id);
    row.attr("data-id", warranty.id);
    row.find(".warranty-start_date").html(warranty.start_date);
    row.find(".warranty-start_strokes").html(warranty.start_strokes);
    row.find(".warranty-guaranteed_part").html(warranty.guaranteed_part);
    row.find(".warranty-guaranteed_strokes").html(warranty.guaranteed_strokes);
    row.show();
    return row; 
}


$(document).on("click","#add-warranty-button",function() {
    const addwarrantyform = document.querySelector("#add-warranty-form");
    dataForm = new FormData(addwarrantyform);
    
    fetch('/api/moulds/'+mouldCode+'/warranties/', {
        method: "POST",
        body: dataForm
    })
    .then(response => response.json())  
    .then(response => { 
        if (response.success) { 
            const warranty = response.data.warranty;
            const row = generateWarrantyRow(warranty); 
            $("#warranties-list").append(row);
            $("#warranties-no-records").hide();
            $("#warranties-table").show();
            $("#warranties-list").show();
            $("#add-warranty-modal").modal("hide");
            $("#add-warranty-form input").val();
        }

    });
});


$(document).on("change", "#add-warranty-modal #total-guarantee",function() {
    isTotal = $(this).prop("checked");
    $(document).find("#add-warranty-modal #guaranteed-part-input-block").toggleClass("d-none", isTotal);
});