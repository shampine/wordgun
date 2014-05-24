<?php

$disableSubject = get_option('wg_subject') === 'enabled' ? true : false;

if(isset($_POST['form_name']) && $_POST['form_name'] == 'wordgun_mailgun') {

  $mg_key = $_POST['mg_key'];
  update_option('mg_key', $mg_key);

  $mg_domain = $_POST['mg_domain'];
  update_option('mg_domain', $mg_domain);

  $mg_to = $_POST['mg_to'];
  update_option('mg_to', $mg_to);

  $mg_subject = $_POST['mg_subject'];
  update_option('mg_subject', $mg_subject); ?>

  <div class="updated"><p><strong>Options saved.</strong></p></div><?php

} else {

  $mg_key = get_option('mg_key');
  $mg_domain = get_option('mg_domain');
  $mg_to = get_option('mg_to');
  $mg_subject = get_option('mg_subject');

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

  <form name="wordgun_mailgun" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    <input type="hidden" name="form_name" value="wordgun_mailgun">
    <table class="form-table">
      <tr>
        <th><label for="mg_key">API Key</label></th>
        <td><input type="text" name="mg_key" class="mg-key" value="<?php echo $mg_key; ?>"></td>
      </tr>
      <tr>
        <th><label for="mg_domain">Mailgun Domain</label></th>
        <td><input type="text" name="mg_domain" class="mg-domain" value="<?php echo $mg_domain; ?>"></td>
      </tr>
      <tr>
        <th><label for="mg_to">To Address</label></th>
        <td><input type="text" name="mg_to" class="mg-to" value="<?php echo $mg_to; ?>"></td>
      </tr>
      <tr>
        <th><label for="mg_subject">Email Subject</label></th>
        <td><input type="text" name="mg_subject" class="mg-subject" value="<?php echo $mg_subject; ?>" <?php echo $disableSubject ? 'disabled' : ''; ?>></td>
      </tr>
    </table>

    <button id="update" class="btn button" type="submit" name="Submit">Update Settings</button>

  </form>