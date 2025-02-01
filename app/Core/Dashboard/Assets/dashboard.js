
$(document).on('click', 'form#notes button', function () {
    console.log("Updating notes..");
    const notesForm = document.querySelector("form#notes");
    dataForm = new FormData(notesForm);
    updateNotes(dataForm).then(response => { 
        $("form#notes .text-success").show();
    });
});

$(document).on('keyup', 'form#notes *', function () {
    $("form#notes .text-success").hide();
});