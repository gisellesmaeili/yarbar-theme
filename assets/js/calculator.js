( function() {
    var form = document.getElementById( 'yarbar-calc-form' );
    if ( ! form ) {
        return;
    }

    // ---- Pricing configuration. All prices live here, in one place. ----
    var PRICE_CONFIG = {
        routeBase: 1500000,
        vehicles: {
            havar:    { name: 'خاور مسقف', base: 2500000 },
            kamyonet: { name: 'کامیونت',   base: 2000000 },
            nissan:   { name: 'نیسان',     base: 1400000 },
            vanet:    { name: 'وانت',      base: 900000 }
        },
        floorRate: 150000,
        workerRate: 400000,
        packagingFee: 800000
    };
    // ----------------------------------------------------------------------

    var state = {
        origin: '',
        destination: '',
        vehicle: '',
        originFloors: 0,
        destFloors: 0,
        workers: 0,
        packaging: false
    };

    var notice = document.getElementById( 'calc-notice' );
    var priceEl = document.getElementById( 'calc-price' );
    var submitBtn = document.getElementById( 'calc-submit' );
    var bookingBtn = document.getElementById( 'calc-booking-btn' );
    var stepItems = document.querySelectorAll( '.calc-steps__item' );
    var stepLines = document.querySelectorAll( '.calc-steps__line' );

    function formatToman( number ) {
        return new Intl.NumberFormat( 'fa-IR' ).format( Math.round( number ) );
    }

    function updateStepIndicator() {
        var step1Done = !! ( state.origin && state.destination );
        var step2Done = !! state.vehicle;

        stepItems[ 0 ].classList.toggle( 'is-complete', step1Done );
        stepItems[ 1 ].classList.toggle( 'is-complete', step2Done );
        stepItems[ 2 ].classList.toggle( 'is-complete', step2Done );
        stepLines[ 0 ].classList.toggle( 'is-complete', step1Done );
        stepLines[ 1 ].classList.toggle( 'is-complete', step2Done );
    }

    form.querySelectorAll( '[data-calc="origin"], [data-calc="destination"]' ).forEach( function( select ) {
        select.addEventListener( 'change', function() {
            state[ select.getAttribute( 'data-calc' ) ] = select.value;
            updateStepIndicator();
        } );
    } );

    form.querySelectorAll( '[data-calc="vehicle"]' ).forEach( function( radio ) {
        radio.addEventListener( 'change', function() {
            state.vehicle = radio.value;
            updateStepIndicator();
        } );
    } );

    form.querySelectorAll( '.calc-stepper__btn' ).forEach( function( button ) {
        button.addEventListener( 'click', function() {
            var key = button.getAttribute( 'data-stepper' );
            var dir = parseInt( button.getAttribute( 'data-dir' ), 10 );
            var stateKey = key === 'origin-floors' ? 'originFloors' : ( key === 'dest-floors' ? 'destFloors' : 'workers' );
            var next = Math.max( 0, Math.min( 10, state[ stateKey ] + dir ) );

            if ( next === state[ stateKey ] ) {
                return;
            }
            state[ stateKey ] = next;

            var valueEl = form.querySelector( '[data-value="' + key + '"]' );
            valueEl.textContent = new Intl.NumberFormat( 'fa-IR' ).format( next );

            var isActive = next > 0;
            var group = button.closest( '.calc-stepper__control' );
            group.querySelectorAll( '.calc-stepper__btn' ).forEach( function( b ) {
                b.classList.toggle( 'is-active', isActive && b.getAttribute( 'data-dir' ) === '1' );
            } );

            valueEl.classList.remove( 'is-bumped' );
            void valueEl.offsetWidth;
            valueEl.classList.add( 'is-bumped' );
        } );
    } );

    var packagingInput = document.getElementById( 'calc-packaging' );
    if ( packagingInput ) {
        packagingInput.addEventListener( 'change', function() {
            state.packaging = packagingInput.checked;
        } );
    }

    function calculatePrice() {
        var vehicle = PRICE_CONFIG.vehicles[ state.vehicle ];
        var total = PRICE_CONFIG.routeBase + vehicle.base;
        total += state.originFloors * PRICE_CONFIG.floorRate;
        total += state.destFloors * PRICE_CONFIG.floorRate;
        total += state.workers * PRICE_CONFIG.workerRate;
        if ( state.packaging ) {
            total += PRICE_CONFIG.packagingFee;
        }
        return total;
    }

    function animateCount( target ) {
        var start = Math.max( 0, target - target * 0.3 );
        var startTime = null;
        var duration = 700;

        function step( timestamp ) {
            if ( startTime === null ) {
                startTime = timestamp;
            }
            var progress = Math.min( ( timestamp - startTime ) / duration, 1 );
            var current = start + ( target - start ) * progress;
            priceEl.textContent = formatToman( current );

            if ( progress < 1 ) {
                requestAnimationFrame( step );
            } else {
                priceEl.textContent = formatToman( target );
            }
        }
        requestAnimationFrame( step );
    }

    form.addEventListener( 'submit', function( e ) {
        e.preventDefault();

        if ( ! state.origin || ! state.destination ) {
            notice.textContent = 'لطفاً مبدأ و مقصد را انتخاب کنید.';
            return;
        }
        if ( ! state.vehicle ) {
            notice.textContent = 'لطفاً نوع وسیله نقلیه را انتخاب کنید.';
            return;
        }
        notice.textContent = '';

        submitBtn.classList.add( 'is-loading' );
        submitBtn.disabled = true;

        window.setTimeout( function() {
            submitBtn.classList.remove( 'is-loading' );
            submitBtn.disabled = false;

            var total = calculatePrice();
            animateCount( total );

            bookingBtn.removeAttribute( 'aria-disabled' );
            bookingBtn.setAttribute( 'tabindex', '0' );
        }, 900 );
    } );
} )();