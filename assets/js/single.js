/**
 * Single Post Interactions (Share buttons, Copy Link)
 */
( function() {
    'use strict';

    var copyBtn = document.querySelector( '.share-btn.copy-link' );
    if ( ! copyBtn ) {
        return;
    }

    copyBtn.addEventListener( 'click', function() {
        var url = this.getAttribute( 'data-url' ) || window.location.href;

        if ( navigator.clipboard && window.isSecureContext ) {
            navigator.clipboard.writeText( url ).then( handleSuccess ).catch( handleFallback );
        } else {
            handleFallback();
        }

        function handleSuccess() {
            copyBtn.classList.add( 'is-copied' );
            var origTitle = copyBtn.getAttribute( 'title' );
            copyBtn.setAttribute( 'title', 'لینک کپی شد!' );
            setTimeout( function() {
                copyBtn.classList.remove( 'is-copied' );
                if ( origTitle ) {
                    copyBtn.setAttribute( 'title', origTitle );
                }
            }, 2000 );
        }

        function handleFallback() {
            var tempInput = document.createElement( 'input' );
            tempInput.value = url;
            document.body.appendChild( tempInput );
            tempInput.select();
            try {
                document.execCommand( 'copy' );
                handleSuccess();
            } catch ( err ) {
                console.error( 'Unable to copy', err );
            }
            document.body.removeChild( tempInput );
        }
    } );
} )();
