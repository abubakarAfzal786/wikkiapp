'use strict';

( function () {
		function getFormButtonToWork() {
		const submitButton = document.querySelector( '.submit-button' );
		const form = document.querySelector( 'form' );

		// Make form submit button work when submit is clicked.
		submitButton.addEventListener( 'click', (e) => {
			e.preventDefault();
			form.submit();
		} );
	}

	// Waiting for page to load which takes about 1.5 seconds on my machine.
	setTimeout( getFormButtonToWork, 1500);
}() )
