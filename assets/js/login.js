$(document).ready(function () {
  
  $('#loginForm').on('submit', function (e) {
    let isValid = true;

    // Email
    const emailField = $('input[name="email"]');
    if (!emailField.val().trim()) {
      emailField.addClass('is-invalid');
      isValid = false;
    } else {
      emailField.removeClass('is-invalid');
    }

    // Password
    const passField = $('input[name="password"]');
    if (!passField.val().trim()) {
      passField.addClass('is-invalid');
      isValid = false;
    } else {
      passField.removeClass('is-invalid');
    }

    if (!isValid) e.preventDefault();
  });

  $('input').on('input', function () {
    $(this).removeClass('is-invalid');
  });

  // Flash success message using SweetAlert
  const successMessage = $('#flash-success-message').data('message');
  if (successMessage) {
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: successMessage,
      confirmButtonColor: '#3085d6',
      confirmButtonText: 'OK'
    });
  }
  
});
    