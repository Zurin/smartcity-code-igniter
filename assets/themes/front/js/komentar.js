$(document).ready(function () {
    $("#submitKomentar").on('click', function() {
        $("#submitKomentar").attr('disabled', 'disabled');
        $("#submitKomentar").empty();
        $("#submitKomentar").append("Memproses <i class='fa fa-circle-o-notch fa-spin'></i>");
        event.preventDefault();
        var form = $('#formKomentar')[0];
        var id = $('#id_post').val();
        var formData = new FormData(form);

        $.ajax({
            type: "POST",
            url: base_url + "index.php/actions/add_komentar",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response == 'ok')
                {
                    $("#formKomentar")[0].reset();
                    $(".notif-komen").append('<div class="alert alert-success alert-dismissible fade collapse show" role="alert"><strong>Sukses!</strong> Komentar Anda berhasil dikirim.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    $('#submitKomentar').removeAttr('disabled');
                    $("#submitKomentar").empty();
                    $("#submitKomentar").append('Kirim');
                    refreshKomentar(id);
                } 
                else {
                    $(".notif-komen").append('<div class="alert alert-danger alert-dismissible fade collapse show" role="alert"><strong>Gagal!</strong> Komentar gagal dikirim, terjadi kesalahan.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    $('#submitKomentar').removeAttr('disabled');
                    $("#submitKomentar").empty();
                    $("#submitKomentar").append('Kirim');
                }
            }
        });
    });
});

function refreshKomentar(id){
    $('.comments-container').empty();
    var komentar = "";
    $.ajax({
        url : base_url+"index.php/actions/get_komentar/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('.comments-container').empty();
            $.each(data, function(index, element) { 
                komentar += '<div class="card"><div class="card-header bg-secondary"><small class="text-white">'+data[index].nama+'</small><small class="text-white pull-right"><i class="fa fa-calendar"></i> '+data[index].tgl_komentar+'</small></div><div class="card-body"><p class="card-text" align="justify"><small>'+data[index].isi_komentar+'</small></p></div></div><br>';
            });

            if(data != ''){
                $('.comments-container').append(komentar);
            } else {
                $('.comments-container').append('<p class="text-muted text-center">Belum ada komentar pada report ini.</p>'); 
            }
        },
        complete: function(){
            $('#comments-loader').addClass('d-none');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function checkFav(id_user, id_post){
    $('.fav-container').empty();
    $.ajax({
        url : base_url+"index.php/actions/get_fav/" + id_user + "/" + id_post,
        type: "GET",
        success: function(data)
        {
            if(data == 'TRUE'){
                $('.fav-container').html('<a href="" onclick="unFav('+id_user+', '+id_post+')"><i class="fa fa-star fa-2x text-warning"></i></a>');
            } else {
                $('.fav-container').html('<a href="" onclick="addFav('+id_user+', '+id_post+')"><i class="fa fa-star-o fa-2x text-warning"></i></a>');
            }
        },
    });
}

function addFav(id_user, id_post){
    event.preventDefault();
    $.ajax({
        url : base_url+"index.php/actions/add_fav/" + id_user + "/" + id_post,
        type: "GET",
        success: function(data)
        {
            $('.fav-container').empty();
            if(data == 'TRUE'){
                $('.fav-container').html('<a href="" onclick="unFav('+id_user+', '+id_post+')"><i class="fa fa-star fa-2x text-warning"></i></a>');
            } else {
                $('.fav-container').html('<a href="" onclick="addFav('+id_user+', '+id_post+')"><i class="fa fa-star-o fa-2x text-warning"></i></a>');
            }
        },
    });
}

function unFav(id_user, id_post){
    event.preventDefault();
    $.ajax({
        url : base_url+"index.php/actions/un_fav/" + id_user + "/" + id_post,
        type: "GET",
        success: function(data)
        {
            $('.fav-container').empty();
            if(data == 'TRUE'){
                $('.fav-container').html('<a href="" onclick="addFav('+id_user+', '+id_post+')"><i class="fa fa-star-o fa-2x text-warning"></i></a>');
            } else {
                $('.fav-container').html('<a href="" onclick="unFav('+id_user+', '+id_post+')"><i class="fa fa-star fa-2x text-warning"></i></a>');
            }
        },
    });
}