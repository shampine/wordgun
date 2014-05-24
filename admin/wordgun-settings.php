<?php

if(isset($_POST['form_name']) && $_POST['form_name'] == 'wordgun_mailgun') {

  $wg_bootstrap = $_POST['wg_bootstrap'];
  update_option('wg_bootstrap', $wg_bootstrap); ?>

  <div class="updated"><p><strong>Options saved.</strong></p></div><?php

} else {

  $wg_bootstrap = get_option('wg_bootstrap');

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

  <form name="wordgun_settings" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <input type="hidden" name="form_name" value="wordgun_settings">
    <table class="form-table">
      <tr>
        <th><label for="wg_bootstrap">Enable Bootstrap</label></th>
        <td>
          <select name="wg_bootstrap">
            <option value="disabled" <?php echo $wg_bootstrap === 'disabled' ? 'selected' : ''; ?>>Disabled</option>
            <option value="enabled" <?php echo $wg_bootstrap === 'enabled' ? 'selected' : '';?>>Enabled</option>
          </select>
        </td>
      </tr>
    </table>

    <button id="update" class="btn button" type="submit" name="Submit">Update Settings</button>

  </form>
