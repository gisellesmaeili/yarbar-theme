/**
 * YarBar Interactive Cost Estimator
 *
 * Lightweight, Vanilla JS, Zero layout shifts.
 */
( function() {
    'use strict';

    var section = document.getElementById( 'calculator' );
    if ( ! section ) {
        return;
    }

    // Pricing Matrix (in Toman)
    var PRICING = {
        base: 250000,
        routes: {
            'tehran-north': 150000,
            'tehran-center': 150000,
            'karaj': 350000,
            'intercity': 1200000
        },
        vehicles: {
            truck:  1400000, // کامیونت مسقف
            khavar: 1100000, // خاور روباز
            nissan: 700000,  // نیسان بار
            pickup: 400000   // وانت پراید/پیکان
        },
        workerRate: 200000,   // به ازای هر کارگر
        floorRate: 100000,    // به ازای هر طبقه
        packagingFee: 650000  // خدمات کامل بسته‌بندی
    };

    var state = {
        origin: '',
        destination: '',
        vehicle: 'truck',
        workers: 3,
        floors: 2,
        packaging: false
    };

    var priceEl = document.getElementById( 'finalPrice' );
    var originSelect = document.getElementById( 'origin' );
    var destSelect = document.getElementById( 'destination' );
    var packagingInput = document.getElementById( 'calc-packaging' );
    var calcBtn = document.getElementById( 'calculateBtn' );
    var vehicleRadios = section.querySelectorAll( 'input[name="vehicle"]' );
    var stepperBtns = section.querySelectorAll( '.step-btn' );

    var faFormatter = new Intl.NumberFormat( 'fa-IR' );

    function formatToman( num ) {
        return faFormatter.format( Math.round( num ) );
    }

    function calculateTotal() {
        var total = PRICING.base;

        // Vehicle cost
        if ( PRICING.vehicles[ state.vehicle ] ) {
            total += PRICING.vehicles[ state.vehicle ];
        }

        // Route adjustment if selected
        if ( state.origin && PRICING.routes[ state.origin ] ) {
            total += PRICING.routes[ state.origin ];
        }
        if ( state.destination && PRICING.routes[ state.destination ] ) {
            total += PRICING.routes[ state.destination ];
        }

        // Workers & Floors
        total += state.workers * PRICING.workerRate;
        total += state.floors * PRICING.floorRate;

        // Packaging
        if ( state.packaging ) {
            total += PRICING.packagingFee;
        }

        return total;
    }

    function updatePriceDisplay( animate ) {
        if ( ! priceEl ) {
            return;
        }

        var target = calculateTotal();

        if ( ! animate ) {
            priceEl.textContent = formatToman( target );
            return;
        }

        var currentText = priceEl.textContent.replace( /[^\d۰-۹]/g, '' );
        var start = target * 0.85;
        var startTime = null;
        var duration = 400;

        function frame( timestamp ) {
            if ( ! startTime ) {
                startTime = timestamp;
            }
            var progress = Math.min( ( timestamp - startTime ) / duration, 1 );
            // Ease out cubic
            var easeProgress = 1 - Math.pow( 1 - progress, 3 );
            var current = start + ( target - start ) * easeProgress;
            priceEl.textContent = formatToman( current );

            if ( progress < 1 ) {
                requestAnimationFrame( frame );
            } else {
                priceEl.textContent = formatToman( target );
            }
        }

        requestAnimationFrame( frame );
    }

    // Origin / Destination changes
    if ( originSelect ) {
        originSelect.addEventListener( 'change', function() {
            state.origin = this.value;
            updatePriceDisplay( true );
        } );
    }

    if ( destSelect ) {
        destSelect.addEventListener( 'change', function() {
            state.destination = this.value;
            updatePriceDisplay( true );
        } );
    }

    // Vehicle radio selection
    vehicleRadios.forEach( function( radio ) {
        if ( radio.checked ) {
            state.vehicle = radio.value;
        }
        radio.addEventListener( 'change', function() {
            if ( this.checked ) {
                state.vehicle = this.value;
                updatePriceDisplay( true );
            }
        } );
    } );

    // Steppers (Workers & Floors)
    stepperBtns.forEach( function( btn ) {
        btn.addEventListener( 'click', function() {
            var key = this.getAttribute( 'data-stepper' );
            var dir = parseInt( this.getAttribute( 'data-dir' ), 10 ) || 0;
            var valEl = section.querySelector( '.step-value[data-value="' + key + '"]' );

            if ( key === 'workers' ) {
                state.workers = Math.max( 0, Math.min( 12, state.workers + dir ) );
                if ( valEl ) {
                    valEl.textContent = formatToman( state.workers ) + ' نفر';
                }
            } else if ( key === 'floors' ) {
                state.floors = Math.max( 0, Math.min( 20, state.floors + dir ) );
                if ( valEl ) {
                    valEl.textContent = formatToman( state.floors ) + ' طبقه';
                }
            }

            updatePriceDisplay( true );
        } );
    } );

    // Packaging toggle
    if ( packagingInput ) {
        packagingInput.addEventListener( 'change', function() {
            state.packaging = this.checked;
            updatePriceDisplay( true );
        } );
    }

    // Recalculate CTA button
    if ( calcBtn ) {
        calcBtn.addEventListener( 'click', function() {
            updatePriceDisplay( true );
        } );
    }

    // Initial render check
    updatePriceDisplay( false );
} )();