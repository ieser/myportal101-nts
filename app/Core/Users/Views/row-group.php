
<tr>
    <td><?=$group->id;?></td>
    <td><?=$group->name;?></td>
    <td class="text-end">
        <a href="/group/show/<?=$group->id;?>" class="ms-1"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
        <a href="#" role="button" class="unassign ms-1" data-group="<?=$group->id;?>" data-user="<?=$user->id;?>"><i class="fa-solid fa-trash text-danger"></i></a>
    </td>
</tr>   