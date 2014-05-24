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
    add_menu_page('WordGun', 'WordGun', 'administrator', 'wordgun', array(&$this, 'wordgun_admin_options'), 'dashicons-admin-generic', '62.161');
  }

  function wordgun_admin_options() {
    include('admin/wordgun-options.php');
  }

}
new wordgun();


