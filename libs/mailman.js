$( document ).ready(function() {


	$("input.mailman-extension").bind("enterKey",function(e){
		var email = $(this).val();
		var action = $(this).data('action');
		
		if ( action && email ) {
			mailmanPost( action, email );
		}
	});
	$("input.mailman-extension").keyup(function(e){
		if(e.keyCode == 13)
		{
			$(this).trigger("enterKey");
		}
	});

	function mailmanPost( action, email ) {
		$.post( action, { email: email })
		.done(function( data ) {
			console.log( data ); // TODO: Here returned HTML
		});
	}

	// TODO: Pending button click
	
});