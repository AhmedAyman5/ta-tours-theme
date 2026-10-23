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
 * Reveal on scroll: [data-ta-reveal] elements and the children of
 * [data-ta-reveal-group] fade in once as they enter the viewport.
 *
 * Content is only hidden here, by JS, so it stays visible if the script fails.
 * Skipped entirely when the user prefers reduced motion.
 */
( function () {
	'use strict';

	var reduce = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	if ( reduce || ! ( 'IntersectionObserver' in window ) ) {
		return;
	}

	var STAGGER = 90; // ms between items of a group.
	var items = [];

	Array.prototype.forEach.call( document.querySelectorAll( '[data-ta-reveal]' ), function ( el ) {
		items.push( { el: el, delay: 0 } );
	} );

	Array.prototype.forEach.call( document.querySelectorAll( '[data-ta-reveal-group]' ), function ( group ) {
		Array.prototype.forEach.call( group.children, function ( el, index ) {
			items.push( { el: el, delay: Math.min( index, 5 ) * STAGGER } );
		} );
	} );

	// Once the fade has finished, drop the helper classes so hover transitions are not delayed.
	function cleanUp( event ) {
		if ( event.target !== this || event.propertyName !== 'opacity' ) {
			return;
		}
		this.classList.remove( 'ta-reveal', 'is-revealed' );
		this.style.transitionDelay = '';
		this.removeEventListener( 'transitionend', cleanUp );
	}

	var observer = new IntersectionObserver( function ( entries ) {
		entries.forEach( function ( entry ) {
			if ( entry.isIntersecting ) {
				entry.target.classList.add( 'is-revealed' );
				observer.unobserve( entry.target );
			}
		} );
	}, { rootMargin: '0px 0px -8% 0px', threshold: 0.12 } );

	var viewport = window.innerHeight || document.documentElement.clientHeight;

	items.forEach( function ( item ) {
		// Already on screen at load: leave it alone (no flash of hidden content).
		if ( item.el.getBoundingClientRect().top < viewport ) {
			return;
		}

		item.el.classList.add( 'ta-reveal' );
		item.el.style.transitionDelay = item.delay ? item.delay + 'ms' : '';
		item.el.addEventListener( 'transitionend', cleanUp );
		observer.observe( item.el );
	} );
}() );
