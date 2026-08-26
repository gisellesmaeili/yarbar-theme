/**
 * Header JavaScript for YarBar
 * 
 * - Glassmorphism shrink on scroll
 * - Active section tracking with minimal line indicator
 * - Smooth scroll for on-page anchors
 * - Mobile drawer toggle & focus trap
 */

( function() {
    'use strict';

    var header       = document.getElementById( 'site-header' );
    var sentinel     = document.getElementById( 'yarbar-scroll-sentinel' );
    var hamburger    = document.querySelector( '.site-header__hamburger' );
    var drawer       = document.getElementById( 'yarbar-mobile-drawer' );
    var drawerClose  = document.querySelector( '.mobile-drawer__close' );
    var drawerLinks  = document.querySelectorAll( '.mobile-drawer__menu a' );
    var navLinks     = document.querySelectorAll( '.site-header__menu a' );
    var sections     = [];

    // Map navigation links to their corresponding target elements
    navLinks.forEach( function( link ) {
        var sectionId = link.getAttribute( 'data-section' );
        if ( sectionId ) {
            var el = document.getElementById( sectionId );
            if ( el ) {
                sections.push( { link: link, section: el, id: sectionId } );
            }
        }
    } );

    // 1. Shrink the header once the visitor scrolls past the invisible sentinel near the top
    if ( header && sentinel && 'IntersectionObserver' in window ) {
        var scrollObserver = new IntersectionObserver( function( entries ) {
            entries.forEach( function( entry ) {
                header.classList.toggle( 'is-scrolled', ! entry.isIntersecting );
            } );
        }, { rootMargin: '-30px 0px 0px 0px' } );
        scrollObserver.observe( sentinel );
    }

    // 2. Highlight the active nav link as sections scroll into view
    if ( sections.length && 'IntersectionObserver' in window ) {
        var sectionObserver = new IntersectionObserver( function( entries ) {
            entries.forEach( function( entry ) {
                if ( entry.isIntersecting ) {
                    var match = sections.find( function( item ) {
                        return item.section === entry.target;
                    } );
                    if ( match ) {
                        navLinks.forEach( function( l ) {
                            l.classList.remove( 'is-active' );
                        } );
                        match.link.classList.add( 'is-active' );
                    }
                }
            } );
        }, { rootMargin: '-20% 0px -70% 0px' } );

        sections.forEach( function( item ) {
            sectionObserver.observe( item.section );
        } );
    }

    // 3. Pause purely-decorative infinite animations while their section is off-screen
    var animatedSections = document.querySelectorAll( '[data-animate-when-visible]' );
    if ( animatedSections.length && 'IntersectionObserver' in window ) {
        var visibilityObserver = new IntersectionObserver( function( entries ) {
            entries.forEach( function( entry ) {
                entry.target.classList.toggle( 'in-view', entry.isIntersecting );
            } );
        }, { rootMargin: '0px 0px -10% 0px' } );

        animatedSections.forEach( function( el ) {
            visibilityObserver.observe( el );
        } );
    }

    // 4. Smooth scrolling for anchor links on the homepage
    function handleAnchorClick( e ) {
        var href = this.getAttribute( 'href' );
        if ( ! href ) {
            return;
        }

        var hashIndex = href.indexOf( '#' );
        if ( hashIndex !== -1 ) {
            var targetId = href.substring( hashIndex + 1 );
            var targetEl = document.getElementById( targetId );

            // If target exists on current page, smooth scroll to it
            if ( targetEl ) {
                e.preventDefault();
                closeDrawer();

                var headerHeight = header ? header.offsetHeight : 70;
                var elementPosition = targetEl.getBoundingClientRect().top;
                var offsetPosition = elementPosition + window.pageYOffset - ( headerHeight - 10 );

                window.scrollTo( {
                    top: offsetPosition,
                    behavior: 'smooth'
                } );

                if ( history.pushState ) {
                    history.pushState( null, null, '#' + targetId );
                }
            }
        }
    }

    navLinks.forEach( function( link ) {
        link.addEventListener( 'click', handleAnchorClick );
    } );

    drawerLinks.forEach( function( link ) {
        link.addEventListener( 'click', handleAnchorClick );
    } );

    // 5. Mobile Drawer toggle
    function openDrawer() {
        if ( ! drawer ) return;
        drawer.classList.add( 'is-open' );
        drawer.setAttribute( 'aria-hidden', 'false' );
        if ( hamburger ) {
            hamburger.setAttribute( 'aria-expanded', 'true' );
        }
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        if ( ! drawer ) return;
        drawer.classList.remove( 'is-open' );
        drawer.setAttribute( 'aria-hidden', 'true' );
        if ( hamburger ) {
            hamburger.setAttribute( 'aria-expanded', 'false' );
        }
        document.body.style.overflow = '';
    }

    if ( hamburger ) {
        hamburger.addEventListener( 'click', function() {
            if ( drawer && drawer.classList.contains( 'is-open' ) ) {
                closeDrawer();
            } else {
                openDrawer();
            }
        } );
    }

    if ( drawerClose ) {
        drawerClose.addEventListener( 'click', closeDrawer );
    }

    document.addEventListener( 'keydown', function( e ) {
        if ( e.key === 'Escape' && drawer && drawer.classList.contains( 'is-open' ) ) {
            closeDrawer();
        }
    } );

} )();