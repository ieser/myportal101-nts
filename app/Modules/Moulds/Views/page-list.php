<div class="container">
    <div class="card bg-body">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search "></i></span>
                        <input type="text" class="form-control" id="search-moulds" placeholder="<?=$tr["search-mould"];?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p class="my-3" id="moulds-no-records" style="display:none"><?=$tr["no-mould-found"];?></p>
                    <ul>
                        <li class="list-group-item pointer" id="moulds-example" style="display:none">
                            <div class="text-body mould-link" data-href=""> 
                                <div class="d-flex align-items-center">
                                    <div class="p-2 ps-4">
                                        <h6 class="mould-code fw-bold"></h6>
                                        <p class="mb-0 mould-name"></p>
                                    </div>
                                    <div class="ms-auto">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-group" id="moulds-list"></ul>
                    <div class="rounded bg-body-secondary" id="moulds-loading-list" style="height:50px;"></div>
                    <div class="rounded border-danger text-danger" id="moulds-loading-error" style="height:50px;display:none"><?=$tr["moulds-loading-error"];?></div>
                    <div class="rounded border-success text-success" id="moulds-all-loaded" style="height:50px;display:none"><?=$tr["moulds-all-loaded"];?></div>
                </div>
            </div>
        </div>
    </div>
</div>