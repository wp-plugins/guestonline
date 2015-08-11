echo '  
				<div class="updated" style="padding: 0; margin: 0; border: none; background: none;">  
					<style type="text/css">  

						.activate_key
						{
							min-width:825px;
							border:1px solid #FFF;
							padding:5px;
							margin:15px 0;
							background:#CCCCCC;
							-moz-border-radius:3px;border-radius:3px;
							-webkit-border-radius:3px;position:relative;overflow:hidden
						}
						.activate_key .aa_button
						{
							font-weight:bold;
							border:1px solid ;
							border-top:1px solid #06B9FD;
							font-size:15px;
							text-align:center;
							padding:9px 0 8px 0;
							color:#FFF;
							background:#029DD6;
							background-image:-webkit-gradient(linear,0% 0,0% 100%,from(#029DD6),to(#0079B1));
							background-image:-moz-linear-gradient(0% 100% 90deg,#0079B1,#029DD6);
							-moz-border-radius:2px;border-radius:2px;-webkit-border-radius:2px
						}
						.activate_key .aa_button:hover
						{
							text-decoration:none !important;
							border:1px solid #029DD6;
							border-bottom:1px solid #00A8EF;
							font-size:15px;text-align:center;padding:9px 0 8px 0;
							color:#F0F8FB;
							background:#0079B1;
							background-image:-webkit-gradient(linear,0% 0,0% 100%,from(#0079B1),to(#0092BF));
							background-image:-moz-linear-gradient(0% 100% 90deg,#0092BF,#0079B1);
							-moz-border-radius:2px;border-radius:2px;-webkit-border-radius:2px
						}.activate_key .aa_button_container{cursor:pointer;display:inline-block;background:#DEF1B8;padding:5px;-moz-border-radius:2px;border-radius:2px;-webkit-border-radius:2px;width:266px}
						
					</style>                       
					<form name="activate_key" action="'.esc_url( add_query_arg( array( 'page' => 'instabook-key-config' ), admin_url( 'plugins.php' ) ) ).'" method="POST"> 
						<div class="activate_key">  
							<div class="aa_button_container" onclick="document.activate_key.submit();">  
								<div class="aa_button_border">          
									<div class="aa_button">'.__('Activate your account').'</div>  
								</div>  
							</div>  
						</div>  
					</form>  
				</div> '; 