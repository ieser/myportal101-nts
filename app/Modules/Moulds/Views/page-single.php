<div class="container">
    <div class="card bg-body mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h4>Dettagli</h4> 
                </div>
                <div class="col-12" id="mould-details">
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="mould-name" placeholder="Codice">
                                <label for="mould-name"><?=$tr["mould-code"];?></label>
                            </div>
                        </div>
                        <div class="col-12 mb-3 ">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="mould-description" placeholder="Descrizione">
                                <label for="mould-description"><?=$tr["mould-description"];?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card bg-body">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 col-md-9">
                    <h4>Garanzie</h4> 
                </div>
                <div class="col-12 col-md-3 d-flex justify-content-end" id="add-warranty-modal-trigger" style="display:none">
                    <button type="button" class="btn btn-primary" data-bs-target="#add-warranty-modal" data-bs-toggle="modal">Aggiungi</button> 
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="warranties-no-records" style="display:none"><p class="my-3" ><?=$tr["no-mould-warranty-found"];?></p></div>
                    <div id="warranties-loading-list" class="rounded bg-body-secondary" style="height:50px;"></div>
                    <div id="warranties-loading-error" class="rounded border-danger text-danger"style="height:50px;display:none"><?=$tr["mould-warranties-loading-error"];?></div>

                    
                    <table class="table table-striped" id="warranties-table" style="display:none">
                        <thead>
                            <tr>
                                <th scope="col"><?=$tr["date-start"];?></th>
                                <th scope="col"><?=$tr["stroke-warranty-start"];?></th>
                                <th scope="col"><?=$tr["guaranteed-part"];?></th>
                                <th scope="col"><?=$tr["mould-strokes"];?></th>
                            </tr>
                        </thead>
                        <tbody id="warranties-list">
                            <tr class="pointer" id="warranty-example" style="display:none">
                                <td class="warranty-start_date"></td>
                                <td class="warranty-start_strokes text-end"></td>
                                <td class="warranty-guaranteed_part"></td>
                                <td class="warranty-guaranteed_strokes text-end"></td>
                            </tr>
                            <!-- Rows will be added here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
