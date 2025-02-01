<div class="modal" tabindex="-1" id="add-warranty-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=$tr["add-warranty"];?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-body">
                <form method="post" id="add-warranty-form">
                    <div class="row ">  
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="date" name="start-date" class="form-control" placeholder=" " value="<?=date("Y-m-d");?>">
                                <label for="start-date">Data inizio garanzia</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="number" name="start-strokes" class="form-control" placeholder=" " >
                                <label for="start-strokes">Battute a inizio garanzia</label>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-check form-switch">
                              <input class="form-check-input" type="checkbox" role="switch" name="total-guarantee" id="total-guarantee" checked>
                              <label class="form-check-label" for="total-guarantee">Garanzia totale</label>
                            </div>
                        </div>
                        <div class="col-12 mb-3 d-none" id="guaranteed-part-input-block">
                            <div class="form-floating">
                                <input type="text" name="guaranteed-part" id="guaranteed-part" class="form-control" placeholder=" ">
                                <label for="floatingTextarea2">Parte dello stampo in garanzia</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="number" name="guaranteed-strokes" class="form-control" placeholder=" " >
                                <label for="floatingTextarea2">Battute in garanzia</label>
                            </div>
                        </div>


                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <textarea class="form-control" name="notes" placeholder="Notes" style="height: 100px"></textarea>
                                <label for="notes">Note</label>
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?=$tr["cancel"];?></button>
                <button type="button" class="btn btn-primary" id="add-warranty-button"><?=$tr["add"];?></button>
            </div>
        </div>
    </div>
</div>
