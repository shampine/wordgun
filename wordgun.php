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
    add_menu_page('WordGun', 'WordGun', 'administrator', 'wordgun', array(&$this, 'wordgun_admin_options'), 'dashicons-email-alt', '102.161');
  }

  function wordgun_admin_options() {
    include_once('admin/wordgun-options.php');
  }

  function wordgun_scripts() {

    global $post;

    if(shortcode_exists('wordgun') && stripos($post->post_content,'[wordgun]') !== false) {

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

  function wordgun_shortcode() {

    $wordgun =  '
      <form class="form" role="form" id="wordgun" method="POST">
        <input class="hidden" type="email" name="email_2" value="">
    ';

    if(get_option('wg_name') === 'enabled') {
    
      $name =  '
        <div class="form-group">
          <label for="wg_name" class="control-label">Name</label>
          <input type="name" name="wg_name" class="form-control" placeholder="Name" required>
        </div>
      ';

      $wordgun .= $name;
    }

    if(get_option('wg_email') === 'enabled') {

      $email = '
        <div class="form-group">
          <label for="wg_email" class="control-label">Email</label>
          <input type="email" name="wg_email" class="form-control" placeholder="Email" required>
        </div>
      ';

      $wordgun .= $email;
    }

    if(get_option('wg_subject') === 'enabled') {

      $subject = '
        <div class="form-group">
          <label for="wg_subject" class="control-label">Subject</label>
          <input class="form-control" name="wg_subject" rows="6" placeholder="Subject" required>
        </div>
      ';

      $wordgun .= $subject;
    }

    if(get_option('wg_message') === 'enabled') {

      $message = '
        <div class="form-group">
          <label for="wg_message" class="control-label">Message</label>
          <textarea class="form-control" name="wg_message" rows="6" placeholder="Message" required></textarea>
        </div>
      ';

      $wordgun .= $message;
    }

    $wordgun .= '
        <div class="form-group">
          <button type="submit" class="btn">Send</button>
        </div>
      </form>
    ';

    return $wordgun;
  }


}
new wordgun();


