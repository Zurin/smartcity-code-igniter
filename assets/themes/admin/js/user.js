$(document).ready(function() {
    
    $('#tgl_lahir').datepicker({
        startView: 2,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd-mm-yyyy"
    });

    $('.i-checks-green').iCheck({
        radioClass: 'iradio_square-green',
    });

    var tableUser = $('#tableUser').DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    });

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "preventDuplicates": false,
        "positionClass": "toast-top-full-width",
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $("#submitUpdateUser").click(function(event) {
        $("#submitUpdateUser").attr('disabled', 'disabled');
        $("#submitUpdateUser").empty();
        $("#submitUpdateUser").append("Mengupdate user <i class='fa fa-circle-o-notch fa-spin'></i>");
        event.preventDefault();
        var id_user = $("#id_user").val();
        var level = $("input[name='level']:checked").val();

        $.ajax({
            type: "POST",
            url:  base_url+"index.php/actions_admin/update_user",
            data: {"id_user": id_user, "level": level},
            success: function(response) {
                if (response == 'ok')
                {
                    if(level=='admin'){
                        $("#level-"+id_user).html("<span class='label label-success'>admin</span>");
                    } else if(level=='adminRS'){
                        $("#level-"+id_user).html("<span class='label label-warning'>adminRS</span>");
                    } else {
                        $("#level-"+id_user).html("<span class='label label-primary'>member</span>");
                    }
                    toastr.success("Perubahan data user telah disimpan", "Update berhasil");
                    $('#submitUpdateUser').removeAttr('disabled');
                    $("#submitUpdateUser").empty();
                    $("#submitUpdateUser").append('Simpan');
                    $('#modalEditUser').modal('hide');
                }
                else {
                    toastr.error("Terjadi kesalahan", "Update gagal");
                    $('#submitUpdateUser').removeAttr('disabled');
                    $("#submitUpdateUser").empty();
                    $("#submitUpdateUser").append('Simpan');
                }
            }
        });
    });

    $("#usernameA").keyup(check_if_exists);
    $("#password, #password2").keyup(checkPasswordMatch);
     $("#emailA").keyup(isValidEmailAddress);

    var submitButton = $("#submitAddUser").attr("disabled", true);
     $("#formAddUser input.required").change(function () {
        var valid = true;
        $.each($("#formAddUser input.required"), function (index, value) {
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

    $("#submitAddUser").click(function(event) {

        $("#submitAddUser").attr('disabled', 'disabled');
        $("#submitAddUser").empty();
        $("#submitAddUser").append("Menambahkan user baru <i class='fa fa-circle-o-notch fa-spin'></i>");
        event.preventDefault();
        var nama = $("#namaA").val();
        var username = $("#usernameA").val();
        var email = $("#emailA").val();
        var password = $("#password").val();
        var gender = $('input[name=gender]:checked').val();;
        var tgl_lahir = $("#tgl_lahir").val();
        var level = $("input[name='levelA']:checked").val();

        $.ajax({
            type: "POST",
            url: base_url + "index.php/actions_admin/user_new",
            data: {"nama": nama, "username": username, "email": email, "password": password, "gender": gender, "tgl_lahir": tgl_lahir, "level": level},
            success: function(response) {
                if (response == 'ok')
                {
                    toastr.success("Perubahan data user telah disimpan", "Update berhasil");
                    $('#formAddUser')[0].reset();
                    $("#submitAddUser").empty();
                    $("#submitAddUser").append('Daftarkan');
                } else {
                    toastr.error("Terjadi kesalahan", "Penambahan user gagal");
                    $('#submitAddUser').removeAttr('disabled');
                    $("#submitAddUser").empty();
                    $("#submitAddUser").append('Daftarkan');
                }
            }
        });
    });

});

function editUser(id){

    $('#formEditUser')[0].reset();
    
    $.ajax({
        url : base_url+"index.php/actions_admin/ajax_edit_user/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $.each(data, function(index, element) { 
                $('#id_user').val(element.id_user);
                $('#username').val(element.username);
                $('#nama').val(element.nama);
                $('#email').val(element.email);
                if(element.level=='admin'){
                    $("#radioAdmin").prop("checked",true);
                } else if(element.level=='adminRS') {
                    $("#radioAdminRS").prop("checked",true);
                } else {
                    $("#radioMember").prop("checked",true);
                }
    
    
                $('#modalEditUser').modal('show'); // show bootstrap modal when complete loaded
            });
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function deleteUser(id){
    swal({
        title: "Yakin akan menghapus user?",
        text: "User yang telah dihapus beserta reportnya akan hilang dari sistem",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, hapus user",
        cancelButtonText: "Tidak",
        closeOnConfirm: false,
        closeOnCancel: false },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "POST",
                url:  base_url+"index.php/actions_admin/delete_user/"+id,
                success: function(response) {
                    if (response == 'ok')
                    {
                        swal("Data berhasil dihapus", "Data user telah berhasil dihapus.", "success");
                        // $("#post-"+id).remove();
                        $('#tableUser').DataTable().row("#user-"+id).remove().draw(false);
                    }
                    else {
                        swal("Data user gagal dihapus", "Terjadi kesalahan saat penghapusan data report", "error");
                    }
                }
            });
        } else {
            swal("Dibatalkan", "Data user batal dihapus", "error");
        }
    });

}

function check_if_exists() {
    var username = $("#usernameA").val();
    $.ajax(
      {
          type:"post",
          url: base_url+"index.php/actions/username_check",
          data:{username:username},
          success:function(response)
          {
              if ((response == 'true') && username != '')
              {
                $("#usernameControl").addClass("has-success").removeClass("has-error");
                return true;
              }
              else
              {
                $("#usernameControl").addClass("has-error").removeClass("has-success");
                return false;
              }
          }
      });
}

function isValidEmailAddress() {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    var emailAddress = $("#emailA").val();
    var checkValid = pattern.test(emailAddress);
    if( !checkValid ) {
      $("#emailControl").addClass("has-error").removeClass("has-success");
      return false;
    } else {
      $("#emailControl").addClass("has-success").removeClass("has-error");
      return true;
    }
}

function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#password2").val();

    if ((password != confirmPassword) || (password=="") || (confirmPassword=="")){
        $("#passwordControl").addClass("has-error").removeClass("has-success");
        $("#passwordControl2").addClass("has-error").removeClass("has-success");
        return false;
    }
    else {
      $("#passwordControl").addClass("has-success").removeClass("has-error");
      $("#passwordControl2").addClass("has-success").removeClass("has-error");
      return true;
    }
}