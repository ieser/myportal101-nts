<div class="container">
    <div class="row">
        <div class="col-12 col-lg-3 col-xl-3">
            <div class="card mb-4">
                <div class="card-body">
                    <h5><?=$group->name;?> </h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-9 col-xl-9"> 
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search "></i></span>
                                <input type="text" class="form-control src" data-target="#users-list" placeholder="<?=$tr_groupSearchUser;?>">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 text-end mb-4">
                            <button type="button" class="btn btn-warning ms-auto" data-bs-toggle="modal" data-bs-target="#link-user-modal"><i class="fa-solid fa-plus me-2"></i><?=$tr_groupsLinkUser;?></button>
                        </div>
                    </div>
                    <div class="row" id="actionButtons" style="display:none">
                        <div class="col-12 col-md-6 mb-4">
                            <button type="button" class="btn btn-danger" id="unlink-users-button"><i class="fa-solid fa-link-slash me-2"></i><?=$tr_groupsRemoveUsers;?></button>
                        </div>
                    </div>
                    <div class="row">
                        <form id="unlink-users-form">
                            <input type="hidden" name="id" value="<?=$group->id;?>">
                            <table class="table" id="users-list">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($group->users)==0){?> 
                                        <tr id="no-user-in-group"><td colspan="4"><?=$tr_groupsNoUserAssigned;?> </td></td>
                                    <?php } ?>
                                    <?php foreach($group->users as $user){ ?>
                                        <?php $page->display("groups/row-user", array("user" => $user)); ?> 
                                    <?php } ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".linked-user-check").change(function(){
        if( $("input.linked-user-check:checked").length == 0){
            $("#actionButtons").hide();
        }else{
            $("#actionButtons").show();
        }
    });

    $("button#unlink-users-button").click(function(){
        var returnVal = confirm("Are you sure?");
        if(returnVal){
            $.ajax({
                url: "/group/unassign",
                type: "POST",
                dataType: "json",
                data: $("form#unlink-users-form").serialize()
            }).done(function(resp){
                if(resp.status == "success"){
                    $("input.linked-user-check:checked").parents("tr").remove();
                    if($("#users-list tr:not(#no-user-in-group").length == 0){
                        $("#no-user-in-group").show();
                    }
                }
            });
        }
    });
</script>