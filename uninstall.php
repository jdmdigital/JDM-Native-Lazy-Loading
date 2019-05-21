<?php 

// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

// Loop through and delete all options with this plugin's prefix
// Removed in v1.2 because it's too resource heavy. Will remain here commented-out.
/*
$option_prefix = 'jdmnll_';
foreach ( wp_load_alloptions() as $option => $value ) {
    if ( strpos( $option, $option_prefix ) === 0 ) {
        delete_option( $option );
    }
}
*/

// Remove Activation Date
delete_option('jdmnll_activation_date');
delete_option('jdmnll_no_bug');

// Remove options set in settings.php
delete_option('jdmnll_1stimg');
delete_option('jdmnll_nthimg');
 
// for site options in Multisite
delete_site_option('jdmnll_activation_date');
delete_site_option('jdmnll_no_bug');
delete_site_option('jdmnll_1stimg');
delete_site_option('jdmnll_nthimg');

?>