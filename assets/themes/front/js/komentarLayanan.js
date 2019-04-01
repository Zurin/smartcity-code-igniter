$(document).ready(function () {
    $("#submitKomentarLayanan").on('click', function() {
        $("#submitKomentarLayanan").attr('disabled', 'disabled');
        $("#submitKomentarLayanan").empty();
        $("#submitKomentarLayanan").append("Memproses <i class='fa fa-circle-o-notch fa-spin'></i>");
        event.preventDefault();
        var form = $('#formKomentarLayanan')[0];
        var id = $('#id_layanan').val();
        var formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: base_url + "index.php/actions/add_komentar_layanan",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response == 'ok')
                {
                    $("#formKomentarLayanan")[0].reset();
                    $(".notif-komen-layanan").append('<div class="alert alert-success alert-dismissible fade collapse show" role="alert"><strong>Sukses!</strong> Komentar Anda berhasil dikirim.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    $('#submitKomentarLayanan').removeAttr('disabled');
                    $("#submitKomentarLayanan").empty();
                    $("#submitKomentarLayanan").append('Kirim');
                    refreshKomentarLayanan(id);
                } 
                else {
                    $(".notif-komen-layanan").append('<div class="alert alert-danger alert-dismissible fade collapse show" role="alert"><strong>Gagal!</strong> Komentar gagal dikirim, terjadi kesalahan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    $('#submitKomentarLayanan').removeAttr('disabled');
                    $("#submitKomentarLayanan").empty();
                    $("#submitKomentarLayanan").append('Kirim');
                }
            }
        });
    });
});

function refreshKomentarLayanan(id){
    $('.comments-layanan-container').empty();
    var komentar = "";
    $.ajax({
        url : base_url+"index.php/actions/get_komentar_layanan/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('.comments-layanan-container').empty();
            $.each(data, function(index, element) { 
                komentar += '<div class="card"><div class="card-header bg-secondary"><small class="text-white">'+data[index].nama+'</small><small class="text-white pull-right"><i class="fa fa-calendar"></i> '+data[index].tgl_komentar+'</small></div><div class="card-body"><p class="card-text" align="justify"><small>'+data[index].isi_komentar+'</small></p></div></div><br>';
            });

            if(data != ''){
                $('.comments-layanan-container').append(komentar);
            } else {
                $('.comments-layanan-container').append('<p class="text-muted text-center">Belum ada komentar pada layanan ini.</p>'); 
            }
        },
        complete: function(){
            $('#comments-layanan-loader').addClass('d-none');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function checkFavLayanan(id_user, id_layanan){
    $('.fav-layanan-container').empty();
    $.ajax({
        url : base_url+"index.php/actions/get_fav_layanan/" + id_user + "/" + id_layanan,
        type: "GET",
        success: function(data)
        {
            if(data == 'TRUE'){
                $('.fav-layanan-container').html('<a href="" onclick="unFavLayanan('+id_user+', '+id_layanan+')"><i class="fa fa-star fa-2x text-warning"></i></a>');
            } else {
                $('.fav-layanan-container').html('<a href="" onclick="addFavLayanan('+id_user+', '+id_layanan+')"><i class="fa fa-star-o fa-2x text-warning"></i></a>');
            }
        },
    });
}

function addFavLayanan(id_user, id_layanan){
    event.preventDefault();
    $.ajax({
        url : base_url+"index.php/actions/add_fav_layanan/" + id_user + "/" + id_layanan,
        type: "GET",
        success: function(data)
        {
            $('.fav-layanan-container').empty();
            if(data == 'TRUE'){
                $('.fav-layanan-container').html('<a href="" onclick="unFavLayanan('+id_user+', '+id_layanan+')"><i class="fa fa-star fa-2x text-warning"></i></a>');
            } else {
                $('.fav-layanan-container').html('<a href="" onclick="addFavLayanan('+id_user+', '+id_layanan+')"><i class="fa fa-star-o fa-2x text-warning"></i></a>');
            }
        },
    });
}

function unFavLayanan(id_user, id_layanan){
    event.preventDefault();
    $.ajax({
        url : base_url+"index.php/actions/un_fav_layanan/" + id_user + "/" + id_layanan,
        type: "GET",
        success: function(data)
        {
            $('.fav-container').empty();
            if(data == 'TRUE'){
                $('.fav-layanan-container').html('<a href="" onclick="addFavLayanan('+id_user+', '+id_layanan+')"><i class="fa fa-star-o fa-2x text-warning"></i></a>');
            } else {
                $('.fav-layanan-container').html('<a href="" onclick="unFavLayanan('+id_user+', '+id_layanan+')"><i class="fa fa-star fa-2x text-warning"></i></a>');
            }
        },
    });
}

function refreshKamar(id){
    $('#data-kamar').empty();
    var kamar = "";
    $.ajax({
        url : base_url+"index.php/actions/get_kamar/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('#data-kamar').empty();
            $.each(data, function(index, element) { 
                kamar += '<tr><td><small>'+data[index].jenis_kamar+'</small></td><td><small>'+data[index].sisa_kamar+'</small></td><td><small>'+data[index].total_kamar+'</small></td></tr>';
            });
            $('#data-kamar').append(kamar);
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}