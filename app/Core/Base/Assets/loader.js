
$(document).ready(function () {
    const initialPage = window.location.pathname !== "/" ? window.location.pathname : "/home";
    loadContent(initialPage);
});

window.onpopstate = function (e) {
    if (e.state && e.state.page) {
        loadContent(e.state.page);
    }
};

$(document).on("click", "[data-href]", function (e) {
    e.preventDefault();
    const page = $(this).data("href");
    if (page) {
        console.log(page);
        loadContent(page); 
    } else {
        console.log("No data-href attribute found");
    }
    return false; 
});

async function loadContent(url) {
    const main = $("#main-content");
    main.html("<p>Loading...</p>"); 

    try {
        const response = await fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } });
        if (!response.ok) {
            throw new Error("Error loading content");
        }
        const data = await response.json();

        main.html(data.content);

        
        if (data.title){
            $("#page-title").html(data.title);
        }
        document.title = data.metatitle;
        if (data.metadescription){
            $("meta[name='description']").attr("content", data.metadescription);
        }
        if (data.metakeywords){
            $("meta[name='keywords']").attr("content", data.metakeywords);
        }
        $(document).find("#title").html(data.title);

        if (data.javascript && Array.isArray(data.javascript)) {
            data.javascript.forEach(function (scriptUrl) {
                const existingScript = document.querySelector(`script[src='/assets/${scriptUrl}']`);
                if (!existingScript) {
                    const scriptElement = document.createElement("script");
                    scriptElement.src = '/assets/' + scriptUrl;
                    scriptElement.async = true; // Carica in modo asincrono
                    document.body.appendChild(scriptElement);
                }
            });
        }

        if (data.stylesheet && Array.isArray(data.stylesheet)) {
            data.stylesheet.forEach(function (cssUrl) {
                const existingLink = document.querySelector(`link[href='/assets/${cssUrl}']`);
                if (!existingLink) {
                    const linkElement = document.createElement("link");
                    linkElement.rel = "stylesheet";
                    linkElement.href = '/assets/' + cssUrl;
                    document.head.appendChild(linkElement);
                }
            });
        }


        history.pushState({ page: url }, "", url);
        const event = new CustomEvent("contentLoaded");
        document.dispatchEvent(event);

    } catch (error) {
        main.html("<p>Error loading content.</p>");
        console.error("Error loading content: ", error);
    }
}