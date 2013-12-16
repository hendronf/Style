<?php
/*
Plugin Name: Content Visibility
Plugin URL: http://style.nu
Description: This plugin is packaged with Style.nu. The purpose is to make it possible to make specific pages available to specific user roles. E.G. Advertisers, Press etc. 
Version: 0.0.1
Author: Fearghal, adapted from the User Specific Content plugin by Bainternet under the GNU Public License
Author URI: http://fearghal.co.uk / http://en.bainternet.info
*/

/* Disallow direct access to the plugin file */
if (basename($_SERVER['PHP_SELF']) == basename (__FILE__)) {
	die('Sorry, but you cannot access this page directly.');
}

class bainternet_style {

	// Class Variables
	
	/**
	 * Class constarctor
	 */
    function __construct() {
		/* Define the custom box */
		add_action('add_meta_boxes', array($this,'User_specific_content_box'));
		/* Save Meta Box */
		add_action('save_post', array($this,'User_specific_content_box_inner_save'));


		/* options page */
		add_action('admin_menu', array($this,'admin_menu'));
        add_action('admin_init',  array($this, 'style_admin_init'));
		/* add_filter hooks */
		add_action('init',  array($this, 'style_init'));
		
		//Language Setup
		$locale = get_locale();
		load_plugin_textdomain( $this->localization_domain, false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
		
    }
	
	//init - Always run on The Content and The Excerpt
	public function style_init(){
		$options = $this->style_get_option();
			add_filter('the_content',array($this,'User_specific_content_filter'));
			add_filter('the_excerpt',array($this,'User_specific_content_filter'));
		do_action('User_specific_content_filter_add',$this);
	}
	
	
	//admin init
	public function style_admin_init(){
		register_setting( 'style_Options', 'style',array($this,'style_validate_options'));
		$this->style_get_option();
	}
	
	function style_validate_options($i){
		return $i;
	}
	
	
	//admin menu
	public function admin_menu() {
		add_options_page('Content Visibility', 'Content Visibility', 'manage_options', 'ba_style', array($this,'style_options'));
	}
	
	//options page
	public function style_options(){
		
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
		//print_r($_POST);
		?>
		<div class="wrap">
			<div id="icon-options-general" class="icon32">
			<?php if (isset($_POST['Update_data'])){echo 'good'; }?>
			</div><h2><?php echo __('Content Visibility','bauspc'); ?></h2>
			<form method="post" action="options.php">
			<?php settings_fields('style_Options');
				$options = $this->style_get_option();
			?>
			<?php  //print_r($options); ?>

			<table class="form-table">

			<tr valign="top">
			<th scope="row"><?php echo __('Global Blocked message:','bauspc'); ?></th>
			<td><textarea type="text" name="style[b_massage]" ><?php echo $options['b_massage']; ?></textarea><br /> 
			<?php _e('<small>(Accepts HTML)</small>','bauspc'); ?></td>
			</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes','bauspc'); ?>" />
			</p>
			</form>
		</div>
		<?php
	}
	
	//options
	public function style_get_option(){
		$temp = array(
		'b_massage' => '',
		'run_on_the_content' => true,
		'run_on_the_excerpt' => true
		);
		
		$i = get_option('style');
		if (!empty($i)){
			if (isset($i['run_on_the_content']) && $i['run_on_the_content']){
				$temp['run_on_the_content'] = true;
				$temp['run_on_the_excerpt'] = true;
			}
			
			if (isset($i['b_massage'])){
				$temp['b_massage'] = $i['b_massage'];
			}
		}
		
		update_option('style', $temp);
		//delete_option('style');
		return $temp;
	}
	
	/* Adds a box to the main column on the custom post type edit screens */
	public function User_specific_content_box() {
		add_meta_box('User_specific_content', __( 'Content visibility'),array($this,'User_specific_content_box_inner'),'post');
		add_meta_box('User_specific_content', __( 'Content visibility'),array($this,'User_specific_content_box_inner'),'page');
		//add metabox to custom post types
		$args=array(
			'public'   => true,
			'_builtin' => false
		); 
		//add metabox to custom post types edit screen
		$output = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'
		$post_types=get_post_types($args,$output,$operator); 
		foreach ($post_types  as $post_type ) {
			add_meta_box('User_specific_content', __( 'Content visibility','bauspc'),array($this,'User_specific_content_box_inner'),$post_type);
		}
	}

	/* Prints the box content */
	public function User_specific_content_box_inner() {
		global $post,$wp_roles;
		//get options:
		
		$options = $this->style_get_option('style');
		$savedroles = get_post_meta($post->ID, 'style_roles',true);
		//var_dump($savedroles);
		$savedusers = get_post_meta($post->ID, 'style_users',true);
		$savedoptions = get_post_meta($post->ID, 'style_options',true);
		//var_dump($savedusers);
		// Use nonce for verification
		wp_nonce_field( plugin_basename(__FILE__), 'User_specific_content_box_inner' );
		//by role
			echo '<h4>'.__('Visible To:','bauspc').'</h4>';
			if ( !isset( $wp_roles ) )
				$wp_roles = new WP_Roles();
			if (!empty($savedroles)){
				foreach ( $wp_roles->role_names as $role => $name ) {
					echo '<input type="checkbox" name="style_roles[]" value="'.$name.'"';
					if (in_array($name,$savedroles)){
						echo ' checked';
					}
					echo '>'.$name.'</br>   ';
				}
			}else{
				foreach ( $wp_roles->role_names as $role => $name ) {
					echo '<input type="checkbox" name="style_roles[]" value="'.$name.'">'.$name.'</br>    ';
				}
			}
	} 
 
	/* When the post is saved, saves our custom data */
	function User_specific_content_box_inner_save( $post_id ) {
		global $post;
		  // verify this came from the our screen and with proper authorization,
		  // because save_post can be triggered at other times
		if (isset($_POST['User_specific_content_box_inner'])){
			if ( !wp_verify_nonce( $_POST['User_specific_content_box_inner'], plugin_basename(__FILE__) ) )
				return $post_id;
		}else{
			return $post_id;
		}
		  // verify if this is an auto save routine. 
		  // If it is our form has not been submitted, so we dont want to do anything
		  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
			  return $post_id;
		  // OK, we're authenticated: we need to find and save the data
		$savedroles = get_post_meta($post_id, 'style_roles',true);
		$savedusers = get_post_meta($post_id, 'style_users',true);
		$savedoptions = get_post_meta($post->ID, 'style_options',true);
		
		if (isset($_POST['style_options']) && !empty($_POST['style_options'] )){
			foreach ($_POST['style_options'] as $key => $value ){
				$new_savedoptions[$key] = $value;
			}
			update_post_meta($post_id, 'style_options', $new_savedoptions);
		}else{
			 delete_post_meta($post_id, 'style_options');
		}
		if (isset($_POST['style_roles']) && !empty($_POST['style_roles'] )){
			foreach ($_POST['style_roles'] as $role){
				$new_roles[] = $role;
			}
			update_post_meta($post_id, 'style_roles', $new_roles);
		}else{
			if (count($savedroles) > 0){
				 delete_post_meta($post_id, 'style_roles');
			}
		}
		if (isset($_POST['style_message'])){
			update_post_meta($post_id,'style_message', $_POST['style_message']);
		}
	}


	public function User_specific_content_filter($content){
		global $post,$current_user;
		$savedoptions = get_post_meta($post->ID, 'style_options',true);
		$m = get_post_meta($post->ID, 'style_message',true);
		if (isset($savedoptions) && !empty($savedoptions)){
			// none logged only
			if (isset($savedoptions['non_logged']) && $savedoptions['non_logged'] == 1){
				if (is_user_logged_in()){
					return $this->displayMessage($m);
				}
			}
			//logged in users only
			if (isset($savedoptions['logged']) && $savedoptions['logged'] == 1){
				if (!is_user_logged_in()){
					return $this->displayMessage($m);
				}
			}
		}
		$savedroles = get_post_meta($post->ID, 'style_roles',true);
		$run_check = 0;
		$savedusers = get_post_meta($post->ID, 'style_users',true);
		if (!count($savedusers) > 0 && !count($savedroles) > 0 ){
			return $content;
			exit;
		}
		//by role
		if (isset($savedroles) && !empty($savedroles)){
			get_currentuserinfo();
			$cu_r = $this->bausp_get_current_user_role();
			if ($cu_r){
				if (in_array($cu_r,$savedroles)){
					return $content;
					exit;
				}else{
					$run_check = 1;
				}
			}else{
				//failed role check
				$run_check = 1;
			}
		}
		
		if ($run_check > 0){
			return $this->displayMessage($m);
		}
		return $content;
	}

	/************************
	* helpers
	************************/

	public function bausp_get_current_user_role() {
		global $wp_roles;
		$current_user = wp_get_current_user();
		$roles = $current_user->roles;
		$role = array_shift($roles);
		return isset($wp_roles->role_names[$role]) ? translate_user_role($wp_roles->role_names[$role] ) : false;
	}

	public function displayMessage($m){
		global $post;
		if (isset($m) && $m != ''){
			return apply_filters('user_specific_content_blocked',$m,$post);
		}else{
			$options = $this->style_get_option('style');
			return apply_filters('user_specific_content_blocked',$options['b_massage'],$post);
		}
	}
}//end class

$style_i = new bainternet_style();