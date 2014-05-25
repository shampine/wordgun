jQuery(document).ready(function($) {

  console.log(wordgun.dir);

  var mailgunURL, mailgun, response;

  mailgunURL = wordgun.dir + '/wordgun-send.php';

  $('#wordgun').on('submit',function(e) {

    e.preventDefault();

    $('form#wordgun *').fadeOut(200);
    $('form#wordgun').prepend('<p class="wordgun-message">Your submission is being processed...</p>');

    $.ajax({
        type     : 'POST',
        cache    : false,
        url      : mailgunURL,
        data     : $(this).serialize(),
        success  : function(data) {
          responseSuccess(data);
          console.log(data);
        },
        error  : function(data) {
          console.log('Silent failure.');
        }
    });

    return false;

  });

  function responseSuccess(data) {

    response = JSON.parse(data);

    if(response.status === 'success') {
      $('#wordgun').html('<p class="message">Thanks for reaching out, I will contact you soon.</p>');
    } else {
      $('#wordgun').html('<p class="message">An error has been encountered, your form was not received.</p>');
    }


  }

});