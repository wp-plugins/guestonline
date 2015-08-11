<?php
/*
	Plugin Name:  Instabook
	Plugin URI: 
	Description: Instabook bookings and contact subscription modules
	Version: 2.0
	Author: MOREL Marie
	Author URI: 
	Text Domain: instabook
	License: GPLv2 or later 
*/
	register_activation_hook(__FILE__, 'instabook_clean_db');
	register_deactivation_hook(__FILE__, 'instabook_clean_db');
	add_action('init', 'instabook_init');
	add_action( 'wp_enqueue_scripts', 'load_css' );

	
	define('URI_instabook_bookings', 'http://ib.guestonline.fr/instabook/bookings/');
	define('URI_instabook_SNews', 'http://ib.guestonline.fr/instabook/contacts/subscribe/');

	// Make sure we don't expose any info if called directly
	if ( !function_exists( 'add_action' ) ) 
	{
		_e ('Hi there!  I\'m just a plugin, not much I can do when called directly.', 'instabook');
		exit;
	}

	include_once dirname( __FILE__ ) . '/widget.php';

	if(is_admin())
		require_once dirname( __FILE__ ) . '/admin.php';

	//set database 
	function instabook_clean_db()
	{
		delete_option('instabook_referal_key');
		delete_option('instabook_host_bookings');
		delete_option('instabook_host_SNews');
	}

	
	//retrieve the referal key from the database
	function instabook_get_referal_key()
	{

		if(!empty($instabook_referal_key))
			return $instabook_referal_key; 
		
		return get_option('instabook_referal_key');
	}

	//retrieve the compelet uri for booking 
	function instabook_get_host_bookings()
	{
		if(!empty($instabook_host_bookings))
			return $instabook_host_bookings;
		
		return get_option('instabook_host_bookings');
	}

	//Retrieve the complete uri for contact subscription newsletter
	function instabook_get_host_SNews()
	{
		if(!empty($instabook_host_SNews))
			return $instabook_host_SNews;
		
		return get_option('instabook_host_SNews');

	}

	//save the referal_key and uri for contact subscription newsletter and bookings
	function instabook_set_referal_key($referal_key)
	{
		global $instabook_referal_key;
		$instabook_referal_key = $referal_key;

		update_option('instabook_referal_key', $referal_key);
		update_option('instabook_host_bookings', URI_instabook_bookings . $instabook_referal_key);
		update_option('instabook_host_SNews', URI_instabook_SNews . $instabook_referal_key);

	}

	//load file traduction when plugin is init
	function instabook_init()
	{
		load_plugin_textdomain( 'Guestonline', false, dirname(plugin_basename(__FILE__)));

	}

	 function load_css()
	{
			
        load_file(instabook_style, '/' . 'wp-instabook' . '/instabook.css');
        load_file(instabook_script, '/' .'wp-instabook' . '/instabook.js', 'true');
       
	}
	function load_file($name, $file_path, $is_script = false)
	{

		 $url = WP_PLUGIN_URL . $file_path;
	     $file = WP_PLUGIN_DIR . $file_path;
	     
	     	
	     if(file_exists($file)) 
	     {
	        if($is_script) 
	        {	// registers and load script
	            wp_register_script($name, $url);
	            wp_enqueue_script($name);
	        } 
	        else 
	        {	// registers and load stylesheet
	            wp_register_style($name, $url);
	             wp_enqueue_style($name);
	        } // end if
	      }// end if 	   
   	}

   	
   	function instabook_build_iframe($atts, $content = null ) 
   	{
		 if (!$atts['width']) { $atts['width'] = 320; }
		 if (!$atts['height']) { $atts['height'] = 450; }

		 return '<iframe border="0" class="iframe" id="tol_module" scrolling="no" src="' . $atts['src'] . '" width="' . $atts['width'] . '" height="' . $atts['height'] . '"></iframe>';
	} 

?>
