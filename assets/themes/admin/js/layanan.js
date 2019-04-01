$(document).ready(function() {
    var tableLayanan = $('#tableLayanan').DataTable({
        "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    });

    function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
          }
    }

    $("#foto").change(function() {
          readURL(this);
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

    var submitButton = $("#submitAddLayanan").attr("disabled", true);
    $("#formAddLayanan input.required").change(function () {
            var valid = true;
            $.each($("#formAddLayanan input.required"), function (index, value) {
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
    });

    $("#submitAddLayanan").on('click', function() {
                $("#submitAddLayanan").attr('disabled', 'disabled');
                $("#submitAddLayanan").empty();
                $("#submitAddLayanan").append("Memproses <i class='fa fa-circle-o-notch fa-spin'></i>");
                event.preventDefault();
                var form = $('#formAddLayanan')[0];
                var formData = new FormData(form);

                $.ajax({
                    type: "POST",
                    url: base_url + "index.php/actions_admin/add_layanan",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response == 'ok')
                        {
                            $("#formAddLayanan")[0].reset();
                            
                            $('#preview').attr('src', base_url+'assets/themes/front/img/preview-icon.png');
                            $("#submitAddLayanan").empty();
                            $("#submitAddLayanan").append('Tambah Layanan');
                            toastr.success("Data layanan kesehatan publik telah ditambahkan", "Penambahan data berhasil");
                            setTimeout(function(){// wait for 5 secs(2)
                                location.reload(); // then reload the page.(3)
                            }, 3000);
                        } 
                        else if(response == 'upload fail'){
                            toastr.error("Data layanan kesehatan publik gagal ditambahkan", "Upload foto gagal");
                            $('#submitAddLayanan').removeAttr('disabled');
                            $("#submitAddLayanan").empty();
                            $("#submitAddLayanan").append('Tambah Layanan');
                        }
                        else {
                            toastr.error("Terjadi kesalahan saat memproses, coba lagi", "Penambahan data gagal");
                            $('#submitAddLayanan').removeAttr('disabled');
                            $("#submitAddLayanan").empty();
                            $("#submitAddLayanan").append('Tambah Layanan');
                        }
                    }
                });
    });

    $("#submitUpdateLayanan").on('click', function(event) {
        $("#submitUpdateLayanan").attr('disabled', 'disabled');
        $("#submitUpdateLayanan").empty();
        $("#submitUpdateLayanan").append("Memproses <i class='fa fa-circle-o-notch fa-spin'></i>");
        event.preventDefault();
        var id_layanan = $("#id_layanan").val();
        var foto = $("#foto").val();
        var deskripsi = $("#deskripsi").val();
        var form = $('#formEditLayanan')[0];
        var formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: base_url + "index.php/actions_admin/update_layanan",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response == 'ok')
                {
                    deskripsi_fix = deskripsi.replace(/(?:\r\n|\r|\n)/g, "<br><br>");
                    $("#deskripsi-"+id_layanan).html("<p align='justify'>"+deskripsi_fix+"</p>");
                    if(foto != ""){
                        $('#href-img-'+id_layanan).removeAttr('href');
                        $('#img-'+id_layanan).removeAttr('src');
                        var foto_fix = foto.replace(/^C:\\fakepath\\/, "");
                        $('#href-img-'+id_layanan).attr('href', base_url+'assets/themes/front/img/photos/'+foto_fix);
                        $('#img-'+id_layanan).attr('src', base_url+'assets/themes/front/img/photos/'+foto_fix);
                    }
                    $('#submitUpdateLayanan').removeAttr('disabled');
                    $("#submitUpdateLayanan").empty();
                    $("#submitUpdateLayanan").append('Simpan');
                    toastr.success("Data layanan kesehatan publik telah diperbaharui", "Update data berhasil");
                    $('#modalEditLayanan').modal('hide');
                } 
                else if(response == 'upload fail'){
                    toastr.error("Data layanan kesehatan publik gagal diperbaharui", "Upload foto gagal");
                    $('#submitUpdateLayanan').removeAttr('disabled');
                    $("#submitUpdateLayanan").empty();
                    $("#submitUpdateLayanan").append('Simpan');
                }
                else {
                    toastr.error("Terjadi kesalahan saat memproses, coba lagi", "Update data gagal");
                    $('#submitUpdateLayanan').removeAttr('disabled');
                    $("#submitUpdateLayanan").empty();
                    $("#submitUpdateLayanan").append('Simpan');
                }
            }
        });
    });

});

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
}

function editLayanan(id){

    $('#formEditLayanan')[0].reset();
    $('#preview').removeAttr('src');
    
    $.ajax({
        url : base_url+"index.php/actions_admin/ajax_edit_layanan/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $.each(data, function(index, element) { 
                $('#deskripsi').val(element.deskripsi);
                $('#preview').attr('src', base_url+'assets/themes/front/img/photos/'+element.foto);
                $('#id_layanan').val(element.id_layanan);
    
    
                $('#modalEditLayanan').modal('show'); // show bootstrap modal when complete loaded
            });
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function deleteLayanan(id){
    swal({
        title: "Yakin akan menghapus data?",
        text: "Data yang telah terhapus tidak akan bisa dikembalikan lagi",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, hapus data",
        cancelButtonText: "Tidak, batalkan penghapusan",
        closeOnConfirm: false,
        closeOnCancel: false },
    function (isConfirm) {
        if (isConfirm) {
            $.ajax({
                type: "POST",
                url:  base_url+"index.php/actions_admin/delete_layanan/"+id,
                success: function(response) {
                    if (response == 'ok')
                    {
                        swal("Data berhasil dihapus", "Data layanan telah berhasil dihapus.", "success");
                        // $("#post-"+id).remove();
                        $('#tableLayanan').DataTable().row("#post-"+id).remove().draw(false);
                    }
                    else {
                        swal("Data gagal dihapus", "Terjadi kesalahan saat penghapusan data layanan", "error");
                    }
                }
            });
        } else {
            swal("Dibatalkan", "Data layanan batal dihapus", "error");
        }
    });

}

function refreshKomentar(id){
    var komentar = "";
    $.ajax({
        url : base_url+"index.php/actions_admin/get_komentar_layanan/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('#data-komentar').empty();
            var no = 1;
            $.each(data, function(index, element) { 
                komentar += '<tr><td>'+no+'</td><td>'+data[index].isi_komentar+'</td><td>'+data[index].tanggal_komentar+'</td><td>'+data[index].nama+'</td><td>'+data[index].username+'</td><td><button onclick="deleteKomentar('+data[index].id_komentar_layanan+','+data[index].id_layanan+')" class="btn btn-outline btn-danger dim" type="button"><i class="fa fa-trash"></i></button></td></tr>';
                no++;
            });
            $('#data-komentar').append(komentar);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function deleteKomentar(id, id_layanan){
    swal({
        title: "Yakin akan menghapus komentar?",
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
                url:  base_url+"index.php/actions_admin/delete_komentar_layanan/"+id,
                success: function(response) {
                    if (response == 'ok')
                    {
                        swal("Data berhasil dihapus", "Data komentar telah berhasil dihapus.", "success");
                        refreshKomentar(id_layanan);
                    }
                    else {
                        swal("Data gagal dihapus", "Terjadi kesalahan saat penghapusan data komentar", "error");
                    }
                }
            });
        } else {
            swal("Dibatalkan", "Data komentar batal dihapus", "error");
        }
    });
}
  

