
initUsers();

document.addEventListener("contentLoaded", function () {
    initUsers();
});

function initUsers(){
    if ($("#users-list").length) {
        loadUsers();
    }
}


function generateRowUser(user){
    row = $("#user-row-example").clone();
    console.log(user);
    row.attr('id', 'user-'+ user.id);
    row.attr("data-id", user.id);
    row.attr("data-href", "/users/"+user.id);
    row.find(".date-insert").html(user.dateinsert);
    row.find(".last-login-ago").html(user.lastloginago);
    if(user.active == "1"){
        row.find(".active").removeClass("d-none");
    }else{
        row.find(".disabled").removeClass("d-none");
    }
    if(user.image != ""){
        row.find(".profile-picture img").attr("src","/img/profile-pictures/"+user.image);
    }

    row.find(".fullname").html(user.name+" "+user.lastname);
    row.find(".email").html(user.email);
    row.show();
    return row; 
}





function loadUsers() {
    fetch('/api/users')
    .then(response => response.json())  
    .then(response => { 
        if (response.success) { 
            $("#loading-list").hide();
            users = response.data.users;
            if(users.length==0){
                $("no-records").show(); 
            }
            $.each(users, function(key, user) {
                row = generateRowUser(user);
                $("#users-list tbody").append(row);
            });
        }
    })
    .catch(error => {
        $("#users-list").hide();
        $("#users-loading-error").show();
        console.error('Errore nel recupero degli utenti:', error);
    });
}

