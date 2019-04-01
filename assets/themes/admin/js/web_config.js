$(document).ready(function() {

    function readURL(input, id) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $(id).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
    }

    $("#brand").change(function() {
          readURL(this, '#preview-brand');
    });

    $("#favicon").change(function() {
        readURL(this, '#preview-favicon');
    });

    $("#icon").change(function() {
        readURL(this, '#preview-icon-socmed');
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

    $("#submitConfig").on('click', function(event) {
        $("#submitConfig").attr('disabled', 'disabled');
        $("#submitConfig").empty();
        $("#submitConfig").append("Memproses <i class='fa fa-circle-o-notch fa-spin'></i>");
        event.preventDefault();
        var id = $("#id").val();
        var judul = $("#judul").val();
        var brand = $("#brand").val();
        var favicon = $("#favicon").val();
        var about = $("#about").val();
        var form = $('#formConfig')[0];
        var formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: base_url + "index.php/actions_admin/config_web",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response == 'ok')
                {
                    $("#judul-data").html(judul);
                    about_fix = about.replace(/(?:\r\n|\r|\n)/g, "<br><br>");
                    $("#about-data").html(about_fix);

                    if(brand != ""){
                        $('#pop-up').removeAttr('href');
                        $('#thumb-img').removeAttr('src');
                        var brand_fix = brand.replace(/^C:\\fakepath\\/, "");
                        $('#pop-up').attr('href', base_url+'assets/themes/front/img/brand/'+brand_fix);
                        $('#thumb-img').attr('src', base_url+'assets/themes/front/img/brand/'+brand_fix);
                    }

                    if(favicon != ""){
                        $('#fav-up').removeAttr('href');
                        $('#fav-img').removeAttr('src');
                        var favicon_fix = favicon.replace(/^C:\\fakepath\\/, "");
                        $('#fav-up').attr('href', base_url+'assets/themes/front/img/brand/'+favicon_fix);
                        $('#fav-img').attr('src', base_url+'assets/themes/front/img/brand/'+favicon_fix);
                    }

                    $('#submitConfig').removeAttr('disabled');
                    $("#submitConfig").empty();
                    $("#submitConfig").append('Simpan');
                    toastr.success("Data konfigurasi telah tersimpan", "Pengubahan telah tersimpan");
                    $('#modalEditConfig').modal('hide');
                } 
                else if(response == 'upload fail'){
                    toastr.error("Data gagal diubah", "Upload foto gagal");
                    $('#submitConfig').removeAttr('disabled');
                    $("#submitConfig").empty();
                    $("#submitConfig").append('Simpan');
                }
                else {
                    toastr.error("Terjadi kesalahan saat memproses, coba lagi", "Penyimpanan data gagal");
                    $('#submitConfig').removeAttr('disabled');
                    $("#submitConfig").empty();
                    $("#submitConfig").append('Simpan');
                }
            }
        });
    });

    $("#submitAddSocmed").on('click', function(event) {
        $("#submitAddSocmed").attr('disabled', 'disabled');
        $("#submitAddSocmed").empty();
        $("#submitAddSocmed").append("Memproses <i class='fa fa-circle-o-notch fa-spin'></i>");
        event.preventDefault();
        var form = $('#formAddSocmed')[0];
        var formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: base_url + "index.php/actions_admin/add_socmed",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response == 'ok')
                {
                    $('#submitAddSocmed').removeAttr('disabled');
                    $("#submitAddSocmed").empty();
                    $("#submitAddSocmed").append('Simpan');
                    toastr.success("Data sosmed telah tersimpan", "Penambahan data sosmed berhasil");
                    $('#modalAddSocmed').modal('hide');
                    form.reset();
                    refreshSocmed();
                } 
                else if(response == 'upload fail'){
                    toastr.error("Data gagal ditmabahkan", "Upload foto gagal");
                    $("#submitAddSocmed").empty();
                    $('#submitAddSocmed').removeAttr('disabled');
                    $("#submitAddSocmed").append('Simpan');
                }
                else {
                    toastr.error("Terjadi kesalahan saat memproses, coba lagi", "Penyimpanan data gagal");
                    $("#submitAddSocmed").empty();
                    $('#submitAddSocmed').removeAttr('disabled');
                    $("#submitAddSocmed").append('Simpan');
                }
            }
        });
    });

    $("#submitUpdateSocmed").on('click', function(event) {
        $("#submitUpdateSocmed").attr('disabled', 'disabled');
        $("#submitUpdateSocmed").empty();
        $("#submitUpdateSocmed").append("Memproses <i class='fa fa-circle-o-notch fa-spin'></i>");
        event.preventDefault();
        var form = $('#formUpdateSocmed')[0];
        var formData = new FormData(form);
        var id = $('#id_sosmed').val();

        $.ajax({
            type: "POST",
            url: base_url + "index.php/actions_admin/update_socmed",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response == 'ok')
                {
                    $('#submitUpdateSocmed').removeAttr('disabled');
                    $("#submitUpdateSocmed").empty();
                    $("#submitUpdateSocmed").append('Update');
                    toastr.success("Data sosmed berhasil diperbaharui", "Pembaharuan data berhasil");
                    $('#modalEditSocmed').modal('hide');
                    refreshSocmed();
                } 
                else if(response == 'upload fail'){
                    toastr.error("Data gagal diperbaharui", "Upload foto gagal");
                    $("#submitUpdateSocmed").empty();
                    $('#submitUpdateSocmed').removeAttr('disabled');
                    $("#submitUpdateSocmed").append('Update');
                }
                else {
                    toastr.error("Terjadi kesalahan saat memproses, coba lagi", "Pembaharuan data gagal");
                    $("#submitUpdateSocmed").empty();
                    $('#submitUpdateSocmed').removeAttr('disabled');
                    $("#submitUpdateSocmed").append('Update');
                }
            }
        });
    });

});

function editConfig(id){
    $('#formEditLayanan')[0].reset();
    $('#preview').removeAttr('src');
    
    $.ajax({
        url : base_url+"index.php/actions_admin/ajax_edit_config/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $.each(data, function(index, element) { 
                $('#judul').val(element.judul_web);
                $('#preview-brand').attr('src', base_url+'assets/themes/front/img/brand/'+element.brand);
                $('#preview-favicon').attr('src', base_url+'assets/themes/front/img/brand/'+element.favicon);
                $('#about').val(element.about);
                $('#id').val(element.id);
    
    
                $('#modalEditConfig').modal('show'); // show bootstrap modal when complete loaded
            });
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function editSocmed(id){
    $('#formUpdateSocmed')[0].reset();
    
    $.ajax({
        url : base_url+"index.php/actions_admin/ajax_edit_socmed/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $.each(data, function(index, element) { 
                $('#url_edit').val(element.url);
                $('#id_sosmed').val(element.id_sosmed);
                $("#fa_sosmed_edit option[value='"+element.fa_sosmed+"']").attr('selected','selected');
    
                $('#modalEditSocmed').modal('show'); // show bootstrap modal when complete loaded
            });
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function deleteSocmed(id){
    swal({
        title: "Yakin akan menghapus data sosial media?",
        text: "Data yang telah terhapus tidak akan bisa dikembalikan lagi",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, hapus data",
        cancelButtonText: "Tidak, batalkan",
        closeOnConfirm: false,
        closeOnCancel: false },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "POST",
                url:  base_url+"index.php/actions_admin/delete_socmed/"+id,
                success: function(response) {
                    if (response == 'ok')
                    {
                        swal("Data berhasil dihapus", "Data sosial media telah berhasil dihapus.", "success");
                        refreshSocmed();
                    }
                    else {
                        swal("Data gagal dihapus", "Terjadi kesalahan saat penghapusan data sosial media", "error");
                    }
                }
            });
        } else {
            swal("Dibatalkan", "Data sosial media batal dihapus", "error");
        }
    });
}

function refreshSocmed(){
    var socmed = "";
    $.ajax({
        url : base_url+"index.php/actions_admin/get_data_socmed/",
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('#data-socmed').empty();
            var no = 1;
            $.each(data, function(index, element) { 
                socmed += '<tr><td>'+no+'</td><td style="font-size: 32px;"><i class="'+data[index].fa_sosmed+'"></i></td><td><a href="'+data[index].url+'" target="_blank">'+data[index].url+'</a></td><td><button id="btnEdit" onclick="editSocmed('+data[index].id_sosmed+')" class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-pencil"></i></button><button id="btnDelete" onclick="deleteSocmed('+data[index].id_sosmed+')" class="btn btn-outline btn-danger dim" type="button"><i class="fa fa-trash"></i></button></td></tr>';
                no++;
            });
            $('#data-socmed').append(socmed);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}