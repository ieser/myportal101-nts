<tr class="pointer border-bottom border-dashed" data-id="<?=$user->id;?>"> 
    <td class="align-middle">
        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
            <input class="form-check-input linked-user-check" type="checkbox" name="users[]" value="<?=$user->id;?>">
        </div>
    </td>
    <td class="d-flex align-items-center py-2">
        <div class=" me-3">
            <a href="/user/show/<?=$user->id;?>">
                <div class="profile-picture">
                    <?php if(empty($user->image)){ ?> 
                        <?=substr($user->lastname,0,1);?>
                    <?php }else{ ?>
                        <img src="/img/profile-pictures/<?=$user->image;?>" alt="Profile picture of <?=$user->lastname;?>" class="w-100">
                    <?php } ?>
                </div>
            </a>
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