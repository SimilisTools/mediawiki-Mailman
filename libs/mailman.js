$( document ).ready(function() {


	$(".mailman-mw input.mailman-extension").bind("enterKey",function(e){
		var email = $(this).val();
		var action = $(this).data('action');
		
		if ( action && email ) {
			mailmanPost( action, email, this );
		}
	});
	$(".mailman-mw input.mailman-extension").keyup(function(e){
		if(e.keyCode == 13)
		{
			$(this).trigger("enterKey");
		}
	});
	
	$(".mailman-mw").on( "focus", "input.mailman-extension", function(){
		$(this).attr("value", "");
	});

	$( ".mailman-mw" ).on( "click", "input[type='button']", function() {

		var input = $( $(this).parent().find("input.mailman-extension") ).get(0);
		var email = $(input).val();
		var action = $(input).data('action');
		
		if ( action && email ) {
			mailmanPost( action, email, input );
		}
	});

	function mailmanPost( action, email, context ) {
		$.post( action, { email: email });
		$(context).parent().append("<p class='mailman-message'>Subscribed. Check your email</p>");
	}

});
