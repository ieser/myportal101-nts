
function compareVersions(current, available) {
    // Rimuove la "v" iniziale (se presente) e divide le versioni in numeri
    const v1 = current.replace(/^v/, '').split('.').map(Number);
    const v2 = available.replace(/^v/, '').split('.').map(Number);

    // Confronta ogni parte delle versioni
    for (let i = 0; i < Math.max(v1.length, v2.length); i++) {
        const num1 = v1[i] || 0; // Usa 0 se non c'è una parte
        const num2 = v2[i] || 0;

        if (num1 > num2) return -1; // La versione corrente è maggiore
        if (num1 < num2) return 1;  // La versione disponibile è maggiore
    }

    return 0; // Le versioni sono uguali
}           

$(document).ready(function () {
    fetch('/api/updates')
    .then(response => response.json())  
    .then(response => { 
        if(response.success){
            $("#update-loading").hide();
            $("#update-content").show();
            if(response.data.current){
                current = response.data.current;
                 $("#update-current").html(current.version);
            }
            if(response.data.latest){
                latest = response.data.latest;
                 $("#update-latest").html(latest.version);
            }
            if(current.version && latest.version){
                status = compareVersions(current.version, latest.version);
                console.log(status);
                if(status == 0){
                    $("#update-all-updated").show();
                }else if(status == 1){
                    $("#update-available").show();
                    $("#update-actions").show();
                    $("#update-details").show();
                    
                    if(latest.description){
                        $("#update-description").html(latest.description);
                    }
                    if(latest.features){
                        $.each(latest.features, function(index, feature) {
                            $("#update-features").append(
                                $("<li>").addClass("list-m").text(feature)
                            );
                        });
                    }
                    
                }
            }
            
            
        }
    })
    .catch(error => {

        console.error('Errore nel recupero degli aggiornamenti:', error);
        $("#update-loading").hide();
        $("#update-error").show();
    });



    $(document).find('#update-core').on('click', function() {
        $(this).prop('disabled', true);
        dataForm = new FormData();
        dataForm.set("update", true);

        fetch('/api/update', {
            method: "POST",
            body: dataForm
        })
        .then(response => response.json())  
        .then(response => { 
            if(response.success){
                $("#update-in-progress").show();
            }
          })
        .catch(error => {

            console.error('Errore nel recupero degli aggiornamenti:', error);
            $("#update-loading").hide();
            $("#update-error").show();
        });

    });


});
