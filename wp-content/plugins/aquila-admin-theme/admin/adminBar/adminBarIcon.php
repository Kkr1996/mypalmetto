<?php if ( __FILE__ == $_SERVER['SCRIPT_FILENAME'] ) { exit; }

// Add icon in place of admin bar
function aquila_adminbar_icon() {
	if ( is_admin_bar_showing() ) {
		if ($GLOBALS['aquilaShowFullAdminbar']) {
			echo '<style>
				.aquilaFront #wpadminbar {
					display: block;
				}
				</style>';
		}
			echo '<div id="aquilaAdminbarIcon" title="Toggle Admin Bar"></div>';
	}
}
add_action( 'admin_bar_menu', 'aquila_adminbar_icon', 999 );

// Add body class
function aquila_adminbar_open_class( $classes ) {
	if ( is_admin_bar_showing() ) {
		if ($GLOBALS['aquilaShowFullAdminbar']) {
	    $classes[] = 'aquilaOpenBar';
	  } else {
	    $classes[] = 'aquilaClosedBar';
	  }
    return $classes;
  } else {
    return $classes;
  }
}
add_filter('body_class', 'aquila_adminbar_open_class');

?>