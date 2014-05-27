jQuery(document).ready(function($) {

  var response;

  $('#wordgun').on('submit',function(e) {

    e.preventDefault();

    $('form#wordgun *').fadeOut(200);
    $('form#wordgun').prepend('<p class="wordgun-message">Your submission is being processed...</p>');

    $.post( wordgun.ajaxurl, {
          action : 'send_wordgun',
          nonce : wordgun.nonce,
          post : $(this).serialize()
      },
      function(response) {
          console.log(response);
          responseSuccess(response);
      });

    return false;

  });

  function responseSuccess(data) {

    response = JSON.parse(data);

    if(response.status === 'success') {
      $('#wordgun').html('<p class="wordgun-message">Thanks for reaching out, I will contact you soon.</p>');
    } else {
      $('#wordgun').html('<p class="wordgun-message">An error has been encountered, your form was not sent.</p>');
    }

  }

});