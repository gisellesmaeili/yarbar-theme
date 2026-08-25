( function() {
    var header = document.querySelector( '.site-header' );
    var sentinel = document.getElementById( 'yarbar-scroll-sentinel' );
    var hamburger = document.querySelector( '.site-header__hamburger' );
    var drawer = document.getElementById( 'yarbar-mobile-drawer' );
    var drawerClose = document.querySelector( '.mobile-drawer__close' );
    var drawerLinks = document.querySelectorAll( '.mobile-drawer__menu a' );
    var navLinks = document.querySelectorAll( '.site-header__menu a[href^="#"]' );
    var sections = [];

    navLinks.forEach( function( link ) {
        var id = link.getAttribute( 'href' ).slice( 1 );
        var section = document.getElementById( id );
        if ( section ) {
            sections.push( { link: link, section: section } );
        }
    } );

    // Shrink the header once the visitor scrolls past the top of the page.
    if ( header && sentinel && 'IntersectionObserver' in window ) {
        var scrollObserver = new IntersectionObserver( function( entries ) {
            entries.forEach( function( entry ) {
                header.classList.toggle( 'is-scrolled', ! entry.isIntersecting );
            } );
        }, { rootMargin: '-80px 0px 0px 0px' } );
        scrollObserver.observe( sentinel );
    }

    // Highlight the nav link that matches the section currently in view.
    if ( sections.length && 'IntersectionObserver' in window ) {
        var sectionObserver = new IntersectionObserver( function( entries ) {
            entries.forEach( function( entry ) {
                if ( ! entry.isIntersecting ) {
                    return;
                }
                var match = sections.filter( function( item ) {
                    return item.section === entry.target;
                } )[ 0 ];
                if ( match ) {
                    navLinks.forEach( function( link ) {
                        link.classList.remove( 'is-active' );
                    } );
                    match.link.classList.add( 'is-active' );
                }
            } );
        }, { rootMargin: '-40% 0px -40% 0px' } );

        sections.forEach( function( item ) {
            sectionObserver.observe( item.section );
        } );
    }

    // Mobile hamburger drawer.
    function openDrawer() {
        if ( ! drawer ) {
            return;
        }
        drawer.classList.add( 'is-open' );
        drawer.setAttribute( 'aria-hidden', 'false' );
        hamburger.setAttribute( 'aria-expanded', 'true' );
    }

    function closeDrawer() {
        if ( ! drawer ) {
            return;
        }
        drawer.classList.remove( 'is-open' );
        drawer.setAttribute( 'aria-hidden', 'true' );
        hamburger.setAttribute( 'aria-expanded', 'false' );
    }

    if ( hamburger && drawer ) {
        hamburger.addEventListener( 'click', openDrawer );
    }
    if ( drawerClose ) {
        drawerClose.addEventListener( 'click', closeDrawer );
    }
    drawerLinks.forEach( function( link ) {
        link.addEventListener( 'click', closeDrawer );
    } );
    document.addEventListener( 'keydown', function( e ) {
        if ( e.key === 'Escape' ) {
            closeDrawer();
        }
    } );
} )();