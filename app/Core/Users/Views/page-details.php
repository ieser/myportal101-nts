<div class="container">
    <div class="row">
        <div class="col-12 col-md-4 col-xl-3">
            <div class="card mb-4" id="list-details">

                <div class="card-body">
                    <div class="d-flex flex-column align-items-center">
                        <div class="rounded-circle overflow-hidden mb-3" id="profile-image">
                            <img src="/img/profile-pictures/<?=$user->image;?>" class="img-fluid">
                            <input type="file" class="form-control hide-file-selector" id="image" name="image" value="<?=$user->image;?>" placeholder=" ">
                            <label id="image-label"><i class="fa-solid fa-camera"></i></label>
                        </div>
                        <div class="text-center p-3">
                            <h6><?=$user->name;?> <?=$user->lastname;?></h6>
                            <p class="text-secondary"><?=$user->role;?></p>
                            <p> <?=$user->email;?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9 col-xl-8">
            <ul class="nav nav-underline mb-4" id="nav-user-sections" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#general-tab" type="button" role="tab" aria-controls="general-tab" aria-selected="true"><?=$tr_userGeneralTab;?></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#groups-tab" type="button" role="tab" aria-controls="groups-tab-pane" aria-selected="false"><?=$tr_userGroupTab;?></button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#logs-tab" type="button" role="tab" aria-controls="logs-tab-pane" aria-selected="false"><?=$tr_userLogsTab;?></button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="general-tab" role="tabpanel" tabindex="0">
                    <div class="card mb-4" id="details">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?=$user->email;?>">
                                        <label for="floatingInput">Indirizzo email</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?=$user->name;?>">
                                        <label for="floatingInput">Nome</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?=$user->lastname;?>">
                                        <label for="floatingInput">Cognome</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="groups-tab" role="tabpanel" tabindex="0">
                    <div class="card mb-4" id="list-groups">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <h6 class="my-2"><?=$tr_userGroups;?></h6>
                                </div>
                                <div class="col-4 text-end">
                                    <button type="button" class="btn btn-yellow" data-bs-toggle="modal" data-bs-target="#add-to-group-modal"><?=$tr_useraddToGroups;?></h6>
                                </div>
                            </div>
                            <div class="">
                                <table class="table" id="groups-list">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($user->groups as $group){ ?>
                                            <?php $page->display("users/row-group", array("group" => $group)); ?> 
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="logs-tab" role="tabpanel" tabindex="0">
                    <div class="card mb-4" id="list-groups">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($logs as $log){?> 
                                                <tr>
                                                    <th scope="row"></th>
                                                    <td><?=$log["datetime"];?></td>
                                                    <td><?=$log["action"];?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".unassign").click( function () {
            row = $(this).parents("tr");
            confirmDialog((ans) => {
                if (ans) {
                    user = $(this).data("user");
                    group = $(this).data("group");
                    $.ajax({
                        type: 'POST', 
                        url: '/user/unassign', 
                        dataType: "json",
                        data: {"idUser" : user, "idGroup" : group},
                        success: function(response){ 
                            if(response.status == "success"){
                                row.remove();
                            }
                        }
                    });
                }else {
                    //
                }
            });
        });
        
    });
</script>