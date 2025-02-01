<div class="modal" tabindex="-1" id="edit-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?=$tr["edit-group"];?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-body">
                <form id="edit-form">
                    <input type="hidden" name="id" id="edit-id" value="">
                    <div class="row">  
                        <div class="col mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit-name" name="name" placeholder=" " required>
                                <label for="edit-name"><?=$tr["group-name"];?></label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?=$tr["cancel"];?></button>
                <button type="button" class="btn btn-yellow" id="edit">
                    <span class="loading spinner-grow spinner-grow-sm" style="display:none"></span>
                    <span class="finished edit"><?=$tr["edit-group"];?></span>
                </button>
            </div>
        </div>
    </div>
</div>