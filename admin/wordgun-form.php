<?php

if(isset($_POST['form_name']) && $_POST['form_name'] == 'wordgun_form') {

  if(1 === check_admin_referer('wordgun-form-settings')) {

    $wg_name = $_POST['wg_name'];
    update_option('wg_name', $wg_name);

    $wg_email = $_POST['wg_email'];
    update_option('wg_email', $wg_email);

    $wg_subject = $_POST['wg_subject'];
    update_option('wg_subject', $wg_subject);

    $wg_message = $_POST['wg_message'];
    update_option('wg_message', $wg_message); ?>

    <div class="updated"><p><strong>Options saved.</strong></p></div><?php

  } else {

    die('Permission denied.');

  }

} else {

  $wg_name = get_option('wg_name');
  $wg_email = get_option('wg_email');
  $wg_subject = get_option('wg_subject');
  $wg_message = get_option('wg_message');

} ?>
  <style>
    input {
      min-width: 300px;
    }
    button#update {
      width: auto;
      margin-top: 25px;
    }
  </style>

  <form name="wordgun_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <input type="hidden" name="form_name" value="wordgun_form">
    <?php wp_nonce_field('wordgun-form-settings'); ?>
    <table class="form-table">
      <tr>
        <th><label for="mg_key">Name</label></th>
        <td>
          <select name="wg_name">
            <option value="disabled" <?php echo $wg_name === 'disabled' ? 'selected' : ''; ?>>Disabled</option>
            <option value="enabled" <?php echo $wg_name === 'enabled' ? 'selected' : '';?>>Enabled</option>
          </select>
        </td>
      </tr>
      <tr>
        <th><label for="wg_email">Email</label></th>
        <td>
          <select name="wg_email">
            <option value="disabled" <?php echo $wg_email === 'disabled' ? 'selected' : ''; ?>>Disabled</option>
            <option value="enabled" <?php echo $wg_email === 'enabled' ? 'selected' : '';?>>Enabled</option>
          </select>
        </td>
      </tr>
      <tr>
        <th><label for="wg_subject">Subject</label></th>
        <td>
          <select name="wg_subject">
            <option value="disabled" <?php echo $wg_subject === 'disabled' ? 'selected' : ''; ?>>Disabled</option>
            <option value="enabled" <?php echo $wg_subject === 'enabled' ? 'selected' : '';?>>Enabled</option>
          </select>
        </td>
      </tr>
      <tr>
        <th><label for="wg_message">Message</label></th>
        <td>
          <select name="wg_message">
            <option value="disabled" <?php echo $wg_message === 'disabled' ? 'selected' : ''; ?>>Disabled</option>
            <option value="enabled" <?php echo $wg_message === 'enabled' ? 'selected' : '';?>>Enabled</option>
          </select>
        </td>
      </tr>
    </table>

    <button id="update" class="btn button" type="submit" name="Submit">Update Settings</button>

  </form>