$(document).ready(function() {
    var tableReport = $('#tableReport').DataTable({
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

    $("#submitUpdateReport").click(function(event) {
        $("#submitUpdateReport").attr('disabled', 'disabled');
        $("#submitUpdateReport").empty();
        $("#submitUpdateReport").append("Mengupdate report <i class='fa fa-circle-o-notch fa-spin'></i>");
        event.preventDefault();
        var id_post = $("#id_post").val();
        var keterangan = $("#keterangan").val();
        var status = $("#status").val();
        var status_value = $('#status').find(":selected").text();
        var ditangani = $("#ditangani").val();

        $.ajax({
            type: "POST",
            url:  base_url+"index.php/actions_admin/update_report",
            data: {"id_post": id_post, "keterangan": keterangan, "status": status_value, "ditangani": ditangani},
            success: function(response) {
                if (response == 'ok')
                {
                    if(status=='waiting'){
                        $("#status-view-"+id_post).html("<span class='label label-danger'>waiting</span>");
                    } else if(status=='process'){
                        $("#status-view-"+id_post).html("<span class='label label-warning'>process</span>");
                    } else {
                        $("#status-view-"+id_post).html("<span class='label label-primary'>completed</span>");
                    }
                    toastr.success("Perubahan telah disimpan", "Update berhasil");
                    $('#submitUpdateReport').removeAttr('disabled');
                    $("#submitUpdateReport").empty();
                    $("#submitUpdateReport").append('Simpan');
                    $('#modalEditReport').modal('hide');
                }
                else {
                    toastr.error("Terjadi kesalahan", "Update gagal");
                    $('#submitUpdateReport').removeAttr('disabled');
                    $("#submitUpdateReport").empty();
                    $("#submitUpdateReport").append('Simpan');
                }
            }
        });
    });
});

function editReport(id){

    $('#formEditReport')[0].reset();
    
    $.ajax({
        url : base_url+"index.php/actions_admin/ajax_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $.each(data, function(index, element) { 
                $('#keterangan').val(element.keterangan);
                $('#id_post').val(element.id_post);
                $('#ditangani').val(element.ditangani_oleh);
                if(element.status=='waiting'){
                    $("#status option[value=waiting]").attr('selected','selected');
                } else if(element.status=='process'){
                    $("#status option[value=process]").attr('selected','selected');
                } else {
                    $("#status option[value=completed]").attr('selected','selected');
                }
    
    
                $('#modalEditReport').modal('show'); // show bootstrap modal when complete loaded
            });
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function deleteReport(id){
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
                url:  base_url+"index.php/actions_admin/delete_report/"+id,
                success: function(response) {
                    if (response == 'ok')
                    {
                        swal("Data berhasil dihapus", "Data report telah berhasil dihapus.", "success");
                        // $("#post-"+id).remove();
                        $('#tableReport').DataTable().row("#post-"+id).remove().draw(false);
                    }
                    else {
                        swal("Data gagal dihapus", "Terjadi kesalahan saat penghapusan data report", "error");
                    }
                }
            });
        } else {
            swal("Dibatalkan", "Data report batal dihapus", "error");
        }
    });

}

function refreshKomentar(id){
    var komentar = "";
    $.ajax({
        url : base_url+"index.php/actions_admin/get_komentar_report/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('#data-komentar').empty();
            var no = 1;
            $.each(data, function(index, element) { 
                komentar += '<tr><td>'+no+'</td><td>'+data[index].isi_komentar+'</td><td>'+data[index].tanggal_komentar+'</td><td>'+data[index].nama+'</td><td>'+data[index].username+'</td><td><button onclick="deleteKomentar('+data[index].id_komentar+','+data[index].id_post+')" class="btn btn-outline btn-danger dim" type="button"><i class="fa fa-trash"></i></button></td></tr>';
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

function deleteKomentar(id, id_report){
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
                url:  base_url+"index.php/actions_admin/delete_komentar_report/"+id,
                success: function(response) {
                    if (response == 'ok')
                    {
                        swal("Data berhasil dihapus", "Data komentar telah berhasil dihapus.", "success");
                        refreshKomentar(id_report);
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