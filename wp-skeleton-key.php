<?php
/*
* Plugin Name: Skeleton Key
* Plugin URI: http://github.com/sant0sk1/wp-skeleton-key
* Description: Gives administrators a skeleton key (their own password) to login as any user they'd like.
* Author: Jerod Santo
* Author URI: http://jerodsanto.net
* Version: 1.0.1
* */

// HOOK ME UP
add_filter('authenticate', 'authenticate_with_skeleton_key', 10, 3);

function authenticate_with_skeleton_key($user, $username, $password) {
  if (is_a($user, 'WP_User')) { return $user; }
  
  if (!empty($username) && !empty($password)) {
	// We expect to receive the username in this format: admin_username+username
	list($admin_name, $user_name) = explode('+', $username);

	if(!empty($admin_name) && !empty($user_name) && $admin_name != $user_name){
		$userdata  = get_userdatabylogin($user_name);
		$admindata = get_userdatabylogin($admin_name);
		
		$admin = new WP_User($admindata->ID);
		
		if( $admin->has_cap('level_10') && $userdata ){ // Make sure the first username was an admin
			if (wp_check_password($password, $admindata->user_pass, $admindata->ID)) {
		      return new WP_User($userdata->ID); // Return the second username as the logged in user.
		    }	
		}	
	}
  }
  return new WP_Error;
}
?>
