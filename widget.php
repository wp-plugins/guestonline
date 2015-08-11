<?php

	add_action('widgets_init', create_function('', 'register_widget("Instabook_Bookings_Widget");'));
	//add_action('widgets_init', create_function('', 'register_widget("Instabook_Subscribe_Newsletters_Widget");'));
	/**
	* 
	*/
	class Instabook_Bookings_Widget extends WP_Widget
	{
		function __construct()
		{
			$this->init_plugin_constants();

			// //update classname and description
			$widget_opts  = array('classname' =>  PLUGIN_NAME,
									'description' => __('Add bookings instabook module to sidebar', 'instabook') 
								  );
			$this->WP_Widget(PLUGIN_SLUG, __(PLUGIN_NAME, 'bookings'), $widget_opts);
			

		}


		function form($instance)
		{
			// $show_config_iframe = false;
			$default_title = "Booking";
			$default_widget_type_display = 1;

			 $title=empty($instance['bookings_title']) ? $default_title : esc_attr($instance['bookings_title']);
			 $widget_type_display = empty($instance['widget_type_display']) ? $default_widget_type_display : esc_attr($instance['widget_type_display']);
			 // if($widget_type_display==2)
			 // 	$show_config_iframe =true; 

			 
?>			
 
			<p>
				<label for="<?php echo $this->get_field_id('bookings_title'); ?>">
					<?php _e('Widget Title', 'instabook'); ?>
				</label>
				<input class="widefat" 
						id="<?php echo $this->get_field_id('bookings_title'); ?>" 
						name="<?php echo $this->get_field_name('bookings_title'); ?>" 
						type="text" value="<?php echo $title; ?>" />		
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('widget_type_display'); ?>">
					<?php _e('Widget Type', 'instabook'); ?>
				</label>
			</p>
			<p>	
				<input type="radio" name="<?php echo $this->get_field_name('widget_type_display'); ?>" value="1" <?php if ($widget_type_display=="1") echo "checked"; ?> > <?php _e('Button', 'instabook') ?> </input>
				<br/><input type="radio" name="<?php echo $this->get_field_name('widget_type_display'); ?>" value="2"  <?php if ($widget_type_display=="2") echo "checked"; ?> > Iframe </input>
			</p>

			
<?php
			
		}

		function update($new_instance, $old_instance)
		{
			$instance =$old_instance;
			if(!empty($new_instance['bookings_title'])) 
				$instance['bookings_title'] = strip_tags($new_instance['bookings_title']);
		
				$instance['widget_type_display'] = $new_instance['widget_type_display'];

			return $instance;
		}



		function widget($args, $instance)
		{
			extract( $args );
			 // these are the widget options
	    	$title = apply_filters('widget_title', $instance['bookings_title']);
	    	$widget_type_display = $instance['widget_type_display'];
	    	$host = instabook_get_host_bookings();


	    	echo $before_widget;
	    	 // Check if title is set
	    	 // Display the widget
	    	 if(!empty($title))
	    	 {
?>	    		
					<?php 
						if($widget_type_display == "1")
		    	 		{ 			
		    	 	?>	
			  
			    	 			<a href='<?php echo $host?>' class="iframe" id="tol_module" style="font-family:'trebuchet ms',helvetica,sans-serif;font-size:14px;width: 180px;text-align:center;background: #000;display: inline-block;padding: 5px 10px 6px;color: #fff;text-decoration: none;font-weight: bold;line-height: 1;-moz-border-radius: 5px;-webkit-border-radius: 5px;-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);text-shadow: 0 -1px 1px rgba(0,0,0,0.25);border-radius: 5px;
			    	 				box-shadow: 0 1px 3px rgba(0,0,0,0.5);border-bottom: 1px solid rgba(0,0,0,0.25);cursor: pointer;">
			    	 				 <?php echo $title ?>
			    	 			</a>
			    	 				<script type="text/javascript">
									(
										function() {
											var tomod = document.createElement("script"); 
											tomod.type = "text/javascript"; 
											tomod.async = true;
											tomod.src = "http://ib.guestonline.fr/instabook/js/instabook_mod.js";
											var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(tomod, s);
										})();
								</script>
<?php	   
					   
						}
						else
						{

?>						
 							<iframe  class="iframe" id="tol_module" src="<?php echo $host?>" 
 										scrolling="no"  
 										 style="background: #000; 
 										 display: inline-block;
 										 -moz-border-radius: 5px;
 										 -webkit-border-radius: 5px;
 										 -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
 										 -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
 										 border-radius: 3px;
			    	 				  	 box-shadow: 0 1px 3px rgba(0,0,0,0.5);
			    	 				  	 max-width: 370px;  min-height: 450px;
			    	 				  	 
			    	 				  ">	
 										An iframe capable browser is required to view this web site.
							</iframe>


							
<?php							
						}
			}
	    	echo $after_widget;

		}
		function init_plugin_constants()
		{

			if(!defined('PLUGIN_NAME'))
				define ('PLUGIN_NAME', 'Instabook Bookings');

			if(!defined('PLUGIN_SLUG'))
				define(('PLUGIN_SLUG'), 'wp-instabook-bookings');
		}
	}

	class Instabook_Subscribe_Newsletters_Widget extends WP_Widget
	{
		function __construct()
		{
			$this->init_plugin_constants();

			// //update classname and description
			$widget_opts  = array('classname' =>  'Instabook subscription',
									'description' => __('Add instabook module for subscription to the newsletters in sidebar', 'instabook') 
								  );
			$this->WP_Widget('wp-instabook-subscribe', __('Instabook subscription', 'newsletters'), $widget_opts);
		
		}
		

		function form($instance)
		{
			$newsletters_title = empty($instance['newsletters_title']) ? "subscription" :  esc_attr($instance['newsletters_title']);
			$widget_type_display_newsletters = empty($instance['widget_type_display_newsletters']) ? "1" : $instance['widget_type_display_newsletters'];


?>
			<p>
				<label for="<?php echo $this->get_field_id('newsletters_title'); ?>">
					<?php _e('Widget Title', 'instabook'); ?>
				</label>
				<input class="widefat" 
						id="<?php echo $this->get_field_id('newsletters_title'); ?>" 
						name="<?php echo $this->get_field_name('newsletters_title'); ?>" 
						type="text" value="<?php echo $newsletters_title; ?>" />		
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('widget_type_display_newsletters'); ?>">
					<?php _e('Widget Type', 'instabook'); ?>
				</label>
			</p>
			<p>	
				<input type="radio" name="<?php echo $this->get_field_name('widget_type_display_newsletters'); ?>" value="1" <?php if ($widget_type_display_newsletters=="1") echo "checked"; ?> > <?php _e('Button', 'instabook') ?> </input>
				<br/><input type="radio" name="<?php echo $this->get_field_name('widget_type_display_newsletters'); ?>" value="2"  <?php if ($widget_type_display_newsletters=="2") echo "checked"; ?> > Iframe </input>
			</p>
			
<?php
		}

		function update($new_instance, $old_instance)
		{
			$instance =$old_instance;
			if(!empty($new_instance['newsletters_title'])) 
				$instance['newsletters_title'] = strip_tags($new_instance['newsletters_title']);
		
				$instance['widget_type_display_newsletters'] = $new_instance['widget_type_display_newsletters'];
			

			return $instance; 
		}

		function widget($args, $instance)
		{
			extract( $args );
			 // these are the widget options
	    	$title = apply_filters('widget_title', $instance['newsletters_title']);
	    	$widget_type_display = $instance['widget_type_display_newsletters'];
	    	$host = instabook_get_host_SNews();

	    	echo $before_widget;

	    	 // Check if title is set
	    	 // Display the widget
	    	 if(!empty($title))
	    	 {
?>	
					<?php 
						if($widget_type_display == "1") 
		    	 		{ 			
		    	 	?>	
		    	 			<a href='<?php echo $host?>' class="iframe" id="tol_module" 
		    	 				style="font-family:'trebuchet ms',helvetica,sans-serif;
		    	 						font-size:14px;
		    	 						width: 180px;
		    	 						text-align:center;
		    	 						background: #000;
		    	 						display: inline-block;
		    	 						padding: 5px 10px 6px;
		    	 						color: #fff;
		    	 						text-decoration: none;
		    	 						font-weight: bold;
		    	 						line-height: 1;
		    	 						-moz-border-radius: 5px;
		    	 						-webkit-border-radius: 5px;
		    	 						-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
		    	 						-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
		    	 						text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
		    	 						border-radius: 5px;
			    	 					box-shadow: 0 1px 3px rgba(0,0,0,0.5);
			    	 					border-bottom: 1px solid rgba(0,0,0,0.25);
			    	 					cursor: pointer;"
			    	 		>
			    	 		<?php echo $title ?>
			    	 		</a>
			    	 				<script type="text/javascript">
									(
										function() {
											var tomod = document.createElement("script"); 
											tomod.type = "text/javascript"; 
											tomod.async = true;
											tomod.src = "http://ib.guestonline.fr/instabook/js/instabook_mod.js";
											var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(tomod, s);
										})();
									</script>
<?php	   
					   
						}
						else
						{

?>						
 							<iframe  class="iframe" id="tol_module" src="<?php echo $host?>" 
 										 scrolling: no; 
 										 style="background: #000; 
 										 display: inline-block;
 										 -moz-border-radius: 5px;
 										 -webkit-border-radius: 5px;
 										 -moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
 										 -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
 										 border-radius: 3px;
			    	 				  	 box-shadow: 0 1px 3px rgba(0,0,0,0.5);
			    	 				  	 max-width: 320px;  min-height: 450px;
			    	 				  	 
			    	 				  ">	
 										An iframe capable browser is required to view this web site.
							</iframe>
							
<?php							
						}
			}


			echo $after_widget;	 
		}
		function init_plugin_constants()
		{

			if(!defined('PLUGIN_NAME_SNEWS'))
				define ('PLUGIN_NAME_SNEWS', 'Instabook Contacts Newsletters');

			if(!defined('PLUGIN_SLUG_SNEWS'))
				define(('PLUGIN_SLUG_SNEWS'), 'wp-instabook-newsletters');
		}

	}

	//vspace="0" hspace="0" style="overflow:visible; width:100%; height:100%" scrolling="no" style="-webkit-transform:scale(0.5);-moz-transform-scale(0.5);"

?>
