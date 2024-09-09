$(document).ready(function () {
  $("#currentYear").text(new Date().getFullYear());

  function showAlert(message, type) {
    var $alertMessage = $("#alertMessage");
    $alertMessage
      .removeClass("alert-success alert-danger alert-warning")
      .addClass("alert-" + type)
      .html(
        message +
          '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
      )
      .removeClass("d-none")
      .fadeIn();

    // hide the alert after 5 seconds
    setTimeout(function () {
      $alertMessage.fadeOut(function () {
        $(this).addClass("d-none");
      });
    }, 5000);
  }

  function resetModal() {
    $("#getFWT .modal-body h1.text-center").html(
      "Get Free Wellbeing Tips To Your Email"
    );
    $("#getFWT form")[0].reset();
    $('#getFWT form button[type="submit"]').text("Get").prop("disabled", false);
  }

  function submitForm($form) {
    var $submitButton = $form.find('button[type="submit"]');
    $submitButton.prop("disabled", true);
    $submitButton.text("Sending...");

    var formData = $form.serialize();

    // send email
    $.ajax({
      type: "POST",
      url: "/wp-content/themes/inner-works-theme/mail/send.php",
      data: formData,
      success: function (response) {
        if (response === "1") {
          // sent email successfully
          $submitButton.text("Sent!");
          $form[0].reset();

          // change the modal title to success
          $("#getFWT .modal-body h1.text-center").html(
            "Get Free Wellbeing Tips Sent Successfully"
          );

          // notify success to the user
          showAlert(
            "Get free wellbeing tips sent successfully! Please check your email.",
            "success"
          );

          // close the modal after 2 seconds
          setTimeout(function () {
            $("#getFWT .btn-close").click();
          }, 2000);
        } else {
          $submitButton.text("Get");

          // notify error to the user
          showAlert("An error occurred. Please try again.", "danger");
        }
        $submitButton.prop("disabled", false);
      },
      error: function () {
        $submitButton.text("Get");
        $submitButton.prop("disabled", false);

        // notify error to the user
        showAlert("An error occurred. Please try again.", "danger");
      },
    });
    return false;
  }

  $("form").submit(function (event) {
    event.preventDefault();
    return submitForm($(this));
  });

  // reset modal
  $("#getFWT").on("hidden.bs.modal", function () {
    resetModal();
  });
});
