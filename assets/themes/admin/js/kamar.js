$(document).ready(function () {
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

    var id_layanan = $('#id_layanan').val();

    var i=1;  

      $('#add').click(function(){  
           i++;
           var new_row = '<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="jenis_kamar[]" placeholder="Jenis/nama kamar" class="form-control jenis_list" required="" /></td><td><input type="number" name="sisa_kamar[]" placeholder="Sisa kamar" class="form-control sisa_list" required="" /></td><td><input type="number" name="total_kamar[]" placeholder="Total kamar" class="form-control toal_list" required="" /></td><input type="hidden" name="id_layanan[]" value="'+id_layanan+'"><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times"></i></button></td></tr>';  
           $('#input_kamar').append(new_row);  
           new_row.show(100);
      });

      $(document).on('click', '.btn_remove', function(){  
        var button_id = $(this).attr("id");   
        $('#row'+button_id+'').remove();  
      });
      
      $('#submitKamar').click(function(){
        $("#submitKamar").attr('disabled', 'disabled');
        $("#submitKamar").empty();
        $("#submitKamar").append("Menambahkan <i class='fa fa-circle-o-notch fa-spin'></i>");
        event.preventDefault();            
        $.ajax({  
             url: base_url + "index.php/actions_admin/add_kamar",  
             method:"POST",  
             data:$('#add_kamar').serialize(),
             type:'json',
             success:function(response)  
             {
                i=1;
                if (response == 'ok')
                {
                   $('.dynamic-added').remove();
                   $('#add_kamar')[0].reset();
                   $('#submitKamar').removeAttr('disabled');
                   $("#submitKamar").empty();
                   $("#submitKamar").append('Simpan');
                   toastr.success("Data kamar berhasil ditambahkan", "Penambahan data berhasil");
                   refreshKamar(id_layanan);
                } else {
                   $('#submitKamar').removeAttr('disabled');
                   $("#submitKamar").empty();
                   $("#submitKamar").append('Simpan');
                   toastr.error("Terjadi kesalahan", "Penambahan data gagal");
                }
             }  
        });  
    });

    $("#submitUpdateKamar").on('click', function(event) {
        $("#submitUpdateKamar").attr('disabled', 'disabled');
        $("#submitUpdateKamar").empty();
        $("#submitUpdateKamar").append("Memproses <i class='fa fa-circle-o-notch fa-spin'></i>");
        event.preventDefault();
        var id_layanan = $("#id_layanan_kamar").val();
        var id_kamar = $("#id_kamar").val();

        $.ajax({
            type: "POST",
            url: base_url + "index.php/actions_admin/update_kamar",
            data: $('#formEditKamar').serialize(),
            success: function(response) {
                if (response == 'ok')
                {
                    $('#formEditKamar')[0].reset();
                    $('#submitUpdateKamar').removeAttr('disabled');
                    $("#submitUpdateKamar").empty();
                    $("#submitUpdateKamar").append('Simpan');
                    toastr.success("Data kamar telah diperbaharui", "Update data berhasil");
                    $('#modalEditKamar').modal('hide');
                    refreshKamar(id_layanan);
                }
                else {
                    toastr.error("Terjadi kesalahan saat pemrosesan, coba lagi", "Update data gagal");
                    $('#submitUpdateKamar').removeAttr('disabled');
                    $("#submitUpdateKamar").empty();
                    $("#submitUpdateKamar").append('Simpan');
                }
            }
        });
    });

});

function refreshKamar(id){
    $('#kamar').empty();
    var kamar = "";
    $.ajax({
        url : base_url+"index.php/actions_admin/get_kamar/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('#kamar').empty();
            var no = 1;
            $.each(data, function(index, element) { 
                kamar += '<tr><td>'+no+'</td><td>'+data[index].jenis_kamar+'</td><td>'+data[index].sisa_kamar+'</td><td>'+data[index].total_kamar+'</td><td><button onclick="editKamar('+data[index].id_kamar+')" class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-pencil"></i></button><button onclick="deleteKamar('+data[index].id_kamar+','+data[index].id_layanan+')" class="btn btn-outline btn-danger dim" type="button"><i class="fa fa-trash"></i></button></td></tr>';
                no++;
            });
            $('#kamar').append(kamar);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function deleteKamar(id, id_layanan){
    swal({
        title: "Yakin akan menghapus kamar?",
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
                url:  base_url+"index.php/actions_admin/delete_kamar/"+id,
                success: function(response) {
                    if (response == 'ok')
                    {
                        swal("Data berhasil dihapus", "Data Kamar telah berhasil dihapus.", "success");
                        refreshKamar(id_layanan);
                    }
                    else {
                        swal("Data gagal dihapus", "Terjadi kesalahan saat penghapusan data kamar", "error");
                    }
                }
            });
        } else {
            swal("Dibatalkan", "Data kamar batal dihapus", "error");
        }
    });
}

function editKamar(id){

    $('#formEditKamar')[0].reset();
    
    $.ajax({
        url : base_url+"index.php/actions_admin/kamar_edit/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $.each(data, function(index, element) {

                $('#jenis').val(element.jenis_kamar);
                $('#sisa').val(element.sisa_kamar);
                $('#total').val(element.total_kamar);
                $('#id_kamar').val(element.id_kamar);
                $('#id_layanan_kamar').val(element.id_layanan);
    
    
                $('#modalEditKamar').modal('show'); // show bootstrap modal when complete loaded
            });
 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}