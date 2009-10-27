<?php
/*
* Plugin Name: Skeleton Key
* Plugin URI: http://github.com/sant0sk1/wp-skeleton-key
* Description: Gives administrators a skeleton key (their own password) to login as any user they'd like.
* Author: Jerod Santo
* Author URI: http://jerodsanto.net
* Version: 1.0
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
      if ($username == $login) { break; }
      
      $admindata = get_userdatabylogin($login);

      if (wp_check_password($password, $admindata->user_pass, $admindata->ID)) {
        return new WP_User($userdata->ID);
      }
    }
  }
  return new WP_Error;
}

function get_logins_for_userlevel($level) {
  global $wpdb;

  $logins = array();
  $results = $wpdb->get_results("SELECT user_id from $wpdb->usermeta 
    WHERE meta_key='wp_user_level' and meta_value='$level'");

  foreach($results as $r) {
    $result = $wpdb->get_results("SELECT user_login from $wpdb->users WHERE ID='$r->user_id'");
    array_push($logins, stripslashes($result[0]->user_login));
  }
  return $logins;
}

?>
