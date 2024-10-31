<?php 
/*
Plugin Name: Responsive Notification Bar
Plugin URI: http://plugins.wpflaty.com
Version: 1.0
Description: Responsive Notification Bar for Wordpress, light-weight, well-coded with cool effects!
Author: Tamim, wpflaty.com
Author URI: http://plugins.wpflaty.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// activation hook
function res_notify_setup(){
}
register_activation_hook(__FILE__,'res_notify_setup');

// enququeing style and scripts
function my_scripts_method() {
	wp_enqueue_script('jbar',plugins_url( '/js/jbar.min.js' , __FILE__ ),array( 'jquery' ));
	wp_register_style( 'res_not_style', plugins_url('/css/rnb.css', __FILE__) );
	wp_enqueue_style( 'res_not_style' );
}
add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

// deactivation hook
function res_notify_del(){
}
register_deactivation_hook(__FILE__,'res_notify_del');


// Options Page
add_action('admin_menu','res_notify_admin');

function res_notify_admin(){
	//create new top-level menu
	add_menu_page('Responsive Notification Bar', 'RNB Settings', 'administrator', __FILE__, 'rnb_settings_page',plugins_url('img/icon3.png', __FILE__),90);

	//call register settings function
	add_action( 'admin_init', 'register_rnbsettings' );
}

function register_rnbsettings() {
	//register our settings
	register_setting( 'rnb-settings-group', 'rnb_msg' );
	register_setting( 'rnb-settings-group', 'rnb_btn_text' );
	register_setting( 'rnb-settings-group', 'rnb_btn_link' );
}

function rnb_settings_page() {
?>
<div class="wrap">
<h2>Responsive Notification Bar</h2> <div class="dashicons dashicons-businessman"></div>Tamim <div class="dashicons dashicons-admin-site"></div> <a href="http://plugins.wpflaty.com">Responsive Notification Bar</a> <div class="dashicons dashicons-lightbulb"></div><a href="http://plugins.wpflaty.com">HELP</a>
<hr>

<form method="post" action="options.php">
    <?php settings_fields( 'rnb-settings-group' ); ?>
    <?php do_settings_sections( 'rnb-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Notification Message to display</th>
        <td><input type="text" name="rnb_msg" value="<?php echo get_option('rnb_msg'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Call To Action button Text</th>
        <td><input type="text" name="rnb_btn_text" value="<?php echo get_option('rnb_btn_text'); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Call To Action Button URL</th>
        <td><input type="text" name="rnb_btn_link" value="<?php echo get_option('rnb_btn_link'); ?>" /></td>
        </tr>
    </table>
    	
    <?php submit_button(); ?>

</form>
</div>
<?php }

// end

function res_notify_init(){ ?>
	
	<div class="jbar" data-init="jbar" data-jbar='{
			"message" : "<?php echo get_option('rnb_msg'); ?>",
			"button"  : "<?php echo get_option('rnb_btn_text'); ?>",
			"url"     : "<?php echo get_option('rnb_btn_link'); ?>",
			"state"   : "open"
		}'></div>
<?php }
	add_action('wp_footer','res_notify_init')
 ?>