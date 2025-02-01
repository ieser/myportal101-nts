<div class="modal" tabindex="-1" id="add-to-group-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=$tr_userAddToGroupTitle;?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-body">
                <form id="add-to-group-form">
                    <input type="hidden" name="idUser" value="<?=$user->id;?>">
                    <div class="row ">  
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="add-idGroup" name="idGroup" required>
                                    <option value="" disabled selected></option>
                                    <?php foreach($groups as $group){ ?> 
                                        <option value="<?=$group->id;?>"><?=$group->name;?></option>
                                    <?php } ?>
                                </select>
                                <label for="add-idGroup">Seleziona un gruppo</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <span class="error" style="display:none">Error</span>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?=$tr_cancel;?></button>
                <button type="button" class="btn btn-yellow" id="add-to-group-button">
                    <span class="loading spinner-grow spinner-grow-sm" style="display:none"></span>
                    <span class="finished"><?=$tr_add;?></span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
        
    $("#add-to-group-button").click( function () {
        idtemplate = $(this).val();
        $.ajax({
            type: 'POST', 
            url: '/user/assign', 
            dataType: "json",
            data: $("#add-to-group-form").serialize(),
            success: function(response){ 
                if(response.status == "success"){
                    $("#add-to-group-modal").modal("hide");
                    $.each(response.html, function (index, item) { 
                        $(item.appendTo).append(item.html);
                    });
                }
            }
        });
    });
        
</script>