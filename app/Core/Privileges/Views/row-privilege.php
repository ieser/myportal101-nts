<tr>
    <td>
        <p class="ps-2">
            <?=$privilege["name"];?>
        </p>
    </td>
    <?php foreach ($groups as $group) { ?>
        <td>
            <div class="d-flex justify-content-center">
                <div class="form-check form-switch">
                    <input class="form-check-input privilege-switch" type="checkbox" role="switch" data-group="<?=$group->id;?>" data-section="<?=$section;?>"  data-privilege="<?=$privilege["id"];?>">
                </div>
            </div>
        </td>
    <?php } ?>
</tr>