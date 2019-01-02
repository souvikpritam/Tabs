<?php
/**
* Active Visual Composer
*/

if ( !class_exists( 'WPBakeryShortCode' ) ) {

    // Element Init
    function showVcVersionNotice() {
        $plugin_data = get_plugin_data(__FILE__);
        echo '
        <div class="updated">
          <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'Selise'), $plugin_data['Name']).'</p>
        </div>';
    }
    add_action( 'admin_notices', 'showVcVersionNotice' );

} else {
	foreach ( glob( get_template_directory() . "/vc-elements/*.php" ) as $file ) {
    	require_once $file;
	}
}