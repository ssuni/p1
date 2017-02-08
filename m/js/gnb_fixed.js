     $( document ).ready( function() {
       var jbOffset = $( '.hs_menu' ).offset();
       $( window ).scroll( function() {
	 if ( $( document ).scrollTop() > jbOffset.top ) {
	   $( '.hs_menu' ).addClass( 'jbFixed' );
	 }
	 else {
	   $( '.hs_menu' ).removeClass( 'jbFixed' );
	 }
       });
     } );