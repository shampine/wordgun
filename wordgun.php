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
    add_action('wp_enqueue_scripts', array(&$this,'wordgun_scripts'));
    add_shortcode('wordgun', array(&$this,'wordgun_shortcode'));
  }

  function wordgun_admin_pages() {
    add_menu_page('WordGun', 'WordGun', 'administrator', 'wordgun', array(&$this, 'wordgun_admin_options'), 'dashicons-admin-generic', '62.161');
  }

  function wordgun_admin_options() {
    include('admin/wordgun-options.php');
  }

  function wordgun_scripts() {
    if(shortcode_exists('wordgun')) {

      $pluginDIR = plugins_url().'/wordgun/';
      $parameters = array(
        'dir' => $pluginDIR
        );

      wp_enqueue_script('wordgun-ajax', $pluginDIR.'js/ajax.js');
      wp_localize_script('wordgun-ajax', 'wordgun', $parameters );

      if(get_option('wg_bootstrap') === 'enabled') {
        wp_enqueue_style('wordgun-bootstrap', $pluginDIR.'css/bootstrap.min.css');
      }
    }
  }

  function wordgun_shortcode($atts) {
    $a = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );

    return "foo = {$a['foo']}";
}


}
new wordgun();


