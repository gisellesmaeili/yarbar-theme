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
            truck:  1400000, // Covered box truck / Kamionet
            khavar: 1100000, // Open-bed truck / Khavar
            nissan: 700000,  // Nissan van pickup
            pickup: 400000   // Small pickup / Pride/Peykan
        },
        workerRate: 200000,   // Per mover worker rate
        floorRate: 100000,    // Per floor stair rate
        packagingFee: 650000  // Complete packing service fee
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

        var animationToken = 0;

    function updatePriceDisplay( animate ) {
        if ( ! priceEl ) {
            return;
        }

        var target = calculateTotal();

        if ( ! animate ) {
            priceEl.textContent = formatToman( target );
            return;
        }

        animationToken++;
        var thisToken = animationToken;

        var start = target * 0.85;
        var startTime = null;
        var duration = 400;

        function frame( timestamp ) {
            if ( thisToken !== animationToken ) {
                return; // A newer calculation started — let this old loop die quietly.
            }
            if ( ! startTime ) {
                startTime = timestamp;
            }
            var progress = Math.min( ( timestamp - startTime ) / duration, 1 );
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

    // Reset all fields & recalculate CTA button ("Recalculate Cost")
    function resetCalculator() {
        // 1. Reset state
        state.origin = '';
        state.destination = '';
        state.vehicle = 'truck';
        state.workers = 3;
        state.floors = 2;
        state.packaging = false;

        // 2. Reset UI elements
        if ( originSelect ) {
            originSelect.selectedIndex = 0;
            originSelect.value = '';
        }
        if ( destSelect ) {
            destSelect.selectedIndex = 0;
            destSelect.value = '';
        }

        vehicleRadios.forEach( function( radio ) {
            radio.checked = ( radio.value === 'truck' );
        } );

        var workersEl = section.querySelector( '.step-value[data-value="workers"]' );
        if ( workersEl ) {
            workersEl.textContent = formatToman( 3 ) + ' نفر';
        }

        var floorsEl = section.querySelector( '.step-value[data-value="floors"]' );
        if ( floorsEl ) {
            floorsEl.textContent = formatToman( 2 ) + ' طبقه';
        }

        if ( packagingInput ) {
            packagingInput.checked = false;
        }

        // 3. Update price display back to default with animation
        updatePriceDisplay( true );
    }

    if ( calcBtn ) {
        calcBtn.addEventListener( 'click', resetCalculator );
    }

    // Initial render check
    updatePriceDisplay( false );
} )();