

<div class="modal fade" id="link-user-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=$tr["link-user-to-group"];?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="link-user-form" accept-charset="UTF-8" enctype="multipart/form-data">  
                    <input type="hidden" name="id" value="<?=$group->id;?>">
                    <div class="row ">  
                        <table class="table">  
                            <tr> 
                                <td class="align-middle">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input link-user-check" type="checkbox" name="users[]" value="<?=$user->id;?>">
                                    </div>
                                </td>
                                <td class="d-flex align-items-center py-2">
                                    <div class=" me-3">
                                        <div class="profile-picture">
                                            <?php if(empty($user->image)){ ?> 
                                                <?=substr($user->lastname,0,1);?>
                                            <?php }else{ ?>
                                                <img src="/img/profile-pictures/<?=$user->image;?>" alt="Profile picture of <?=$user->lastname;?>" class="w-100">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="/user/show/<?=$user->id;?>" class="mb-1"><?=$user->name;?> <?=$user->lastname;?></a>
                                        <span><?=$user->email;?> </span>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <?php if($user->active){ ?> 
                                        <small class="d-inline-flex px-2 py-1 fw-semibold text-success-emphasis bg-success-subtle border border-success-subtle rounded-2">Attivo</small>
                                    <?php }else{ ?> 
                                        <small class="d-inline-flex px-2 py-1 fw-semibold text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-2">Disabilitato</small>
                                    <?php } ?>
                                </td>
                            </tr>
                        <table>  
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?=$tr["cancel"];?></button>
                <button type="button" class="btn btn-yellow" id="link">
                    <span class="spinner-grow" style="display:none"></span>
                    <span class="insert"><?=$tr["assign-user-to-group"];?></span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>

</script>
                  