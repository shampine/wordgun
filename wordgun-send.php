<?php
/*
* This controls our showcase application form and contact form. Requires wp-config to have
* a valid API key from Mailgun.
*/

require_once('../wp-load.php');

if(empty($_POST) || !isset($_POST) || !empty($_POST['email_2'])) {

  ajaxResponse('error', 'POST was empty.', $dataString);

} else {

  $dataString = implode($_POST,",");
  $data = $_POST;

  $mailgun = sendMailgun($data);

  if($mailgun) {

    ajaxResponse('success', 'Great success.', $dataString, $mailgun);

  } else {

    ajaxResponse('error', 'Mailgun did not connect properly.', $dataString);

  }

}

function ajaxResponse($status, $message, $data, $mg = NULL) {
  $response = array (
    'status' => $status,
    'message' => $message,
    'data' => $data,
    'mailgun' => $mg
    );
  $output = json_encode($response);
  exit($output);
}

function sendMailgun($data) {

  global $environment;

  if($data['form'] === 'form-contact') {

    $name = isset($data['wg_name']) ? $data['wg_name'] : '';
    $email = isset($data['wg_email']) ? $data['wg_email'] : '';
    $subject = 
    $content = isset($data['wg_message']) ? $data['wg_message'] : '';

    $messageBody = "Contact: $name ($email)\n\nMessage: $content";

  }

  $config = array();
  $config['api_key'] = get_option('mg_key');
  $config['api_url'] = 'https://api.mailgun.net/v2/'.(get_option('mg_domain').'/messages';

  $message = array();
  $message['from'] = $email;
  $message['to'] = get_option('mg_to');
  $message['h:Reply-To'] = $email;
  $message['subject'] = isset($data['wg_subject']) ? $data['wg_subject'] : get_option('mg_subject');
  // $message['html'] = ;
  $message['text'] = $messageBody;

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, $config['api_url']);
  curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($curl, CURLOPT_USERPWD, "api:{$config['api_key']}");
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($curl, CURLOPT_POST, true); 
  curl_setopt($curl, CURLOPT_POSTFIELDS,$message);

  $result = curl_exec($curl);

  curl_close($curl);
  return $result;

}
