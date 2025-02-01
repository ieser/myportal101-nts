<div class="container">
    <div class="card bg-body">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <th></th> 
                            <?php foreach ($groups as $group) { ?>
                                <th class="text-center fw-bold" ><?=$group->name;?></th>
                            <?php } ?>
                        </thead>
                        <tbody>
                            <?php foreach ($privileges as $section) { ?>
                                <?php $page->display("privileges/row-section", array("section" => $section, "groups"=>$groups)); ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
