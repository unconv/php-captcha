let is_bot = true;

setTimeout( function() {
    is_bot = false;
}, 3000 );

function add_notbot_field() {
    const form = document.querySelector( "#form" );

    if( is_bot || form.querySelector( ".notbot" ) ) {
        return;
    }

    const input = document.createElement( "input" );
    input.type="hidden";
    input.name="notbot";
    input.value="1";
    input.classList.add( "notbot" );

    form.appendChild( input );
}

document.addEventListener( "scroll", function() {
    add_notbot_field();
}, {passive: true} );

document.addEventListener( "click", function() {
    add_notbot_field();
}, {passive: true} );

document.addEventListener( "touchend", function() {
    add_notbot_field();
}, {passive: true} );
