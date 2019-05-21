<?php

// Build Settings Page and Declare Options

// @since 1.1



/*

 * Add Admin Menu for Settings

 */

function jdmnll_plugin_setup_menu(){

	add_options_page( 'Native Image Lazy Loading', 'Native Lazy Loading', 'manage_options', 'jdm-native-lazy-loading', 'jdmnll_settings' );

}

add_action('admin_menu', 'jdmnll_plugin_setup_menu');



// Register our Two settings (Domain and API)

function jdmnll_register_settings() {

	$jdmnll_1stimg_args = array(

		'type' => 'string', 

		//'sanitize_callback' => 'jdmnll_domain_callback',

		'default' => NULL,

	);

	$jdmnll_nthimg_args = array(

		'type' => 'string', 

		//'sanitize_callback' => 'jdmnll_api_callback',

		'default' => NULL,

	);

	register_setting( 'jdmnll_options_group', 'jdmnll_1stimg', $jdmnll_1stimg_args );

	register_setting( 'jdmnll_options_group', 'jdmnll_nthimg', $jdmnll_nthimg_args );

}

add_action( 'admin_init', 'jdmnll_register_settings' );





// Function for Creating Settings Page; last arg in add_options_page()

function jdmnll_settings() {

	if ( !current_user_can( 'manage_options' ) )  {

		wp_die( __( 'Your user does not have access this page. Sorry about that.' ) );

	}

?>

<div class="wrap">
	
	<h1>Native Image Lazy Loading Settings</h1>
	<?php $nobug = "";
    if ( isset( $_GET['jdmnllnobug'] ) ) {
        $nobug = esc_attr( $_GET['jdmnllnobug'] );
    }

    if ( 1 == $nobug ) {
        add_option( 'jdmnll_no_bug', TRUE );
    }
	
	jdmnll_review_notice(); ?>
		
	<img src="<?php echo plugins_url( '/loading-attribute-plugin-header.jpg', __FILE__ ); ?>" alt="Native Image Lazy Loading" style="max-width:100%; height: auto; margin: 10px 0;" />
	
	<?php //settings_errors(); ?>

	<form method="post" action="options.php">
		<?php settings_fields( 'jdmnll_options_group' ); ?>
		<?php do_settings_sections( 'jdmnll_options_group' ); ?>
		<p>Please select the <code>loading</code> attribute you'd like added to the first image and the rest of the images within your content.</p>
		<p>Not sure which one to choose? That's ok.  Here's a quick reference:</p>
		<ul style="list-style: square; margin-left: 20px;">
			<li><b>lazy:</b> a good candidate for lazy loading.</li>
			<li><b>eager:</b> NOT a good candidate for lazy loading. Loads right away.</li>
			<li><b>auto:</b> browser will determine whether or not to lazily load.</li>
		</ul>

		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row"><label for="jdmnll_1stimg">First Image (in content)</label></th>
					<td>
						<?php $firstimg = esc_attr(get_option('jdmnll_1stimg', 'lazy')); ?>
						<select name="jdmnll_1stimg" id="jdmnll_1stimg">
							<option value="lazy"<?php if($firstimg == 'lazy') {echo ' selected'; } ?>>loading="lazy"</option>
							<option value="eager"<?php if($firstimg == 'eager') {echo ' selected'; } ?>>loading="eager"</option>
							<option value="auto"<?php if($firstimg == 'auto') {echo ' selected'; } ?>>loading="auto"</option>
						</select>
						<p class="description">You might want the first image in your content NOT to be lazy loaded. If so, select "eager."</p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="jdmnll_nthimg">Subsequent Images</label></th>
					<td>
						<?php $nthimg = esc_attr(get_option('jdmnll_nthimg', 'lazy')); ?>
						<select name="jdmnll_nthimg" id="jdmnll_nthimg">
							<option value="lazy"<?php if($nthimg == 'lazy') {echo ' selected'; } ?>>loading="lazy"</option>
							<option value="eager"<?php if($nthimg == 'eager') {echo ' selected'; } ?>>loading="eager"</option>
							<option value="auto"<?php if($nthimg == 'auto') {echo ' selected'; } ?>>loading="auto"</option>
						</select>
						<p class="description">This setting is for all subsequent images within your content after the first one.</p>
					</td>
				</tr>
			</tbody>
  		</table>
  		<?php submit_button('Save Settings'); ?>
	</form>
	<p>For more information about the new <code>loading</code> attribute, see our article "<a href="https://jdmdig.it/30nXp7h" target="_blank" rel="noopener nofollow">Native Image Lazy Loading Plugin Released</a>."</p>
	<?php jdmnll_debug(); ?>
</div>

	

<?php 

}
