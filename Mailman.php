<?php


if (!defined('MEDIAWIKI')) {
        die('Not an entry point.');
}

//self executing anonymous function to prevent global scope assumptions
call_user_func( function() {

	$GLOBALS['wgExtensionCredits']['parserhook'][] = array(
		            'path' => __FILE__,
		            'name' => "Mailman",
		            'description' => "mailman-desc",
		            'version' => 0.1, 
		            'author' => array("Toniher", "Mohr"),
		            'url' => "https://mediawiki.org/wiki/Extension:Mailman",
	);

	$GLOBALS['wgExtensionFunctions'][] = "wfMailmanExtension";
	$GLOBALS['wgMessagesDirs']['Mailman'] = __DIR__ . '/i18n';
	$GLOBALS['wgExtensionMessagesFiles']['Mailman'] = dirname( __FILE__ ) . '/Mailman.i18n.php';

} );

function wfMailmanExtension() {
	global $wgParser;
	$wgParser->setHook( "mailman", "printMailmanForm" );
}

function printMailmanForm( $input, $argv, $parser, $frame ) {

	// Substitute listinfo -> subscribe
	// More improvement possible here
	$input = $parser->recursiveTagParse( $input, $frame );
	$input = preg_replace('/listinfo/', 'subscribe', $input);
	$input = strip_tags( $input );
	
	
	$output = "<form action=\"$input\" method=\"post\">".
	  "<input name=\"email\" type=\"text\" value=\"".wfMessage("mailman-email")->escaped()."\" onfocus=\"cleartext(this)\" class='mailman-extension' />".
	  "<input name=\"email-button\" type=\"submit\" value=\"".wfMessage("mailman-subscribe")->escaped()."\" />".
	  "</form>";
	return $output;
}

