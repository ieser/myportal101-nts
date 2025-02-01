<div class="row">
    <div class="col">
        <div class="card bg-body p-3">
            <table class="table table-hover" id="groups-list">
                <thead>
                    <tr>
                        <th scope="col"><?=$tr["group-name"];?></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-bottom border-dashed" data-id="" id="group-row-example" style="display:none;"> 
                        <td class="align-middle group-name"><a href="/group/show/"></a> </td>
                        <td class="py-2 text-end">
                            <div class="dropdown">
                                <button type="button" class="btn btn-yellow dropdown-toggle" data-bs-toggle="dropdown" >Azioni</button>
                                <ul class="dropdown-menu fw-semibold fs-7">
                                    <li>
                                        <button type="button" class="dropdown-item p-3 edit-group" >Modifica</button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item p-3 delete-group" >Elimina </button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>