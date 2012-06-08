<?php
/**
 * This file handles the creation of the Genesis Palette admin menu.
 */


/**
 * Registers a new admin page, providing content and corresponding menu item
 * for the Design Settings page.
 *
 * @since 1.8.0
 */

class Genesis_Palette_Admin extends Genesis_Admin_Boxes {
	
	/**
	 * Create an admin menu item and settings page.
	 * 
	 * @since 1.0.0
	 */
	function __construct() {

		// load my CSS and javascript
		add_action( 'admin_enqueue_scripts', array( &$this, 'gs_file_loads' ) );

		if ( is_admin() ){
			$this->gs_writecheck();
			add_action('admin_notices', array(&$this, 'gs_error_notice'));
		}
		
		// Specify a unique page ID. 
		$page_id = 'gsd_design';
		
		// Set it as a child to genesis, and define the menu and page titles
		$menu_ops = array(
			'submenu' => array(
				'parent_slug'	=> 'genesis',
				'page_title'	=> 'Design Palette',
				'menu_title'	=> 'Design Palette',
				'capability'	=> 'manage_options',
			)
		);
		
		// Set up page options. These are optional, so only uncomment if you want to change the defaults
		$page_ops = array(
			'screen_icon'       => 'gsd-icon',
			'save_button_text'  => 'Save Design',
			'reset_button_text' => 'Clear Design',
			'save_notice_text'  => 'Design saved.',
			'reset_notice_text' => 'Design cleared.',
		);		
		
		// Give it a unique settings field. 
		// You'll access them from genesis_get_option( 'option_name', 'child-settings' );
		// $color = genesis_get_option( 'body_text', 'ihop-settings' );
		$settings_field = 'gs-settings';
		
		// Set the default values
		$default_settings = array(
			// switch
			'gs_switch'		=> '',

			// background colors
			'body_bg'		=> '#D5D5D5',
			'wrap_bg'		=> '#FFFFFF',
			'head_bg'		=> '#FFFFFF',
			'navi_bg'		=> '#F5F5F5',
			'innr_bg'		=> '#FFFFFF',
			'side_bg'		=> '#F5F5F5',
			'foot_bg'		=> '#F5F5F5',

			// text colors
			'body_text'		=> '#333333',
			'head_text'		=> '#333333',
			'desc_text'		=> '#333333',
			'post_text'		=> '#333333',
			'meta_text'		=> '#333333',
			'side_text'		=> '#333333',
			'widg_text'		=> '#333333',
			'foot_text'		=> '#333333',
			
			// link colors
			'body_link'		=> '#0D72C7',
			'navi_link'		=> '#333333',
			'meta_link'		=> '#0D72C7',
			'widg_link'		=> '#0D72C7',
			'foot_link'		=> '#333333',

			// hover colors
			'body_hover'	=> '#0D72C7',
			'head_hover'	=> '#333333',
			'navi_hover'	=> '#333333',
			'meta_hover'	=> '#0D72C7',
			'post_hover'	=> '#0D72C7',
			'widg_hover'	=> '#0D72C7',
			'foot_hover'	=> '#0D72C7',
			
			// borders			
			'wrap_bord'		=> '#999999',
			'navi_bord'		=> '#DDDDDD',
			'widg_bord'		=> '#DDDDDD',
			'list_bord'		=> '#DDDDDD',			
			'foot_bord'		=> '#DDDDDD',
			
			// font stacks
			'body_font'		=> '',
			'head_font'		=> '',
			'desc_font'		=> '',			
			'navi_font'		=> '',
			'post_font'		=> '',
			'meta_font'		=> '',
			'side_font'		=> '',
			'widg_font'		=> '',
			'foot_font'		=> '',
			
			// font sizes
			'body_size'		=> '16px',
			'head_size'		=> '36px',
			'desc_size'		=> '14px',			
			'navi_size'		=> '14px',
			'post_size'		=> '28px',
			'meta_size'		=> '14px',
			'side_size'		=> '14px',
			'widg_size'		=> '14px',
			'foot_size'		=> '14px',
			
			// font weight
			'body_weight'	=> '300',
			'head_weight'	=> '300',
			'desc_weight'	=> '300',
			'navi_weight'	=> '300',
			'post_weight'	=> '300',
			'meta_weight'	=> '300',
			'side_weight'	=> '300',
			'widg_weight'	=> '300',
			'foot_weight'	=> '300',

			// transforms			
			'head_caps'		=> 'uppercase',
			'desc_caps'		=> 'none',
			'post_caps'		=> 'none',
			'widg_caps'		=> 'none',

			// content h
			'cont_h1'		=> '30px',
			'cont_h2'		=> '28px',
			'cont_h3'		=> '24px',
			'cont_h4'		=> '20px',
			'cont_h5'		=> '18px',
			'cont_h6'		=> '16px',
		);
		
		// Create the Admin Page
		$this->create( $page_id, $menu_ops, $page_ops, $settings_field, $default_settings );


		// Initialize the Sanitization Filter
//		add_action( 'genesis_settings_sanitizer_init', array( $this, 'sanitization_filters' ) );
			
	}

	function gs_file_loads() {
	global $current_screen;
		if ( 'genesis_page_gsd_design' == $current_screen->id ) {
			// grab colorpicker because Farbtastic sucks
			wp_enqueue_script('jscolor', plugins_url('/jscolor/jscolor.js', __FILE__), array ('jquery'), null, false);
			wp_enqueue_script('js-init', plugins_url('/js/gs.init.js', __FILE__), array ('jquery'), null, true);
			wp_enqueue_style( 'gs-admin', plugins_url('/css/gs-admin.css', __FILE__) );
		}
	}

	// check to make sure that the folder is writeable
	
	public function gs_error_notice() {
		global $current_screen;
		if ( 'genesis_page_gsd_design' == $current_screen->id ) {		
		// errors
		if(isset($this->errors) ) :
			foreach($this->errors as $err){
				echo $err;
			}
		endif;
		}
	}
	
	public function gs_writecheck() {
		$gsd_css_file	= GS_PLUGIN_DIR.'/css/gs-custom.css';
			
		if (!is_writable($gsd_css_file)) {
			$this->errors[] = '<div id="message" class="error below-h2"><p><strong>'.__('The gs-custom.css file must be writable to save any customizations').'</strong></p></div>';
		}
	}

	/**
	 * Set up Help Tab
	 * Genesis automatically looks for a help() function, and if provided uses it for the help tabs
	 * @link http://wpdevel.wordpress.com/2011/12/06/help-and-screen-api-changes-in-3-3/
	 *
	 * @since 1.0.0
	 */
	 function help() {
	 	$screen = get_current_screen();

		$screen->add_help_tab( array(
			'id'      => 'gs-help', 
			'title'   => 'General',
			'content' => '<p>Click a field to generate a color</p>',
		) );
	 }
	
	/**
	 * Register metaboxes on admin settings page
	 *
	 * @since 1.0.0
	 *
	 */
	function metaboxes() {
		
		add_meta_box('gs-design-panel', 'Genesis Design Palette', array( $this, 'gsd_design_panel' ), $this->pagehook, 'main', 'high');
		
	}
	
	/**
	 * Callback for Design metabox
	 *
	 * @since 1.0.0
	 *
	 */
	function gsd_design_panel() {
		
	echo '<div class="design_group core_group">';
		
		echo '<h4>General Settings</h4>';
		echo '<div class="dg_inner">';
		echo '<p class="nobreak"><label><input class="switch" type="checkbox" name="' . $this->get_field_name( 'gs_switch' ) . '" id="' . $this->get_field_id( 'gs_switch' ) . '" value="true" '.checked($this->get_field_value( 'gs_switch' ), "true", false).'/>Load custom CSS file on site</label></p>';
		echo '</div>';
	echo '</div>';

	echo '<div class="design_group colors_group">';
	echo '<h4>Colors<input type="button" class="toggle_group" name="colors" value="show"></h4>';
	echo '<div class="dg_wrap" name="colors">';
		echo '<div class="dg_inner">';
		echo '<h5>Backgrounds</h5>';
		echo '<p><label>Body</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'body_bg' ) . '" id="' . $this->get_field_id( 'body_bg' ) . '" value="' . esc_attr( $this->get_field_value( 'body_bg' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Wrap</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'wrap_bg' ) . '" id="' . $this->get_field_id( 'wrap_bg' ) . '" value="' . esc_attr( $this->get_field_value( 'wrap_bg' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Header</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'head_bg' ) . '" id="' . $this->get_field_id( 'head_bg' ) . '" value="' . esc_attr( $this->get_field_value( 'head_bg' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Navigation</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'navi_bg' ) . '" id="' . $this->get_field_id( 'navi_bg' ) . '" value="' . esc_attr( $this->get_field_value( 'navi_bg' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Interior</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'innr_bg' ) . '" id="' . $this->get_field_id( 'innr_bg' ) . '" value="' . esc_attr( $this->get_field_value( 'innr_bg' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Widget Title</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'side_bg' ) . '" id="' . $this->get_field_id( 'side_bg' ) . '" value="' . esc_attr( $this->get_field_value( 'side_bg' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Footer</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'foot_bg' ) . '" id="' . $this->get_field_id( 'foot_bg' ) . '" value="' . esc_attr( $this->get_field_value( 'foot_bg' ) ) . '" size="20" />';
		echo '</p>';	
		echo '</div>';
		// end backgrounds

		echo '<div class="dg_inner">';
		echo '<h5>Text</h5>';
		
		echo '<p><label>Body Text</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'body_text' ) . '" id="' . $this->get_field_id( 'body_text' ) . '" value="' . esc_attr( $this->get_field_value( 'body_text' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Site Title</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'head_text' ) . '" id="' . $this->get_field_id( 'head_text' ) . '" value="' . esc_attr( $this->get_field_value( 'head_text' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Site Description</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'desc_text' ) . '" id="' . $this->get_field_id( 'desc_text' ) . '" value="' . esc_attr( $this->get_field_value( 'desc_text' ) ) . '" size="20" />';
		echo '</p>';		

		echo '<p><label>Post Title</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'post_text' ) . '" id="' . $this->get_field_id( 'post_text' ) . '" value="' . esc_attr( $this->get_field_value( 'post_text' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Post Meta</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'meta_text' ) . '" id="' . $this->get_field_id( 'meta_text' ) . '" value="' . esc_attr( $this->get_field_value( 'meta_text' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Widget Title</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'side_text' ) . '" id="' . $this->get_field_id( 'side_text' ) . '" value="' . esc_attr( $this->get_field_value( 'side_text' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Widget Text</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'widg_text' ) . '" id="' . $this->get_field_id( 'widg_text' ) . '" value="' . esc_attr( $this->get_field_value( 'widg_text' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Footer Text</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'foot_text' ) . '" id="' . $this->get_field_id( 'foot_text' ) . '" value="' . esc_attr( $this->get_field_value( 'foot_text' ) ) . '" size="20" />';
		echo '</p>';
				
		echo '</div>'; // end text

		echo '<div class="dg_inner">';
		echo '<h5>Links (Regular)</h5>';
		
		echo '<p><label>Body Text</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'body_link' ) . '" id="' . $this->get_field_id( 'body_link' ) . '" value="' . esc_attr( $this->get_field_value( 'body_link' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Navigation</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'navi_link' ) . '" id="' . $this->get_field_id( 'navi_link' ) . '" value="' . esc_attr( $this->get_field_value( 'navi_link' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Post Meta</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'meta_link' ) . '" id="' . $this->get_field_id( 'meta_link' ) . '" value="' . esc_attr( $this->get_field_value( 'meta_link' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Sidebar Links</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'widg_link' ) . '" id="' . $this->get_field_id( 'widg_link' ) . '" value="' . esc_attr( $this->get_field_value( 'widg_link' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Footer Links</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'foot_link' ) . '" id="' . $this->get_field_id( 'foot_link' ) . '" value="' . esc_attr( $this->get_field_value( 'foot_link' ) ) . '" size="20" />';
		echo '</p>';
				
		echo '</div>'; // end regular links

		echo '<div class="dg_inner">';
		echo '<h5>Links (Hover)</h5>';
		
		echo '<p><label>Body Text</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'body_hover' ) . '" id="' . $this->get_field_id( 'body_hover' ) . '" value="' . esc_attr( $this->get_field_value( 'body_hover' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Site Title</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'head_hover' ) . '" id="' . $this->get_field_id( 'head_hover' ) . '" value="' . esc_attr( $this->get_field_value( 'head_hover' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Navigation</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'navi_hover' ) . '" id="' . $this->get_field_id( 'navi_hover' ) . '" value="' . esc_attr( $this->get_field_value( 'navi_hover' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Post Title</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'post_hover' ) . '" id="' . $this->get_field_id( 'post_hover' ) . '" value="' . esc_attr( $this->get_field_value( 'post_hover' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Post Meta</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'meta_hover' ) . '" id="' . $this->get_field_id( 'meta_hover' ) . '" value="' . esc_attr( $this->get_field_value( 'meta_hover' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Sidebar Links</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'widg_hover' ) . '" id="' . $this->get_field_id( 'widg_hover' ) . '" value="' . esc_attr( $this->get_field_value( 'widg_hover' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Footer Links</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'foot_hover' ) . '" id="' . $this->get_field_id( 'foot_hover' ) . '" value="' . esc_attr( $this->get_field_value( 'foot_hover' ) ) . '" size="20" />';
		echo '</p>';
				
		echo '</div>'; // end regular links

		echo '<div class="dg_inner">';
		echo '<h5>Borders</h5>';
		
		echo '<p><label>Outer Shadow</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'wrap_bord' ) . '" id="' . $this->get_field_id( 'wrap_bord' ) . '" value="' . esc_attr( $this->get_field_value( 'wrap_bord' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Navigation</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'navi_bord' ) . '" id="' . $this->get_field_id( 'navi_bord' ) . '" value="' . esc_attr( $this->get_field_value( 'navi_bord' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Widgets</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'widg_bord' ) . '" id="' . $this->get_field_id( 'widg_bord' ) . '" value="' . esc_attr( $this->get_field_value( 'widg_bord' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Widget Lists</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'list_bord' ) . '" id="' . $this->get_field_id( 'list_bord' ) . '" value="' . esc_attr( $this->get_field_value( 'list_bord' ) ) . '" size="20" />';
		echo '</p>';

		echo '<p><label>Footer</label>';
		echo '<input class="color {hash:true}" type="text" name="' . $this->get_field_name( 'foot_bord' ) . '" id="' . $this->get_field_id( 'foot_bord' ) . '" value="' . esc_attr( $this->get_field_value( 'foot_bord' ) ) . '" size="20" />';
		echo '</p>';

		echo '</div>'; // end borders

	echo '</div>'; // end inner wrap
	echo '</div>'; // end colors group

	echo '<div class="design_group font_group">';
	echo '<h4>Typography<input type="button" class="toggle_group" name="typography" value="show"></h4>';
	echo '<div class="dg_wrap" name="typography">';
		echo '<div class="dg_inner">';
		echo '<h5>Font Stacks</h5>';
		echo '<p><label>Body Text</label>';
		echo '<select class="font_stack" name="' . $this->get_field_name( 'body_font' ) . '" id="' . $this->get_field_id( 'body_font' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'body_font' ) );
				$selected	= (!empty($option)) ? $option : '4';
				echo '<option class="timesnew" value="1"',	$selected == '1' ? ' selected="selected"' : '', '>Times New Roman</option>';
				echo '<option class="georgia" value="2"',	$selected == '2' ? ' selected="selected"' : '', '>Georgia</option>';
				echo '<option class="garamond" value="3"',	$selected == '3' ? ' selected="selected"' : '', '>Garamond</option>';
				echo '<option class="helvetica" value="4"',	$selected == '4' ? ' selected="selected"' : '', '>Helvetica</option>';
				echo '<option class="verdana" value="5"',	$selected == '5' ? ' selected="selected"' : '', '>Verdana</option>';
				echo '<option class="trebuchet" value="6"',	$selected == '6' ? ' selected="selected"' : '', '>Trebuchet</option>';				
				echo '<option class="impact" value="7"',	$selected == '7' ? ' selected="selected"' : '', '>Impact</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Site Title</label>';
		echo '<select class="font_stack" name="' . $this->get_field_name( 'head_font' ) . '" id="' . $this->get_field_id( 'head_font' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'head_font' ) );
				$selected	= (!empty($option)) ? $option : '4';
				echo '<option class="timesnew" value="1"',	$selected == '1' ? ' selected="selected"' : '', '>Times New Roman</option>';
				echo '<option class="georgia" value="2"',	$selected == '2' ? ' selected="selected"' : '', '>Georgia</option>';
				echo '<option class="garamond" value="3"',	$selected == '3' ? ' selected="selected"' : '', '>Garamond</option>';
				echo '<option class="helvetica" value="4"',	$selected == '4' ? ' selected="selected"' : '', '>Helvetica</option>';
				echo '<option class="verdana" value="5"',	$selected == '5' ? ' selected="selected"' : '', '>Verdana</option>';
				echo '<option class="trebuchet" value="6"',	$selected == '6' ? ' selected="selected"' : '', '>Trebuchet</option>';				
				echo '<option class="impact" value="7"',	$selected == '7' ? ' selected="selected"' : '', '>Impact</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Site Description</label>';
		echo '<select class="font_stack" name="' . $this->get_field_name( 'desc_font' ) . '" id="' . $this->get_field_id( 'desc_font' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'desc_font' ) );
				$selected	= (!empty($option)) ? $option : '4';
				echo '<option class="timesnew" value="1"',	$selected == '1' ? ' selected="selected"' : '', '>Times New Roman</option>';
				echo '<option class="georgia" value="2"',	$selected == '2' ? ' selected="selected"' : '', '>Georgia</option>';
				echo '<option class="garamond" value="3"',	$selected == '3' ? ' selected="selected"' : '', '>Garamond</option>';
				echo '<option class="helvetica" value="4"',	$selected == '4' ? ' selected="selected"' : '', '>Helvetica</option>';
				echo '<option class="verdana" value="5"',	$selected == '5' ? ' selected="selected"' : '', '>Verdana</option>';
				echo '<option class="trebuchet" value="6"',	$selected == '6' ? ' selected="selected"' : '', '>Trebuchet</option>';				
				echo '<option class="impact" value="7"',	$selected == '7' ? ' selected="selected"' : '', '>Impact</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Navigation</label>';
		echo '<select class="font_stack" name="' . $this->get_field_name( 'navi_font' ) . '" id="' . $this->get_field_id( 'navi_font' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'navi_font' ) );
				$selected	= (!empty($option)) ? $option : '4';
				echo '<option class="timesnew" value="1"',	$selected == '1' ? ' selected="selected"' : '', '>Times New Roman</option>';
				echo '<option class="georgia" value="2"',	$selected == '2' ? ' selected="selected"' : '', '>Georgia</option>';
				echo '<option class="garamond" value="3"',	$selected == '3' ? ' selected="selected"' : '', '>Garamond</option>';
				echo '<option class="helvetica" value="4"',	$selected == '4' ? ' selected="selected"' : '', '>Helvetica</option>';
				echo '<option class="verdana" value="5"',	$selected == '5' ? ' selected="selected"' : '', '>Verdana</option>';
				echo '<option class="trebuchet" value="6"',	$selected == '6' ? ' selected="selected"' : '', '>Trebuchet</option>';				
				echo '<option class="impact" value="7"',	$selected == '7' ? ' selected="selected"' : '', '>Impact</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Post Title</label>';
		echo '<select class="font_stack" name="' . $this->get_field_name( 'post_font' ) . '" id="' . $this->get_field_id( 'post_font' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'post_font' ) );
				$selected	= (!empty($option)) ? $option : '4';
				echo '<option class="timesnew" value="1"',	$selected == '1' ? ' selected="selected"' : '', '>Times New Roman</option>';
				echo '<option class="georgia" value="2"',	$selected == '2' ? ' selected="selected"' : '', '>Georgia</option>';
				echo '<option class="garamond" value="3"',	$selected == '3' ? ' selected="selected"' : '', '>Garamond</option>';
				echo '<option class="helvetica" value="4"',	$selected == '4' ? ' selected="selected"' : '', '>Helvetica</option>';
				echo '<option class="verdana" value="5"',	$selected == '5' ? ' selected="selected"' : '', '>Verdana</option>';
				echo '<option class="trebuchet" value="6"',	$selected == '6' ? ' selected="selected"' : '', '>Trebuchet</option>';				
				echo '<option class="impact" value="7"',	$selected == '7' ? ' selected="selected"' : '', '>Impact</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Post Meta</label>';
		echo '<select class="font_stack" name="' . $this->get_field_name( 'meta_font' ) . '" id="' . $this->get_field_id( 'meta_font' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'meta_font' ) );
				$selected	= (!empty($option)) ? $option : '4';
				echo '<option class="timesnew" value="1"',	$selected == '1' ? ' selected="selected"' : '', '>Times New Roman</option>';
				echo '<option class="georgia" value="2"',	$selected == '2' ? ' selected="selected"' : '', '>Georgia</option>';
				echo '<option class="garamond" value="3"',	$selected == '3' ? ' selected="selected"' : '', '>Garamond</option>';
				echo '<option class="helvetica" value="4"',	$selected == '4' ? ' selected="selected"' : '', '>Helvetica</option>';
				echo '<option class="verdana" value="5"',	$selected == '5' ? ' selected="selected"' : '', '>Verdana</option>';
				echo '<option class="trebuchet" value="6"',	$selected == '6' ? ' selected="selected"' : '', '>Trebuchet</option>';				
				echo '<option class="impact" value="7"',	$selected == '7' ? ' selected="selected"' : '', '>Impact</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Widget Title</label>';
		echo '<select class="font_stack" name="' . $this->get_field_name( 'side_font' ) . '" id="' . $this->get_field_id( 'side_font' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'side_font' ) );
				$selected	= (!empty($option)) ? $option : '4';
				echo '<option class="timesnew" value="1"',	$selected == '1' ? ' selected="selected"' : '', '>Times New Roman</option>';
				echo '<option class="georgia" value="2"',	$selected == '2' ? ' selected="selected"' : '', '>Georgia</option>';
				echo '<option class="garamond" value="3"',	$selected == '3' ? ' selected="selected"' : '', '>Garamond</option>';
				echo '<option class="helvetica" value="4"',	$selected == '4' ? ' selected="selected"' : '', '>Helvetica</option>';
				echo '<option class="verdana" value="5"',	$selected == '5' ? ' selected="selected"' : '', '>Verdana</option>';
				echo '<option class="trebuchet" value="6"',	$selected == '6' ? ' selected="selected"' : '', '>Trebuchet</option>';				
				echo '<option class="impact" value="7"',	$selected == '7' ? ' selected="selected"' : '', '>Impact</option>';
		echo '</select>';
		echo '</p>';
		
		echo '<p><label>Widget Text</label>';
		echo '<select class="font_stack" name="' . $this->get_field_name( 'widg_font' ) . '" id="' . $this->get_field_id( 'widg_font' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'widg_font' ) );
				$selected	= (!empty($option)) ? $option : '4';
				echo '<option class="timesnew" value="1"',	$selected == '1' ? ' selected="selected"' : '', '>Times New Roman</option>';
				echo '<option class="georgia" value="2"',	$selected == '2' ? ' selected="selected"' : '', '>Georgia</option>';
				echo '<option class="garamond" value="3"',	$selected == '3' ? ' selected="selected"' : '', '>Garamond</option>';
				echo '<option class="helvetica" value="4"',	$selected == '4' ? ' selected="selected"' : '', '>Helvetica</option>';
				echo '<option class="verdana" value="5"',	$selected == '5' ? ' selected="selected"' : '', '>Verdana</option>';
				echo '<option class="trebuchet" value="6"',	$selected == '6' ? ' selected="selected"' : '', '>Trebuchet</option>';				
				echo '<option class="impact" value="7"',	$selected == '7' ? ' selected="selected"' : '', '>Impact</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Footer Text</label>';
		echo '<select class="font_stack" name="' . $this->get_field_name( 'foot_font' ) . '" id="' . $this->get_field_id( 'foot_font' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'foot_font' ) );
				$selected	= (!empty($option)) ? $option : '4';
				echo '<option class="timesnew" value="1"',	$selected == '1' ? ' selected="selected"' : '', '>Times New Roman</option>';
				echo '<option class="georgia" value="2"',	$selected == '2' ? ' selected="selected"' : '', '>Georgia</option>';
				echo '<option class="garamond" value="3"',	$selected == '3' ? ' selected="selected"' : '', '>Garamond</option>';
				echo '<option class="helvetica" value="4"',	$selected == '4' ? ' selected="selected"' : '', '>Helvetica</option>';
				echo '<option class="verdana" value="5"',	$selected == '5' ? ' selected="selected"' : '', '>Verdana</option>';
				echo '<option class="trebuchet" value="6"',	$selected == '6' ? ' selected="selected"' : '', '>Trebuchet</option>';				
				echo '<option class="impact" value="7"',	$selected == '7' ? ' selected="selected"' : '', '>Impact</option>';
		echo '</select>';
		echo '</p>';
				
		echo '</div>'; // end font stacks

		echo '<div class="dg_inner">';
		echo '<h5>Font Sizes</h5>';

		echo '<p><label>Body Text</label>';
		echo '<select class="font_size" name="' . $this->get_field_name( 'body_size' ) . '" id="' . $this->get_field_id( 'body_size' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'body_size' ) );
				$selected	= (!empty($option)) ? $option : '16px';
				echo '<option value="12px"', $selected == '12px' ? ' selected="selected"' : '', '>12px</option>';
				echo '<option value="13px"', $selected == '13px' ? ' selected="selected"' : '', '>13px</option>';
				echo '<option value="14px"', $selected == '14px' ? ' selected="selected"' : '', '>14px</option>';
				echo '<option value="15px"', $selected == '15px' ? ' selected="selected"' : '', '>15px</option>';
				echo '<option value="16px"', $selected == '16px' ? ' selected="selected"' : '', '>16px</option>';
				echo '<option value="18px"', $selected == '18px' ? ' selected="selected"' : '', '>18px</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Site Title</label>';
		echo '<select class="font_size" name="' . $this->get_field_name( 'head_size' ) . '" id="' . $this->get_field_id( 'head_size' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'head_size' ) );
				$selected	= (!empty($option)) ? $option : '36px';
				echo '<option value="24px"', $selected == '24px' ? ' selected="selected"' : '', '>24px</option>';
				echo '<option value="28px"', $selected == '28px' ? ' selected="selected"' : '', '>28px</option>';
				echo '<option value="32px"', $selected == '32px' ? ' selected="selected"' : '', '>32px</option>';
				echo '<option value="36px"', $selected == '36px' ? ' selected="selected"' : '', '>36px</option>';
				echo '<option value="42px"', $selected == '42px' ? ' selected="selected"' : '', '>42px</option>';
				echo '<option value="48px"', $selected == '48px' ? ' selected="selected"' : '', '>48px</option>';
				echo '<option value="52px"', $selected == '52px' ? ' selected="selected"' : '', '>52px</option>';
		echo '</select>';
		echo '</p>';		

		echo '<p><label>Site Description</label>';
		echo '<select class="font_size" name="' . $this->get_field_name( 'desc_size' ) . '" id="' . $this->get_field_id( 'desc_size' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'desc_size' ) );
				$selected	= (!empty($option)) ? $option : '14px';
				echo '<option value="12px"', $selected == '12px' ? ' selected="selected"' : '', '>12px</option>';
				echo '<option value="13px"', $selected == '13px' ? ' selected="selected"' : '', '>13px</option>';
				echo '<option value="14px"', $selected == '14px' ? ' selected="selected"' : '', '>14px</option>';
				echo '<option value="15px"', $selected == '15px' ? ' selected="selected"' : '', '>15px</option>';
				echo '<option value="16px"', $selected == '16px' ? ' selected="selected"' : '', '>16px</option>';
				echo '<option value="18px"', $selected == '18px' ? ' selected="selected"' : '', '>18px</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Navigation</label>';
		echo '<select class="font_size" name="' . $this->get_field_name( 'navi_size' ) . '" id="' . $this->get_field_id( 'navi_size' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'navi_size' ) );
				$selected	= (!empty($option)) ? $option : '14px';
				echo '<option value="12px"', $selected == '12px' ? ' selected="selected"' : '', '>12px</option>';
				echo '<option value="13px"', $selected == '13px' ? ' selected="selected"' : '', '>13px</option>';
				echo '<option value="14px"', $selected == '14px' ? ' selected="selected"' : '', '>14px</option>';
				echo '<option value="15px"', $selected == '15px' ? ' selected="selected"' : '', '>15px</option>';
				echo '<option value="16px"', $selected == '16px' ? ' selected="selected"' : '', '>16px</option>';
				echo '<option value="18px"', $selected == '18px' ? ' selected="selected"' : '', '>18px</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Post Title</label>';
		echo '<select class="font_size" name="' . $this->get_field_name( 'post_size' ) . '" id="' . $this->get_field_id( 'post_size' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'post_size' ) );
				$selected	= (!empty($option)) ? $option : '28px';
				echo '<option value="18px"', $selected == '18px' ? ' selected="selected"' : '', '>18px</option>';
				echo '<option value="22px"', $selected == '22px' ? ' selected="selected"' : '', '>22px</option>';
				echo '<option value="24px"', $selected == '24px' ? ' selected="selected"' : '', '>24px</option>';
				echo '<option value="26px"', $selected == '26px' ? ' selected="selected"' : '', '>26px</option>';
				echo '<option value="28px"', $selected == '28px' ? ' selected="selected"' : '', '>28px</option>';
				echo '<option value="32px"', $selected == '32px' ? ' selected="selected"' : '', '>32px</option>';
				echo '<option value="34px"', $selected == '34px' ? ' selected="selected"' : '', '>34px</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Post Meta</label>';
		echo '<select class="font_size" name="' . $this->get_field_name( 'meta_size' ) . '" id="' . $this->get_field_id( 'meta_size' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'meta_size' ) );
				$selected	= (!empty($option)) ? $option : '14px';
				echo '<option value="10px"', $selected == '10px' ? ' selected="selected"' : '', '>10px</option>';
				echo '<option value="12px"', $selected == '12px' ? ' selected="selected"' : '', '>12px</option>';
				echo '<option value="13px"', $selected == '13px' ? ' selected="selected"' : '', '>13px</option>';
				echo '<option value="14px"', $selected == '14px' ? ' selected="selected"' : '', '>14px</option>';
				echo '<option value="16px"', $selected == '16px' ? ' selected="selected"' : '', '>16px</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Widget Title</label>';
		echo '<select class="font_size" name="' . $this->get_field_name( 'side_size' ) . '" id="' . $this->get_field_id( 'side_size' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'side_size' ) );
				$selected	= (!empty($option)) ? $option : '14px';
				echo '<option value="14px"', $selected == '14px' ? ' selected="selected"' : '', '>14px</option>';
				echo '<option value="16px"', $selected == '16px' ? ' selected="selected"' : '', '>16px</option>';
				echo '<option value="18px"', $selected == '18px' ? ' selected="selected"' : '', '>18px</option>';
				echo '<option value="20px"', $selected == '20px' ? ' selected="selected"' : '', '>20px</option>';
				echo '<option value="22px"', $selected == '22px' ? ' selected="selected"' : '', '>22px</option>';
				echo '<option value="24px"', $selected == '24px' ? ' selected="selected"' : '', '>24px</option>';
				echo '<option value="26px"', $selected == '26px' ? ' selected="selected"' : '', '>26px</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Widget Text</label>';
		echo '<select class="font_size" name="' . $this->get_field_name( 'widg_size' ) . '" id="' . $this->get_field_id( 'widg_size' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'widg_size' ) );
				$selected	= (!empty($option)) ? $option : '14px';
				echo '<option value="12px"', $selected == '12px' ? ' selected="selected"' : '', '>12px</option>';
				echo '<option value="13px"', $selected == '13px' ? ' selected="selected"' : '', '>13px</option>';
				echo '<option value="14px"', $selected == '14px' ? ' selected="selected"' : '', '>14px</option>';
				echo '<option value="15px"', $selected == '15px' ? ' selected="selected"' : '', '>15px</option>';
				echo '<option value="16px"', $selected == '16px' ? ' selected="selected"' : '', '>16px</option>';
				echo '<option value="18px"', $selected == '18px' ? ' selected="selected"' : '', '>18px</option>';
		echo '</select>';
		echo '</p>';
		
		echo '<p><label>Footer Text</label>';
		echo '<select class="font_size" name="' . $this->get_field_name( 'foot_size' ) . '" id="' . $this->get_field_id( 'foot_size' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'foot_size' ) );
				$selected	= (!empty($option)) ? $option : '14px';
				echo '<option value="10px"', $selected == '10px' ? ' selected="selected"' : '', '>10px</option>';
				echo '<option value="12px"', $selected == '12px' ? ' selected="selected"' : '', '>12px</option>';
				echo '<option value="13px"', $selected == '13px' ? ' selected="selected"' : '', '>13px</option>';
				echo '<option value="14px"', $selected == '14px' ? ' selected="selected"' : '', '>14px</option>';
		echo '</select>';
		echo '</p>';
		
		echo '</div>'; // end font sizes

		echo '<div class="dg_inner">';
		echo '<h5>Font Weights</h5>';

		echo '<p><label>Body Text</label>';
		echo '<select class="font_weight" name="' . $this->get_field_name( 'body_weight' ) . '" id="' . $this->get_field_id( 'body_weight' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'body_weight' ) );
				$selected	= (!empty($option)) ? $option : '300';
				echo '<option value="300"', $selected == '300' ? ' selected="selected"' : '', '>300 (light) </option>';
				echo '<option value="400"', $selected == '400' ? ' selected="selected"' : '', '>400 (normal) </option>';
				echo '<option value="500"', $selected == '500' ? ' selected="selected"' : '', '>500</option>';
				echo '<option value="600"', $selected == '600' ? ' selected="selected"' : '', '>600</option>';
				echo '<option value="700"', $selected == '700' ? ' selected="selected"' : '', '>700 (bold) </option>';
				echo '<option value="800"', $selected == '800' ? ' selected="selected"' : '', '>800</option>';
				echo '<option value="900"', $selected == '900' ? ' selected="selected"' : '', '>900 (bolder) </option>';
		echo '</select>';
		echo '</p>';
	
		echo '<p><label>Site Title</label>';
		echo '<select class="font_weight" name="' . $this->get_field_name( 'head_weight' ) . '" id="' . $this->get_field_id( 'head_weight' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'head_weight' ) );
				$selected	= (!empty($option)) ? $option : '300';
				echo '<option value="300"', $selected == '300' ? ' selected="selected"' : '', '>300 (light) </option>';
				echo '<option value="400"', $selected == '400' ? ' selected="selected"' : '', '>400 (normal) </option>';
				echo '<option value="500"', $selected == '500' ? ' selected="selected"' : '', '>500</option>';
				echo '<option value="600"', $selected == '600' ? ' selected="selected"' : '', '>600</option>';
				echo '<option value="700"', $selected == '700' ? ' selected="selected"' : '', '>700 (bold) </option>';
				echo '<option value="800"', $selected == '800' ? ' selected="selected"' : '', '>800</option>';
				echo '<option value="900"', $selected == '900' ? ' selected="selected"' : '', '>900 (bolder) </option>';
		echo '</select>';
		echo '</p>';		

		echo '<p><label>Site Description</label>';
		echo '<select class="font_weight" name="' . $this->get_field_name( 'desc_weight' ) . '" id="' . $this->get_field_id( 'desc_weight' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'desc_weight' ) );
				$selected	= (!empty($option)) ? $option : '300';
				echo '<option value="300"', $selected == '300' ? ' selected="selected"' : '', '>300 (light) </option>';
				echo '<option value="400"', $selected == '400' ? ' selected="selected"' : '', '>400 (normal) </option>';
				echo '<option value="500"', $selected == '500' ? ' selected="selected"' : '', '>500</option>';
				echo '<option value="600"', $selected == '600' ? ' selected="selected"' : '', '>600</option>';
				echo '<option value="700"', $selected == '700' ? ' selected="selected"' : '', '>700 (bold) </option>';
				echo '<option value="800"', $selected == '800' ? ' selected="selected"' : '', '>800</option>';
				echo '<option value="900"', $selected == '900' ? ' selected="selected"' : '', '>900 (bolder) </option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Navigation</label>';
		echo '<select class="font_weight" name="' . $this->get_field_name( 'navi_weight' ) . '" id="' . $this->get_field_id( 'navi_weight' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'navi_weight' ) );
				$selected	= (!empty($option)) ? $option : '300';
				echo '<option value="300"', $selected == '300' ? ' selected="selected"' : '', '>300 (light) </option>';
				echo '<option value="400"', $selected == '400' ? ' selected="selected"' : '', '>400 (normal) </option>';
				echo '<option value="500"', $selected == '500' ? ' selected="selected"' : '', '>500</option>';
				echo '<option value="600"', $selected == '600' ? ' selected="selected"' : '', '>600</option>';
				echo '<option value="700"', $selected == '700' ? ' selected="selected"' : '', '>700 (bold) </option>';
				echo '<option value="800"', $selected == '800' ? ' selected="selected"' : '', '>800</option>';
				echo '<option value="900"', $selected == '900' ? ' selected="selected"' : '', '>900 (bolder) </option>';
		echo '</select>';
		echo '</p>';	

		echo '<p><label>Post Title</label>';
		echo '<select class="font_weight" name="' . $this->get_field_name( 'post_weight' ) . '" id="' . $this->get_field_id( 'post_weight' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'post_weight' ) );
				$selected	= (!empty($option)) ? $option : '300';
				echo '<option value="300"', $selected == '300' ? ' selected="selected"' : '', '>300 (light) </option>';
				echo '<option value="400"', $selected == '400' ? ' selected="selected"' : '', '>400 (normal) </option>';
				echo '<option value="500"', $selected == '500' ? ' selected="selected"' : '', '>500</option>';
				echo '<option value="600"', $selected == '600' ? ' selected="selected"' : '', '>600</option>';
				echo '<option value="700"', $selected == '700' ? ' selected="selected"' : '', '>700 (bold) </option>';
				echo '<option value="800"', $selected == '800' ? ' selected="selected"' : '', '>800</option>';
				echo '<option value="900"', $selected == '900' ? ' selected="selected"' : '', '>900 (bolder) </option>';
		echo '</select>';
		echo '</p>';		

		echo '<p><label>Widget Title</label>';
		echo '<select class="font_weight" name="' . $this->get_field_name( 'side_weight' ) . '" id="' . $this->get_field_id( 'side_weight' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'side_weight' ) );
				$selected	= (!empty($option)) ? $option : '300';
				echo '<option value="300"', $selected == '300' ? ' selected="selected"' : '', '>300 (light) </option>';
				echo '<option value="400"', $selected == '400' ? ' selected="selected"' : '', '>400 (normal) </option>';
				echo '<option value="500"', $selected == '500' ? ' selected="selected"' : '', '>500</option>';
				echo '<option value="600"', $selected == '600' ? ' selected="selected"' : '', '>600</option>';
				echo '<option value="700"', $selected == '700' ? ' selected="selected"' : '', '>700 (bold) </option>';
				echo '<option value="800"', $selected == '800' ? ' selected="selected"' : '', '>800</option>';
				echo '<option value="900"', $selected == '900' ? ' selected="selected"' : '', '>900 (bolder) </option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Widget Text</label>';
		echo '<select class="font_weight" name="' . $this->get_field_name( 'widg_weight' ) . '" id="' . $this->get_field_id( 'widg_weight' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'widg_weight' ) );
				$selected	= (!empty($option)) ? $option : '300';
				echo '<option value="300"', $selected == '300' ? ' selected="selected"' : '', '>300 (light) </option>';
				echo '<option value="400"', $selected == '400' ? ' selected="selected"' : '', '>400 (normal) </option>';
				echo '<option value="500"', $selected == '500' ? ' selected="selected"' : '', '>500</option>';
				echo '<option value="600"', $selected == '600' ? ' selected="selected"' : '', '>600</option>';
				echo '<option value="700"', $selected == '700' ? ' selected="selected"' : '', '>700 (bold) </option>';
				echo '<option value="800"', $selected == '800' ? ' selected="selected"' : '', '>800</option>';
				echo '<option value="900"', $selected == '900' ? ' selected="selected"' : '', '>900 (bolder) </option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Footer Text</label>';
		echo '<select class="font_weight" name="' . $this->get_field_name( 'foot_weight' ) . '" id="' . $this->get_field_id( 'foot_weight' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'foot_weight' ) );
				$selected	= (!empty($option)) ? $option : '300';
				echo '<option value="300"', $selected == '300' ? ' selected="selected"' : '', '>300 (light) </option>';
				echo '<option value="400"', $selected == '400' ? ' selected="selected"' : '', '>400 (normal) </option>';
				echo '<option value="500"', $selected == '500' ? ' selected="selected"' : '', '>500</option>';
				echo '<option value="600"', $selected == '600' ? ' selected="selected"' : '', '>600</option>';
				echo '<option value="700"', $selected == '700' ? ' selected="selected"' : '', '>700 (bold) </option>';
				echo '<option value="800"', $selected == '800' ? ' selected="selected"' : '', '>800</option>';
				echo '<option value="900"', $selected == '900' ? ' selected="selected"' : '', '>900 (bolder) </option>';
		echo '</select>';
		echo '</p>';
		
		echo '</div>'; // end font weights

		echo '<div class="dg_inner">';
		echo '<h5>Capitalization</h5>';
		
		echo '<p><label>Site Title</label>';
		echo '<select class="font_caps" name="' . $this->get_field_name( 'head_caps' ) . '" id="' . $this->get_field_id( 'head_caps' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'head_caps' ) );
				$selected	= (!empty($option)) ? $option : 'uppercase';
				echo '<option value="capitalize"', $selected == 'capitalize' ? ' selected="selected"' : '', '>Capitalize</option>';
				echo '<option value="uppercase"', $selected == 'uppercase' ? ' selected="selected"' : '', '>UPPERCASE</option>';
				echo '<option value="lowercase"', $selected == 'lowercase' ? ' selected="selected"' : '', '>lowercase</option>';
				echo '<option value="none"', $selected == 'none' ? ' selected="selected"' : '', '>none</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Site Description</label>';
		echo '<select class="font_caps" name="' . $this->get_field_name( 'desc_caps' ) . '" id="' . $this->get_field_id( 'desc_caps' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'desc_caps' ) );
				$selected	= (!empty($option)) ? $option : 'none';
				echo '<option value="capitalize"', $selected == 'capitalize' ? ' selected="selected"' : '', '>Capitalize</option>';
				echo '<option value="uppercase"', $selected == 'uppercase' ? ' selected="selected"' : '', '>UPPERCASE</option>';
				echo '<option value="lowercase"', $selected == 'lowercase' ? ' selected="selected"' : '', '>lowercase</option>';
				echo '<option value="none"', $selected == 'none' ? ' selected="selected"' : '', '>none</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Post Title</label>';
		echo '<select class="font_caps" name="' . $this->get_field_name( 'post_caps' ) . '" id="' . $this->get_field_id( 'post_caps' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'post_caps' ) );
				$selected	= (!empty($option)) ? $option : 'none';
				echo '<option value="capitalize"', $selected == 'capitalize' ? ' selected="selected"' : '', '>Capitalize</option>';
				echo '<option value="uppercase"', $selected == 'uppercase' ? ' selected="selected"' : '', '>UPPERCASE</option>';
				echo '<option value="lowercase"', $selected == 'lowercase' ? ' selected="selected"' : '', '>lowercase</option>';
				echo '<option value="none"', $selected == 'none' ? ' selected="selected"' : '', '>none</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Widget Title</label>';
		echo '<select class="font_caps" name="' . $this->get_field_name( 'widg_caps' ) . '" id="' . $this->get_field_id( 'widg_caps' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'widg_caps' ) );
				$selected	= (!empty($option)) ? $option : 'none';
				echo '<option value="capitalize"', $selected == 'capitalize' ? ' selected="selected"' : '', '>Capitalize</option>';
				echo '<option value="uppercase"', $selected == 'uppercase' ? ' selected="selected"' : '', '>UPPERCASE</option>';
				echo '<option value="lowercase"', $selected == 'lowercase' ? ' selected="selected"' : '', '>lowercase</option>';
				echo '<option value="none"', $selected == 'none' ? ' selected="selected"' : '', '>none</option>';
		echo '</select>';
		echo '</p>';
		echo '</div>'; // end effects
		
		echo '<div class="dg_inner">';
		echo '<h5>Content Headlines</h5>';
		
		echo '<p><label>Headline H1</label>';
		echo '<select class="cont_size" name="' . $this->get_field_name( 'cont_h1' ) . '" id="' . $this->get_field_id( 'cont_h1' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'cont_h1' ) );
				$selected	= (!empty($option)) ? $option : '30px';
				echo '<option value="16px"', $selected == '16px' ? ' selected="selected"' : '', '>16px</option>';
				echo '<option value="18px"', $selected == '18px' ? ' selected="selected"' : '', '>18px</option>';
				echo '<option value="20px"', $selected == '20px' ? ' selected="selected"' : '', '>20px</option>';
				echo '<option value="22px"', $selected == '22px' ? ' selected="selected"' : '', '>22px</option>';
				echo '<option value="24px"', $selected == '24px' ? ' selected="selected"' : '', '>24px</option>';
				echo '<option value="28px"', $selected == '28px' ? ' selected="selected"' : '', '>28px</option>';
				echo '<option value="30px"', $selected == '30px' ? ' selected="selected"' : '', '>30px</option>';
				echo '<option value="32px"', $selected == '32px' ? ' selected="selected"' : '', '>32px</option>';
				echo '<option value="36px"', $selected == '36px' ? ' selected="selected"' : '', '>36px</option>';
				echo '<option value="42px"', $selected == '42px' ? ' selected="selected"' : '', '>42px</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Headline H2</label>';
		echo '<select class="cont_size" name="' . $this->get_field_name( 'cont_h2' ) . '" id="' . $this->get_field_id( 'cont_h2' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'cont_h2' ) );
				$selected	= (!empty($option)) ? $option : '28px';
				echo '<option value="16px"', $selected == '16px' ? ' selected="selected"' : '', '>16px</option>';
				echo '<option value="18px"', $selected == '18px' ? ' selected="selected"' : '', '>18px</option>';
				echo '<option value="20px"', $selected == '20px' ? ' selected="selected"' : '', '>20px</option>';
				echo '<option value="22px"', $selected == '22px' ? ' selected="selected"' : '', '>22px</option>';
				echo '<option value="24px"', $selected == '24px' ? ' selected="selected"' : '', '>24px</option>';
				echo '<option value="28px"', $selected == '28px' ? ' selected="selected"' : '', '>28px</option>';
				echo '<option value="32px"', $selected == '32px' ? ' selected="selected"' : '', '>32px</option>';
				echo '<option value="36px"', $selected == '36px' ? ' selected="selected"' : '', '>36px</option>';
				echo '<option value="42px"', $selected == '42px' ? ' selected="selected"' : '', '>42px</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Headline H3</label>';
		echo '<select class="cont_size" name="' . $this->get_field_name( 'cont_h3' ) . '" id="' . $this->get_field_id( 'cont_h3' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'cont_h3' ) );
				$selected	= (!empty($option)) ? $option : '24px';
				echo '<option value="16px"', $selected == '16px' ? ' selected="selected"' : '', '>16px</option>';
				echo '<option value="18px"', $selected == '18px' ? ' selected="selected"' : '', '>18px</option>';
				echo '<option value="20px"', $selected == '20px' ? ' selected="selected"' : '', '>20px</option>';
				echo '<option value="22px"', $selected == '22px' ? ' selected="selected"' : '', '>22px</option>';
				echo '<option value="24px"', $selected == '24px' ? ' selected="selected"' : '', '>24px</option>';
				echo '<option value="28px"', $selected == '28px' ? ' selected="selected"' : '', '>28px</option>';
				echo '<option value="32px"', $selected == '32px' ? ' selected="selected"' : '', '>32px</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Headline H4</label>';
		echo '<select class="cont_size" name="' . $this->get_field_name( 'cont_h4' ) . '" id="' . $this->get_field_id( 'cont_h4' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'cont_h4' ) );
				$selected	= (!empty($option)) ? $option : '20px';
				echo '<option value="16px"', $selected == '16px' ? ' selected="selected"' : '', '>16px</option>';
				echo '<option value="18px"', $selected == '18px' ? ' selected="selected"' : '', '>18px</option>';
				echo '<option value="20px"', $selected == '20px' ? ' selected="selected"' : '', '>20px</option>';
				echo '<option value="22px"', $selected == '22px' ? ' selected="selected"' : '', '>22px</option>';
				echo '<option value="24px"', $selected == '24px' ? ' selected="selected"' : '', '>24px</option>';
				echo '<option value="28px"', $selected == '28px' ? ' selected="selected"' : '', '>28px</option>';
				echo '<option value="32px"', $selected == '32px' ? ' selected="selected"' : '', '>32px</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Headline H5</label>';
		echo '<select class="cont_size" name="' . $this->get_field_name( 'cont_h5' ) . '" id="' . $this->get_field_id( 'cont_h5' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'cont_h5' ) );
				$selected	= (!empty($option)) ? $option : '18px';
				echo '<option value="16px"', $selected == '16px' ? ' selected="selected"' : '', '>16px</option>';
				echo '<option value="18px"', $selected == '18px' ? ' selected="selected"' : '', '>18px</option>';
				echo '<option value="20px"', $selected == '20px' ? ' selected="selected"' : '', '>20px</option>';
				echo '<option value="22px"', $selected == '22px' ? ' selected="selected"' : '', '>22px</option>';
				echo '<option value="24px"', $selected == '24px' ? ' selected="selected"' : '', '>24px</option>';
		echo '</select>';
		echo '</p>';

		echo '<p><label>Headline H6</label>';
		echo '<select class="cont_size" name="' . $this->get_field_name( 'cont_h6' ) . '" id="' . $this->get_field_id( 'cont_h6' ) . '">';
				$option		= esc_attr( $this->get_field_value( 'cont_h6' ) );
				$selected	= (!empty($option)) ? $option : '16px';
				echo '<option value="14px"', $selected == '14px' ? ' selected="selected"' : '', '>14px</option>';
				echo '<option value="16px"', $selected == '16px' ? ' selected="selected"' : '', '>16px</option>';
				echo '<option value="18px"', $selected == '18px' ? ' selected="selected"' : '', '>18px</option>';
				echo '<option value="20px"', $selected == '20px' ? ' selected="selected"' : '', '>20px</option>';
				echo '<option value="22px"', $selected == '22px' ? ' selected="selected"' : '', '>22px</option>';
				echo '<option value="24px"', $selected == '24px' ? ' selected="selected"' : '', '>24px</option>';
		echo '</select>';
		echo '</p>';


		echo '</div>'; // end H
	echo '</div>'; // end inner wrap
	echo '</div>'; // end typography

		
		if ( isset( $_GET['settings-updated'] ) )
			$save_trigger = 'true';

		if ( isset( $_GET['reset'] ) )
			$reset_trigger = 'true';


		if(!empty($save_trigger) || !empty($reset_trigger) )
			gsd_generate_css();

//		} else {
//			echo '<p>BAD</p>';



	}

	
}

add_action( 'genesis_admin_menu', 'gsd_add_design_settings' );
/**
 * Instantiate the class to create the menu.
 *
 * @since 1.8.0
 */
function gsd_add_design_settings() {

	new Genesis_Palette_Admin;

}