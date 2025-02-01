<div class="modal" tabindex="-1" id="add-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=$tr["create-group"];?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-body">
                <form id="add-form">
                    <div class="row">  
                        <div class="col mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="add-name" name="name" placeholder=" " required>
                                <label for="add-name"><?=$tr["group-name"];?></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="step-back" style="display:none"><?=$tr["back"];?></button>
                <span class="error" style="display:none">Error</span>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?=$tr["cancel"];?></button>
                <button type="button" class="btn btn-yellow" id="add">
                    <span class="loading spinner-grow spinner-grow-sm" style="display:none"></span>
                    <span class="finished continue"><?=$tr["continue"];?></span>
                </button>
            </div>
        </div>
    </div>
</div>