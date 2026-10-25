/**
 * TA Tours admin: remember when the offer tips box is dismissed.
 */
( function () {
	'use strict';

	document.addEventListener( 'click', function ( event ) {
		var button = event.target.closest( '.ta-offer-tips .notice-dismiss' );

		if ( ! button || ! window.ajaxurl ) {
			return;
		}

		var box  = button.closest( '.ta-offer-tips' );
		var body = new URLSearchParams();

		body.append( 'action', 'ta_dismiss_offer_tips' );
		body.append( 'nonce', box.getAttribute( 'data-nonce' ) || '' );

		window.fetch( window.ajaxurl, {
			method: 'POST',
			credentials: 'same-origin',
			body: body
		} );
	} );
}() );
