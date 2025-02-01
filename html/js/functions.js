$.fn.isInViewport = function() {
    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();

    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();

    return elementBottom > viewportTop && elementTop < viewportBottom;
};

$.fn.isInEmphasis = function() {
    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();

    var margin = $(window).height()*30/100;

    var viewportTop = $(window).scrollTop() + margin;
    var viewportBottom = viewportTop + $(window).height() - 2*margin;

    return elementBottom > viewportTop && elementTop < viewportBottom;
};

function copyToClipboard(text) {
    var textArea = document.createElement( "textarea" );
    textArea.value = text;
    document.body.appendChild( textArea );    
    textArea.focus();   
    textArea.select();
 
    try {
       document.execCommand( 'copy' );
       console.log('Copied to clipboard ' + text);
    } catch (err) {
       console.log('Oops, unable to copy', err);
    }    
    document.body.removeChild( textArea );
 }