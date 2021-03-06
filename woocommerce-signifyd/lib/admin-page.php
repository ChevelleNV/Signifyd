<?php
if ( ! defined( 'ABSPATH' ) ) { 
    exit; // Exit if accessed directly
}

add_action('admin_menu', 'my_menu_pages');

function my_menu_pages(){
    add_menu_page('Signifyd', 'Signifyd', 'edit_posts', 'signifyd-menu', 'signifyd_settings');
    add_submenu_page('signifyd-menu', 'Signifyd Settings', 'Signifyd Settings', 'edit_posts', 'signifyd-menu' );
}
// Signifyd Settings Page
function signifyd_settings() {

    global $title; 
    if($_POST['oscimp_hidden'] == 'Y') {
		$slogin = $_POST['signifyd_login'];
		if (strlen($slogin) > 0 ) {
			update_option('signifyd_login', $slogin);
		} 
		$spassword = $_POST['signifyd_password'];
		if (strlen($spassword) > 0 ) {
			update_option('signifyd_password', $spassword);
		}
		$sapi = $_POST['signifyd_api'];
		if (strlen($sapi) > 0 ) {
			update_option('signifyd_api', $sapi);
		}
		if( !get_option( 'signifyd_registered' ) ) {
			if (strlen($sapi) > 0 ) {
				// if user NOT already registered and if API length entered greater than 0, log as new user
				//removed google analytics code for original developer
				?>
				<?php
				update_option('signifyd_registered', 'true');
			}
		}
		?>
		<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
		<?php
	} 
	?>
	<div class="wrap">
		<div style="width:90%; display:block">
		<div style="width:44%; display:inline; float:left;">
		<?php echo "<h2>" . $title . "</h2>"; ?>
		<form name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
			<input type="hidden" name="oscimp_hidden" value="Y">
			<p><?php _e("API Key: " ); ?>&nbsp;&nbsp;&nbsp;<input type="text" name="signifyd_api" placeholder="<?php echo get_option('signifyd_api'); ?>"  value="<?php echo $sapi; ?>" size="25"></p>
			<p>-------------------------------------------------------------------</p>
			<p><?php _e("Login: " ); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="signifyd_login" placeholder="<?php echo get_option('signifyd_login'); ?>" value="<?php echo $slogin; ?>" size="25"></p>
			<p><?php _e("Password: " ); ?><input type="password" name="signifyd_password" placeholder="**********" value="<?php echo $spassword; ?>" size="25"></p>
			<p class="submit">
			<input type="submit" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />
			</p>
		</form>
		</div>
		<div style="width:44%; display:inline; float:right;">
		<iframe width="560" height="315" src="//www.youtube.com/embed/gpBz4RxqCik" frameborder="0" allowfullscreen></iframe>
		<br/><br/><br/>
		<h3>Signifyd Contact:</h3>
			<p>
				<strong>Have a sales question?</strong>
				<br>Email our sales team at <br>
				<a href="mailto:sales@signifyd.com">sales@signifyd.com</a>
			</p>
			<p>
				<strong>Would like to discuss further?</strong>
				<br>Feel free to call us at <br>
				(866) 893-0777
			</p>			
		</div>
	</div>
    <?php	
}
