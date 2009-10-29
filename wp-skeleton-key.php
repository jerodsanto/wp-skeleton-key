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
    $userdata     = get_userdatabylogin($username);
    $admin_logins = get_logins_for_userlevel(10);

    foreach($admin_logins as $login) {
      // we don't want to handle admins logging in as themselves
      if ($username == stripslashes($login->user_login)) { break; }

      if (wp_check_password($password, $login->user_pass, $login->ID)) {
        return new WP_User($userdata->ID);
      }
    }
  }
  return new WP_Error;
}

function get_logins_for_userlevel($level) {
  global $wpdb;

  $logins = $wpdb->get_results(
	"SELECT $wpdb->users.ID, $wpdb->users.user_login, $wpdb->users.user_pass " .
	"FROM $wpdb->users, $wpdb->usermeta " .
	"WHERE $wpdb->usermeta.meta_key   = 'wp_user_level' " .
	  "AND $wpdb->usermeta.meta_value = '$level' " .
	  "AND $wpdb->usermeta.user_id    = $wpdb->users.ID;"
	);

  return $logins;
}

?>
