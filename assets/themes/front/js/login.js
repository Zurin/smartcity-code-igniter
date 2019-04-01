$(document).ready(function () {
    var submitButton = $("#loginButton").attr("disabled", true);
    $("#login input.required").change(function () {
       var valid = true;
       $.each($("#login input.required"), function (index, value) {
           if(!$(value).val()){
              valid = false;
           }
       });
       if(valid){
           $(submitButton).attr("disabled", false);
       }
       else{
           $(submitButton).attr("disabled", true);
       }
       $('.alert').alert();
   });
 });