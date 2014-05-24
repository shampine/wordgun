<?php
/*
Plugin Name: wordgun
Plugin URI: https://github.com/patrickshampine/wordgun
Description: A contact form plugin built using mailgun.
Version: 0.1
Author: Patrick Shampine
Author URI: http://patrickshampine.com
Author Email: patrick@patrickshampine.com
*/

class wordgun {

  function __construct() {
    add_action('admin_menu', array(&$this,'wordgun_admin_pages'));
  }

  function wordgun_admin_pages() {
    add_users_page("users.php", "GJ User Approve", 'administrator', "gj_user_approve", "gj_user_approve_admin_options");
    add_menu_page( 'WordGun', 'WordGun', 'administrator', 'wordgun', 'wordgun_admin_options', 'dashicons-admin-generic', '62.161' );
  }

  function wordgun_admin_options() {
    include ('admin/gj-wordgun-options.php');
  }

}
new wordgun();


