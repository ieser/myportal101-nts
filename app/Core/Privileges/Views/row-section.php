
<tr>
    <td class="bg-body-tertiary ms-2 fw-bold" data-section="<?=$section["slug"];?>"><?=$section["name"];?></td>
    <?php foreach ($groups as $group) { ?>
        <td class="bg-body-tertiary">
            <div class="d-flex justify-content-center">
                <div class="form-check form-switch">
                    <input class="form-check-input section-switch" type="checkbox" role="switch" id=""  data-group="<?=$group->id;?>" data-section="<?=$section["slug"];?>">
                </div>
            </div>
        </td>
    <?php } ?>
</tr>
<?php foreach ($section["privileges"] as $privilege) { ?>
    <?php $page->display("privileges/row-privilege", array("privilege" => $privilege,"section"=> $section["slug"], "groups"=>$groups)); ?>
<?php } ?>