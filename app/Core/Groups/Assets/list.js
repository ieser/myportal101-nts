
$(document).ready(function(){
});
$(".edit-group").click(function(){
    id = $(this).parents("tr").data("id");
    $.ajax({
        type: 'POST', 
        url: '/group/details', 
        dataType: "json",
        data: {"id" : id},
        success: function(response){ 
            if(response.status == "success"){
                $("#edit-modal").modal("show");
                $.each(response.data, function (index, item) { 
                    $("#edit-"+index).val(item);
                });
            }
        }
    });
});
$(".delete-group").click(function(){
    id = $(this).parents("tr").data("id");
    $.ajax({
        type: 'POST', 
        url: '/group/delete', 
        dataType: "json",
        data: {"id" : id},
        success: function(response){ 
            if(response.status == "success"){
                $("tr[data-id='"+id+"']").remove();
            }
        }
    });
});



async function getGroups() {
    const response = await fetch('/api/groups');
    const resp = await response.json();
    groups = resp.groups; 
    return groups;
}
async function getGroupPrivileges(group) {
    const response = await fetch('/api/groups/'+group+'/privileges');
    const privileges = await response.json();
    return privileges;
}


$("button#edit").click( function () {
    $.ajax({
        type: 'POST', 
        url: '/group/edit', 
        dataType: "json",
        data: $("#edit-form").serialize(),
        success: function(response){ 
            if(response.status == "success"){
                $("#edit-modal").modal("hide");
                $.each(response.html, function (index, item) { 
                    $("tr[data-id='"+id+"']").replaceWith(item.html);
                });
            }
        }
    });
});
$("button#link").click(function(){
    $(".spinner-grow").show();
    $(".insert").hide();
    $.ajax({
        url: "/group/assign",
        type: "POST",
        dataType: "json",
        data: $("form#link-user-form").serialize()
    }).done(function(resp){
        if(resp.status == "success"){
            $.each(resp.html, function (index, item) { 
                $(item.appendTo).append(item.html);
            });
            $("#link-user-modal").modal("hide");
            $("input.link-user-check:checked").parents("tr").remove();
            $("#no-user-in-group").hide();
        }else{
            $("#add").toggleClass("btn-danger", true);
        }
        $(".spinner-grow").hide();
        $(".insert").show();
    });
});
$("button#add").click(function(){
    $(".loading").show();
    $(".finished").hide();
    $.ajax({
            url: "/group/add",
            type: "POST",
            dataType: "json",
            data: $( "#add-form" ).serialize() 
        }
    ).done(
        function(resp){
            if(resp.status == "success"){
                $.each(resp.html, function (index, item) { 
                    $(item.appendTo).append(item.html);
                });
                $("#add-modal").modal("hide");
            }else{
                $(".error").html(resp.message).show();
                $("button#continue").removeClass("btn-yellow").addClass("btn-error").prop("disabled",true);

            }
        }
    ).fail(function(){
        $("button#continue").removeClass("btn-yellow").addClass("btn-danger");
        $(".error").html("Errore sconosciuto").show();

    });
});
