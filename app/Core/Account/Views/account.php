<div class="row">
    <div class="col-12 pb-3">
        <h4>Account</h4>
    </div>
    <div class="col-12 pb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-chevron ">
                <li class="breadcrumb-item"><a href="/dashboard"><i class="fa-solid fa-house"></i></a></li>
                <li class="breadcrumb-item"><a href="/account">Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Overview</li>
            </ol>
        </nav>
         
    </div>
</div>
<div class="row">
    <div class="col-12">
        <form action="/account/edit" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
            <div class="card bg-body p-4 mb-4">
                <div class="d-flex align-items-center">
                    <div class="">
                        <div class="rounded-1 overflow-hidden" id="profile-image">
                            <img src="/img/profile-pictures/<?=$account->image;?>" class="img-fluid">
                            <input type="file" class="form-control hide-file-selector" id="image" name="image" value="<?=$account->image;?>" placeholder=" ">
                            <label id="image-label"><i class="fa-solid fa-camera"></i></label>
                        </div>
                    </div>
                    <div class="flex-fill p-3">
                        <h4><?=$account->name;?> <?=$account->lastname;?></h4>
                        <p> <?=$account->email;?></p>
                    </div>
                </div>
            </div>
        </form>      
    </div>
</div>
<script>


   

    $("#profile-image label").click(function () { 
        console.log("Select new image");
        $("#profile-image input").trigger('click');  
    });

    $("#profile-image input").change(function () { 
        console.log("Image trigger ");
        if ($(this).files && $(this).files[0]){
            console.log("Image selected ");
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#profile-image img' ).attr('src', e.target.result);
            };
            reader.readAsDataURL($(this).files[0]);
        }
    });

</script>