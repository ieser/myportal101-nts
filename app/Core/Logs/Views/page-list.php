<div class="container">
    <div class="card bg-body">
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="form-floating">
                        <input type="text" class="form-control src" data-target="logs-list" placeholder=" ">
                        <label><i class="fas fa-search "></i><?=$tr_searchLogs;?></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 table-responsive" id="logs-list">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Data</th>
                            <th scope="col">Utente</th>
                            <th scope="col">Azione</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="log-example" style="display:none">
                                <td scope="row"></td>
                                <td scope="row"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>