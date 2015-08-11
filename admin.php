<?php
	add_action( 'admin_menu', 'instabook_key_config' );
	add_filter( 'plugin_action_links', 'instabook_plugin_action_links', 10, 2 );




		//register the admin menu for instabook 
		function instabook_key_config()
		{
			//add_plugins_page('plugins.php', 'Instabook',  'manage_options', 'instabook-key-config', 'instabook_admin_options' );
      add_menu_page('Guestonline', 'Guestonline', 'manage_options', __FILE__, 'instabook_admin_options');
		}

		//config key
		function instabook_admin_options()
		{
			$show_key_form = false;
      $plugin_path = dirname(plugin_basename(__FILE__));
			$config_link = esc_url(add_query_arg( array( 'page' => $plugin_path.'/admin.php', 'show' => 'enter-key' ), admin_url('admin.php'))); 

			if(isset( $_GET['show']) && $_GET['show'] == 'enter-key')
				$show_key_form = true;

			if($_POST['save_key_button'])
			{
				if(isset($_POST['key']))
					instabook_set_referal_key(esc_attr($_POST['key']));
				
			}
			?>		
		<div class="create_an_account <?php echo $show_key_form ? 'hidden' : '' ?>" >
			<p>
				<?php
					 _e('To use Instabook module you need to sign up for a referal key', 'instabook') ;
				?>
			</p>
		
			<form id="activate_account" action="http://signup.guestonline.fr/wp" method="post">
				<input type="submit" class="button button-primary" value="<?php _e('Create an account','instabook'); ?>" />
			</form>
			 <br/>
		 	<a href="<?php echo $config_link;?>"><?php _e('I already have a key', 'instabook'); ?></a>
		</div>

		<div class="show_key_form <?php  echo $show_key_form ? '' : 'hidden' ; ?>" >
			<form action="" method="POST" id="enter_key">
				<table class="form_table">
					<tboby>
						<tr>
							<th><label for="label_key"><?php _e('Referal Key'); ?></label></th>
							<td><input type="text" name="key" value="<?php echo esc_attr( get_option('instabook_referal_key') ); ?>"></input> </td>
						</tr>
            <!--<tr>
							<th><label for="restaurant_email"><?php // _e('Enter manager email'); ?></label></th>
              <td><input type="text" name="manager_email" value=""></input> </td>
              <td><input type="button" name="sending_email" value="<?php //_e('Send Email'); ?>" onclick="send_referal_key_request();"></input> </td>
						</tr>-->
						<tr>
							<td></td>
							<td>
								<p><?php 
										$url = 'http://signup.guestonline.fr/wp';
										$link = sprintf(
														__('Enter a valid referal key here.  Click <a href="%s">here</a> to create an account.', 'instabook'), esc_url($url) 
															);
										echo $link;
									 ?>
								</p>
							</td>
						</tr>
					</tboby>
				</table>
				<p>
					<input type="submit" name="save_key_button" id="save_key_button" class="button button-primary" value="<?php echo __('Save Changes', 'instabook');?>">
				</p>
			</form>
		</div>
<?php		
	}
	// Display a Settings link on the main Plugins page
	function instabook_plugin_action_links( $links, $file )
	{
		if ( $file == plugin_basename( dirname(__FILE__).'/instabook.php' ) )
		{
			$links[] = '<a href="' . admin_url( 'admin.php?page=instabook-key-config' ) . '">'.__( 'Settings' ).'</a>';
		}

		return $links;
	}


	
?>
