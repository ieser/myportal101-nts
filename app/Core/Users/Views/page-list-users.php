<div class="card bg-body">
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-12 col-md-6 mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-search "></i></span>
                    <input type="text" class="form-control" id="search-users" data-target="#users-list" placeholder="<?=$tr["search-user"];?>">
                </div>
            </div>
            <div class="col-12 col-md-6 mb-3 d-grid">
                <div class="btn btn-primary btn-block ms-md-auto">
                    <i class="fas fa-plus-square "></i>
                    <span>CREA UTENTE</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12" id="users-loading-error" style="display:none;"><p><?=$tr["error-while-loading-users"];?></p></div>
            <div class="col-12 table-responsive" id="users-list">
                <table class="table" >
                    <thead>
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class=""><?=$tr["user"];?></th>
                            <th class=""><?=$tr["last-login"];?></th>
                            <th class=""><?=$tr["user-status"];?> </th>
                            <th class="text-center"><?=$tr["date-registration"];?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-body-secondary" id="loading-list"><td colspan="6" style="height:50px;"></td></tr>
                        <tr id="no-records" style="display:none"><td colspan="6"><?=$tr["no-user-found"];?></td></tr>
                        <tr class="pointer border-bottom border-dashed" data-href=""  id="user-row-example" style="display:none;"> 
                            <td class="d-flex align-items-center py-2">
                                <div class="profile-picture me-3">
                                    <img src="/img/profile-pictures/default.webp" class="w-100">
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fullname text-primary mb-1"></span>
                                    <span class="email"></span>
                                </div>  
                            </td>
                            <td><span class="badge text-bg-secondary last-login-ago"></span> </td>
                            <td>
                                <small class="d-inline-flex px-2 py-1 fw-semibold text-success-emphasis bg-success-subtle border border-success-subtle rounded-2 active d-none">Attivo</small>
                                <small class="d-inline-flex px-2 py-1 fw-semibold text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-2 disabled d-none">Disabilitato</small>
                            </td>
                            <td class="date-insert text-center"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>