<?php
/*
* Options page for wordgun
*/

if ('wordgun-options.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
  die();
}



$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'wordgun_form';

?>

<h2 class="nav-tab-wrapper">
  <a href="?page=wordgun&tab=wordgun_form" class="nav-tab <?php echo $active_tab == 'wordgun_form' ? 'nav-tab-active' : ''; ?>">Contact Form</a>
  <a href="?page=wordgun&tab=wordgun_mailgun" class="nav-tab <?php echo $active_tab == 'wordgun_mailgun' ? 'nav-tab-active' : ''; ?>">Mailgun</a>
  <a href="?page=wordgun&tab=wordgun_settings" class="nav-tab <?php echo $active_tab == 'wordgun_settings' ? 'nav-tab-active' : ''; ?>">Settings</a>
</h2>

<div class="wrap"><?php

  if( $active_tab == 'wordgun_form' ) {
    if (file_exists(__DIR__. '/wordgun-form.php')) {
      include_once(__DIR__. '/wordgun-form.php');
    }
    else {
      echo 'Form tab is missing';  
    }
  }

  if( $active_tab == 'wordgun_mailgun' ) {
    if (file_exists(__DIR__. '/wordgun-mailgun.php')) {
      include_once(__DIR__. '/wordgun-mailgun.php');
    }
    else {
      echo 'Mailgun tab is missing';  
    }
  }

  if( $active_tab == 'wordgun_settings' ) {
    if (file_exists(__DIR__. '/wordgun-settings.php')) {
      include_once(__DIR__. '/wordgun-settings.php');
    }
    else {
      echo 'File is missing';  
    }
  } ?>

</div>