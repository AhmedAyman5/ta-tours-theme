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
