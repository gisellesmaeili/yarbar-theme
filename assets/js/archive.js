/**
 * Archive & Search Interactions (AJAX Filtering, Sorting, Pagination)
 * 
 * @package YarBar
 */
( function() {
    'use strict';

    var container = document.getElementById( 'archive-grid-container' );
    if ( ! container ) {
        return;
    }

    var grid              = document.getElementById( 'archive-blog-grid' );
    var paginationWrapper = document.getElementById( 'archive-pagination-wrapper' );
    var countElement      = document.getElementById( 'archive-post-count' );
    var filterTabs        = document.querySelectorAll( '.category-tab' );
    var sortSelect        = document.getElementById( 'sort-select' );
    var postType          = container.getAttribute( 'data-post-type' ) || 'post';
    var searchQuery       = container.getAttribute( 'data-search' ) || '';

    var activeTab  = document.querySelector( '.category-tab.active' );
    var initialCat = activeTab ? activeTab.getAttribute( 'data-category' ) : 'all';

    var state = {
        category: initialCat || 'all',
        sort: sortSelect ? sortSelect.value : 'newest',
        paged: 1,
        post_type: postType,
        s: searchQuery,
        isLoading: false
    };

    // Category Tabs click
    filterTabs.forEach( function( tab ) {
        tab.addEventListener( 'click', function( e ) {
            e.preventDefault();
            if ( state.isLoading ) return;

            var cat = this.getAttribute( 'data-category' );
            if ( cat === state.category ) return;

            filterTabs.forEach( function( t ) { t.classList.remove( 'active' ); } );
            this.classList.add( 'active' );

            state.category = cat;
            state.paged = 1;
            fetchResults( false, false );
        } );
    } );

    // Sort Dropdown change
    if ( sortSelect ) {
        sortSelect.addEventListener( 'change', function() {
            if ( state.isLoading ) return;
            state.sort = this.value;
            state.paged = 1;
            fetchResults( false, false );
        } );
    }

    // AJAX Pagination click delegation
    if ( paginationWrapper ) {
        paginationWrapper.addEventListener( 'click', function( e ) {
            var target = e.target.closest( '.page-link' );
            if ( ! target || target.classList.contains( 'active' ) || target.classList.contains( 'disabled' ) ) {
                return;
            }
            e.preventDefault();
            if ( state.isLoading ) return;

            var page = target.getAttribute( 'data-page' );
            if ( page ) {
                state.paged = parseInt( page, 10 );
                fetchResults( true, true );
            }
        } );
    }

    function fetchResults( scrollToTop, smoothScroll ) {
        if ( ! window.yarbar_archive_ajax ) return;

        state.isLoading = true;
        container.classList.add( 'is-loading' );

        var formData = new FormData();
        formData.append( 'action', 'yarbar_archive_filter' );
        formData.append( 'nonce', window.yarbar_archive_ajax.nonce );
        formData.append( 'post_type', state.post_type );
        formData.append( 'category', state.category );
        formData.append( 'sort', state.sort );
        formData.append( 'paged', state.paged );
        formData.append( 's', state.s );

        fetch( window.yarbar_archive_ajax.ajax_url, {
            method: 'POST',
            body: formData
        } )
        .then( function( res ) { return res.json(); } )
        .then( function( res ) {
            state.isLoading = false;
            container.classList.remove( 'is-loading' );

            if ( res.success && res.data ) {
                if ( grid ) {
                    grid.innerHTML = res.data.html;
                }
                if ( paginationWrapper ) {
                    paginationWrapper.innerHTML = res.data.pagination;
                }
                if ( countElement && res.data.count_text ) {
                    countElement.textContent = res.data.count_text;
                }

                if ( scrollToTop && smoothScroll ) {
                    var mainSection = document.getElementById( 'archive-main-container' );
                    if ( mainSection ) {
                        var offset = mainSection.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo( { top: offset, behavior: 'smooth' } );
                    }
                }
            }
        } )
        .catch( function( err ) {
            state.isLoading = false;
            container.classList.remove( 'is-loading' );
            console.error( 'AJAX archive filter error:', err );
        } );
    }
} )();
