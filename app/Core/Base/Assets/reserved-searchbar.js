function setSearchbar(){
    isBig = $(window).width() > 768;
    if(!isBig){
        $("#search-section").hide();
    }
}

$(document).ready(function () {

    setSearchbar();
    $(window).resize(function(){
        setSearchbar();  
    })

    
    
    $("#search-section").keyup(function () {
        if ($(this).val() != ""){
            $("#search-section-list").show();
            $("#search-section-list").find("a").addClass("d-none");
            $("#search-section-list").find("a:contains-ci('" + $(this).val() + "')").removeClass("d-none");

        } else {
            $("#search-section-list").hide();
        }
    });


});


$.extend($.expr[":"],{
    "contains-ci": function (elem, i, match, array) {
        return (elem.textContent || elem.innerText || $(elem).text() || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
});

$("input.src").keyup(function () {
    searched = $(this).val();
    if (searched != ""){
        console.log("Searching: " + searched);
        target = $($(this).data("target") );
        target.find("li").attr('style','display:none!important');
        target.find("tr").attr('style','display:none!important');
        
        target.find("li:contains-ci('" + searched+ "')").show();
        target.find("tr:contains-ci('" + searched + "')").show();

    } else {
        target.find("li").show();
        target.find("tr").show();
    }
});