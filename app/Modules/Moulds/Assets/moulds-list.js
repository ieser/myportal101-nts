var pagenumber = 1
var pagesize = 50
let loading = false;
let allLoaded = false;

initMoulds();

document.addEventListener("contentLoaded", function () {
    initMoulds();
});

function initMoulds(){
    if ($("#moulds-list").length) {
        loadMoreMoulds();
    }
}


function loadMoreMoulds() {
    if (loading || allLoaded) return; 
    loading = true;


    fetch('/api/moulds?pagenumber=' + pagenumber + '&pagesize=' + pagesize)
    .then(response => response.json())  
    .then(data => { 
        if (data.success) { 
            
            const moulds = data.data.moulds;
            const pagination = data.data.pagination;

            $("#moulds-loading-list").hide();
            if (moulds.length === 0 || pagination.pagenumber >= Math.ceil(pagination.total / pagesize)) {
                allLoaded = true;
                $("#moulds-no-records").show();
                $("#moulds-all-loaded").show(); 
            }else{
                $.each(moulds, function(key, mould) {
                    const row = generateMouldRow(mould); 
                    $("#moulds-list").append(row);
                });
            }
            handlePagination(pagination);
            pagenumber++;

        } else {
            $("#moulds-loading-list").hide();
            $("#moulds-loading-error").show();
            console.error('Dati stampi non validi');
            console.log(data);
        }
    })
    .catch(error => {
        // Gestione degli errori
        $("#moulds-loading-list").hide();
        $("#moulds-loading-error").show();
        console.error('Errore nel recupero degli stampi:', error);
    })
    .finally(() => {
        loading = false;  
    });;

}


function generateMouldRow(mould){
    if (!mould || !mould.No_ || !mould.Description) {
        console.error("Dati stampo incompleti:", mould);
        return null; 
    }
    row = $("#moulds-example").clone();
    row.attr('id', ''+ mould.No_);
    row.attr("data-id", mould.No_);
    row.find(".mould-code").html(mould.No_);
    row.find(".mould-name").html(mould.Description);
    row.find(".mould-link").data("href","/moulds/"+mould.No_);
    row.show();
    return row; 
}


$("main").on("scroll", function() {
    const lastElement = $("#moulds-list").find("li:last-child");  
    const lastElementOffset = lastElement.offset().top; 
    const windowHeight = $(window).scrollTop() + $(window).height();  
    if (lastElement.length && lastElementOffset <= windowHeight + 100 && !loading && !allLoaded) {
        loadMoreMoulds();  
    }
});
function handlePagination(pagination) {
    const total = pagination.total; 
    const pagenumber = pagination.pagenumber; 
    const pagesize = pagination.pagesize;

}

$(document).on("input", "#search-moulds", function() {
    const pagenumber = 1; 
    const pagesize = 30; 
    const searchParam = $(this).val() || ''; 

    fetch(`/api/moulds?pagenumber=${pagenumber}&pagesize=${pagesize}&search=${searchParam}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) { 
            
                const moulds = data.data.moulds;
                const pagination = data.data.pagination;

                $("#moulds-no-records").hide();
                $("#moulds-list").empty(); 
                if (moulds.length > 0) {
                    moulds.forEach(mould => {
                        const row = generateMouldRow(mould);  
                        $("#moulds-list").append(row);
                    });
                } else {
                    $("#moulds-no-records").show();
                }

                handlePagination(pagination);
            } else {
                console.error("Errore nella ricerca:", data.response.error);
            }
        })
        .catch(error => {
            console.error("Errore nella richiesta di ricerca:", error);
        });
});

