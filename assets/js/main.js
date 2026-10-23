/**
 * TA Tours — front-end behaviour (vanilla JS, no dependencies).
 */
( function () {
	'use strict';

	var header = document.querySelector( '[data-ta-header]' );
	if ( ! header ) {
		return;
	}

	var toggle = header.querySelector( '[data-ta-menu-toggle]' );
	var panel = header.querySelector( '[data-ta-menu-panel]' );
	var desktop = window.matchMedia( '(min-width: 960px)' );

	if ( ! toggle || ! panel ) {
		return;
	}

	function isOpen() {
		return toggle.getAttribute( 'aria-expanded' ) === 'true';
	}

	function open() {
		header.classList.add( 'is-open' );
		toggle.setAttribute( 'aria-expanded', 'true' );

		var first = panel.querySelector( 'a, button' );
		if ( first ) {
			first.focus();
		}
	}

	function close( returnFocus ) {
		if ( ! isOpen() ) {
			return;
		}

		header.classList.remove( 'is-open' );
		toggle.setAttribute( 'aria-expanded', 'false' );

		if ( returnFocus ) {
			toggle.focus();
		}
	}

	toggle.addEventListener( 'click', function () {
		if ( isOpen() ) {
			close( false );
		} else {
			open();
		}
	} );

	// Escape closes the menu and returns focus to the toggle.
	document.addEventListener( 'keydown', function ( event ) {
		if ( event.key === 'Escape' && isOpen() ) {
			close( true );
		}
	} );

	// Close when focus moves outside the header (e.g. tabbing past the last link).
	header.addEventListener( 'focusout', function ( event ) {
		if ( isOpen() && event.relatedTarget && ! header.contains( event.relatedTarget ) ) {
			close( false );
		}
	} );

	// Close on a click outside the header.
	document.addEventListener( 'click', function ( event ) {
		if ( isOpen() && ! header.contains( event.target ) ) {
			close( false );
		}
	} );

	// Reset when the layout switches to desktop.
	function onBreakpoint( mq ) {
		if ( mq.matches ) {
			close( false );
		}
	}

	if ( desktop.addEventListener ) {
		desktop.addEventListener( 'change', onBreakpoint );
	} else if ( desktop.addListener ) {
		desktop.addListener( onBreakpoint );
	}
}() );

/**
 * Motion: reveal on scroll, number count-up, header state and hero parallax.
 *
 * API (see CLAUDE.md → Motion & Animation):
 * - data-reveal="fade-up|fade-in|zoom-in|slide-start|slide-end" on an element.
 * - data-reveal-stagger="<variant>" on a parent: its children reveal one after another.
 * - data-reveal-delay="<ms>" adds a fixed delay to one element.
 * - data-countup on an element whose text is the final number.
 * - data-parallax on the hero image.
 *
 * The hidden start state lives in CSS under html.js, so content stays visible without JS.
 */
( function () {
	'use strict';

	var root = document.documentElement;
	var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' );
	var STAGGER = 100; // ms between items of a group.
	var MAX_STEPS = 5; // Cap the stagger so long grids never wait too long.
	var REVEAL_MS = 700; // Matches --ta-dur-reveal in main.css.
	var COUNT_MS = 1200;
	var SCROLLED_AT = 40; // px before the header switches to its compact state.
	var PARALLAX_RATE = 0.15;

	// Tells the no-JS safety net in <head> that motion is running.
	root.classList.add( 'ta-motion' );

	function each( list, fn ) {
		Array.prototype.forEach.call( list, fn );
	}

	/* Reveal ---------------------------------------------------------------- */

	var revealItems = document.querySelectorAll( '[data-reveal], [data-reveal-stagger] > *' );

	function reveal( el, delay ) {
		var total = delay + ( parseInt( el.getAttribute( 'data-reveal-delay' ), 10 ) || 0 );

		if ( total ) {
			el.style.setProperty( '--ta-reveal-delay', total + 'ms' );
		}
		el.classList.add( 'is-revealing', 'is-revealed' );

		// Once the entrance is over, hand the element its own transitions back (hover etc.).
		window.setTimeout( function () {
			el.classList.remove( 'is-revealing' );
			el.style.removeProperty( '--ta-reveal-delay' );
		}, total + REVEAL_MS + 50 );
	}

	if ( reduce.matches || ! ( 'IntersectionObserver' in window ) ) {
		each( revealItems, function ( el ) {
			el.classList.add( 'is-revealed' );
		} );
	} else {
		var revealObserver = new IntersectionObserver( function ( entries ) {
			// Stagger counts restart for each batch, so a grid row entering later starts at once.
			var parents = [];
			var steps = [];

			entries.forEach( function ( entry ) {
				if ( ! entry.isIntersecting ) {
					return;
				}

				var el = entry.target;
				var parent = el.parentElement;
				var delay = 0;

				if ( parent && parent.hasAttribute( 'data-reveal-stagger' ) ) {
					var i = parents.indexOf( parent );
					if ( -1 === i ) {
						i = parents.push( parent ) - 1;
						steps[ i ] = 0;
					}
					delay = Math.min( steps[ i ]++, MAX_STEPS ) * STAGGER;
				}

				reveal( el, delay );
				revealObserver.unobserve( el );
			} );
		}, { rootMargin: '0px 0px -8% 0px', threshold: 0.12 } );

		each( revealItems, function ( el ) {
			revealObserver.observe( el );
		} );
	}

	/* Count-up -------------------------------------------------------------- */

	function countUp( el ) {
		var finalText = el.textContent.trim();
		var target = parseInt( finalText.replace( /\D/g, '' ), 10 );

		if ( ! target ) {
			return;
		}

		// Years count from their century (2016 → from 2000); other numbers from 0.
		var from = target >= 1000 ? Math.floor( target / 100 ) * 100 : 0;
		var start = null;

		// Screen readers get the final value only, never the changing digits.
		var label = document.createElement( 'span' );
		label.className = 'ta-visually-hidden';
		label.textContent = finalText;
		el.parentNode.insertBefore( label, el.nextSibling );
		el.setAttribute( 'aria-hidden', 'true' );

		// Reserve the final width so the digits never push the layout around.
		el.style.minInlineSize = el.offsetWidth + 'px';
		el.textContent = String( from );

		function frame( now ) {
			if ( null === start ) {
				start = now;
			}
			var t = Math.min( ( now - start ) / COUNT_MS, 1 );
			var eased = 1 - Math.pow( 1 - t, 4 ); // Close to the site easing curve.

			el.textContent = String( Math.round( from + ( target - from ) * eased ) );

			if ( t < 1 ) {
				window.requestAnimationFrame( frame );
			} else {
				el.textContent = finalText;
			}
		}

		window.requestAnimationFrame( frame );
	}

	var counters = document.querySelectorAll( '[data-countup]' );

	if ( counters.length && ! reduce.matches && 'IntersectionObserver' in window ) {
		var countObserver = new IntersectionObserver( function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( entry.isIntersecting ) {
					countObserver.unobserve( entry.target );
					countUp( entry.target );
				}
			} );
		}, { threshold: 0.6 } );

		each( counters, function ( el ) {
			countObserver.observe( el );
		} );
	}

	/* Header state + hero parallax (one rAF-throttled scroll handler) -------- */

	var header = document.querySelector( '[data-ta-header]' );
	var parallaxImg = document.querySelector( '[data-parallax]' );
	var parallaxMq = window.matchMedia( '(min-width: 960px) and (hover: hover) and (pointer: fine)' );
	var ticking = false;

	if ( ! header && ! parallaxImg ) {
		return;
	}

	function update() {
		ticking = false;

		var y = window.pageYOffset || root.scrollTop;

		if ( header ) {
			header.classList.toggle( 'is-scrolled', y > SCROLLED_AT );
		}

		if ( parallaxImg ) {
			var active = parallaxMq.matches && ! reduce.matches;
			var limit = parallaxImg.parentNode.offsetHeight;

			if ( active && y < limit ) {
				parallaxImg.style.transform = 'translate3d(0, ' + ( y * PARALLAX_RATE ).toFixed( 1 ) + 'px, 0)';
			} else if ( ! active && parallaxImg.style.transform ) {
				parallaxImg.style.transform = '';
			}
		}
	}

	function requestUpdate() {
		if ( ! ticking ) {
			ticking = true;
			window.requestAnimationFrame( update );
		}
	}

	window.addEventListener( 'scroll', requestUpdate, { passive: true } );
	window.addEventListener( 'resize', requestUpdate, { passive: true } );
	update();
}() );
