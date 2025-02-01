<div class="row">
    <div class="row">
        <div class="col-12 col-md-3 ">
          <div class="list-group sticky-top" id="settings-list" style="top:10px;">
            <a class="list-group-item list-group-item-action" href="#identity">Logo e titolo</a>
            <a class="list-group-item list-group-item-action" href="#updates">Aggiornamenti</a>
          </div>
        </div>
        <div class="col-12 col-md-9">
            <div data-bs-spy="scroll" data-bs-target="#settings-list" data-bs-smooth-scroll="true" class="" tabindex="0">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card" id="identity">
                            <h5 class="card-header py-3"><?=$tr["identity"];?></h5>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Sezione di caricamento -->
                                    <div class="col-12 text-center mb-3" id="identity-loading">
                                        <div class="spinner-border text-primary me-2" role="status"></div>
                                        <span class="fs-5" style="vertical-align:super"><?=$tr["identity-loading-current"];?></span>
                                    </div>
                                    <!-- Contenuto aggiornamenti -->
                                    <div class="col-12" id="identity-content" style="display:none;">
                                        <form id="identity-form" method="POST" enctype="multipart/form-data">
                                            <div class="row mb-3">
                                                <div class="col-12 col-md-3 py-3">
                                                    <label class="fw-bold"><?=$tr["identity-logo"];?></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <div class="image-picker border rounded overflow-hidden" >
                                                        <img src="/img/logo-placeholder.webp" id="identity-logo-img" class="mh-100" data-current="/img/logo-placeholder.webp">
                                                        <input type="file" class="form-control hide-file-selector" id="identity-logo" name="identity-logo" value="" >
                                                        <label for="identity-logo"><i class="fa-solid fa-camera"></i></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12 col-md-3 pt-1">
                                                    <label class="fw-bold"><?=$tr["identity-title"];?></label>
                                                </div>
                                                <div class="col-12 col-md-9">
                                                    <input class="form-control" type="text" id="identity-title"  name="identity-title">
                                                </div>
                                            </div>
                                            <div class="row align-items-end mb-3">
                                                <div class="col-12 d-flex justify-content-end ">
                                                    <button type="reset" class="btn btn-secondary ms-2"><?=$tr["identity-discard-changes"];?></button>
                                                    <button type="submit" class="btn btn-primary ms-2"><?=$tr["identity-save-changes"];?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                         </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card"  id="updates">
                            <h5 class="card-header py-3"><?=$tr["updates"];?></h5>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Sezione di caricamento -->
                                    <div class="col-12 text-center mb-3" id="update-loading">
                                        <div class="spinner-border text-primary me-2" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <span class="fs-5" style="vertical-align:super"><?=$tr["checking-updates"];?></span>
                                    </div>
                                    <!-- Messaggi di stato -->
                                    <div class="col-12" id="update-results">
                                        <p class="text-success fs-6" id="update-all-updated" style="display:none;">
                                            <i class="fa-solid fa-circle-check"></i> <?=$tr["all-updated"];?>
                                        </p>
                                        <p class="text-warning fs-6" id="update-available" style="display:none;">
                                            <i class="fa-solid fa-triangle-exclamation"></i> <?=$tr["update-available"];?>
                                        </p>
                                        <p class="text-danger fs-6" id="update-error" style="display:none;">
                                            <i class="fa-solid fa-triangle-exclamation"></i> <?=$tr["update-error"];?>
                                        </p>
                                    </div>
                                    <!-- Contenuto aggiornamenti -->
                                    <div class="col-12" id="update-content" style="display:none;">
                                        <div class="row">

                                           
                                            <!-- Informazioni sulle versioni -->
                                            <div class="col-12 mb-4">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <strong>Versione corrente:</strong> <span id="update-current" class="text-primary"></span>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <strong>Ultima versione:</strong> <span id="update-latest" class="text-success"></span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Dettagli sull'aggiornamento -->
                                            <div class="col-12 mb-4" id="update-details" style="display:none;">
                                                <h6 class="fw-bold"><?=$tr["update-news"];?></h6>
                                                <p><span id="update-description"></span></p>
                                                <ul class="" id="update-features"></ul>
                                            </div>


                                            <!-- Azione di aggiornamento -->
                                            <div class="col-12 text-center" id="update-actions" style="display:none;">
                                                <button class="btn btn-primary" id="update-core">
                                                    <i class="bi bi-arrow-down-circle me-1"></i> <?=$tr["update-now"];?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                         </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>