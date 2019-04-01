$( function() {
    $( "#tgl_lahir" ).datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: "-100:+0",
      dateFormat: 'dd-mm-yy'
    });
  } );

  function checkPasswordMatch() {
      var password = $("#password").val();
      var confirmPassword = $("#password2").val();

      if ((password != confirmPassword) || (password=="") || (confirmPassword=="")){
          $("#password").addClass("is-invalid").removeClass("is-valid");
          $("#password2").addClass("is-invalid").removeClass("is-valid");
          return false;
      }
      else {
        $("#password").addClass("is-valid").removeClass("is-invalid");
        $("#password2").addClass("is-valid").removeClass("is-invalid");
        return true;
      }
  }

  function isValidEmailAddress() {
      var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
      var emailAddress = $("#email").val();
      var checkValid = pattern.test(emailAddress);
      if( !checkValid ) {
        $("#email").addClass("is-invalid").removeClass("is-valid");
        return false;
      } else {
        $("#email").addClass("is-valid").removeClass("is-invalid");
        return true;
      }
  };

  $(document).ready(function () {
     $("#password, #password2").keyup(checkPasswordMatch);
     $("#email").keyup(isValidEmailAddress);
     $("#username").keyup(check_if_exists);
     var submitButton = $("#registerButton").attr("disabled", true);
     $("#register input.required").change(function () {
        var valid = true;
        $.each($("#register input.required"), function (index, value) {
            if(!$(value).val()){
               valid = false;
            }
        });
        if(!checkPasswordMatch())
          valid = false;
        if(!isValidEmailAddress())
          valid = false;
        if(valid){
            $(submitButton).attr("disabled", false);
        }
        else{
            $(submitButton).attr("disabled", true);
        }
    });
    $('.alert').alert();
  });