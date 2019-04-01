<?php
require APPPATH.'/libraries/REST_Controller.php';
date_default_timezone_set('Asia/Jakarta');

class API extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('db_model');
        $this->user = $this->session->userdata('login');
    }

    function index_get() {
      echo "Welcome to Smart City Web Service";
    }

    function login_post() {
        $this->load->model('login_model');
        $result = $this->login_model->login_method();

        if($result == FALSE){
          $data['status']=502;
          $data['message']='Login gagal';
          $this->response($data, 200);
        } else {
          $user = $this->session->userdata('login');
          $data_user = $this->db_model->get_where('tb_user', 'id_user', $user['id_user']);
          $avatar_check = $data_user[0]->avatar;
          if ($avatar_check==NULL) {
            $avatar = "kosong";
          } else {
            $avatar = base_url()."assets/themes/front/img/avatar/".$data_user[0]->avatar;
          }
          $data['data']= array(
            'id_user' => $data_user[0]->id_user,
            'username' => $data_user[0]->username,
            'password' => $data_user[0]->password,
            'nama' => $data_user[0]->nama,
            'email' => $data_user[0]->email,
            'gender' => $data_user[0]->gender,
            'tgl_lahir' => $data_user[0]->tgl_lahir,
            'avatar' => $avatar
          );
          $data['status']=200;
          $data['message']='Login sukses';
          $this->response($data, 200); 
        }
    }

    function register_post(){
      $nama = $this->post('nama');
      $username = $this->post('username');
      $password1 = $this->post('password1');
      $password2 = $this->post('password2');
      $gender = $this->post('gender');
      $email = $this->post('email');
      $tgl_lahir = $this->post('tgl_lahir');
      $password_sha1 = sha1($password1);
      $options = [
		    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
		  ];
      $password = password_hash($password_sha1, PASSWORD_DEFAULT, $options);
      $username = $this->input->post('username', TRUE);
      
      $ada = $this->db_model->username_check($username);

      $count = count($ada);
        
      if ($count>0){
        $data['status']=502;
        $data['message']='Registrasi gagal, username sudah digunakan';
        $this->response($data, 200);
      } else {
        $add_user = array(
          'nama' => $nama,
          'username' => $username,
          'password' => $password,
          'email' => $email,
          'gender' => $gender,
          'tgl_lahir' => $tgl_lahir,
        );
        if ($password1 == $password2) {
          $insert = $this->db_model->insert('tb_user', $add_user);
          $data['status']=200;
          $data['message']='Registrasi sukses';
          $this->response($data, 200);
        } else {
          $data['status']=502;
          $data['message']='Registrasi gagal, password tidak cocok';
          $this->response($data, 200);
        }
      }
    }

    function report_post(){
        $config['upload_path']="./assets/themes/front/img/photos";
        $config['allowed_types']='gif|jpg|png';
        $this->load->library('upload',$config);
        if($this->upload->do_upload("foto")){
            $nama_file = $this->upload->data('file_name');
            $data = array('upload_data' => $this->upload->data());
            $lat = $this->input->post('lat');
            $long = $this->input->post('long');
            $data1 = array(
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'foto' => $nama_file,
                'latitude' => $lat,
                'longitude' => $long,
                'lokasi' => $this->input->post('lokasi'),
                'id_sub_kejadian' => $this->input->post('sub_kejadian'),
                'id_user' => $this->input->post('id_user')
            );
            $result= $this->db_model->insert('tb_post', $data1);
            if ($result == TRUE) {
              $data['status']=200;
              $data['message']='Report Anda berhasil di submit';
              $this->response($data, 200);
            } else {
              $data['status']=502;
              $data['message']='Report gagal di submit';
              $this->response($data, 200);
            }
        } else {
          $data['status']=502;
          $data['message']='Foto gagal diupload, report gagal di submit';
          $this->response($data, 200);
        }
    }

    function report_get(){
        $query = $this->db_model->get_data_report();
        $row = array();
        $i = 0;
        foreach ($query as $key => $value) {
            $arr['id_post'] = $value->id_post;
            $arr['deskripsi'] = $value->deskripsi;
            $arr['direktori_foto'] = base_url()."assets/themes/front/img/photos/".$value->foto;
            $arr['tgl_post'] = date("d M Y H:i A", strtotime($value->tgl_post));
            $arr['latitude'] = $value->latitude;
            $arr['longitude'] = $value->longitude;
            $arr['kategori_kejadian'] = $value->id_kejadian;
            $arr['sub_kategori_kejadian'] = $value->id_sub_kejadian;
            $arr['nama_pengepos'] = $value->nama;
            
            if ($value->avatar==NULL) {
              $avatar = "kosong";
            } else {
              $avatar = base_url()."assets/themes/front/img/avatar/".$value->avatar;
            }
  
            $arr['avatar'] = $avatar;

            $arr['jumlah_komentar'] = count($this->db_model->get_where('tb_komentar', 'id_post', $value->id_post));
            $arr['jumlah_favorite'] = count($this->db_model->get_where('tb_favorite', 'id_post', $value->id_post));
            
            $row[$i]=$arr;
            $i++;
        }
        if ($query) {
          $data['data'] = array(
            'jumlah_report' => count($query),
            'dataPost' => $row
          );
          $data['status']=200;
          $data['message']='Fetch data report sukses';
          $this->response($data, 200);
        } else {
          $data['status']=502;
          $data['message']='Fetch data report gagal';
          $this->response($data, 200);
        }
    }

  function report_user_get(){
      $id_user = $this->input->get('id_user');
      $query = $this->db_model->get_data_report_user($id_user);
      $row = array();
      $i = 0;
      foreach ($query as $key => $value) {
          $arr['id_post'] = $value->id_post;
          $arr['deskripsi'] = $value->deskripsi;
          $arr['direktori_foto'] = base_url()."assets/themes/front/img/photos/".$value->foto;
          $arr['tgl_post'] = date("d M Y H:i A", strtotime($value->tgl_post));
          $arr['latitude'] = $value->latitude;
          $arr['longitude'] = $value->longitude;
          $arr['kategori_kejadian'] = $value->id_kejadian;
          $arr['sub_kategori_kejadian'] = $value->id_sub_kejadian;
          $arr['nama_pengepos'] = $value->nama;

          if ($value->avatar==NULL) {
            $avatar = "kosong";
          } else {
            $avatar = base_url()."assets/themes/front/img/avatar/".$value->avatar;
          }

          $arr['avatar'] = $avatar;

          $arr['jumlah_komentar'] = count($this->db_model->get_where('tb_komentar', 'id_post', $value->id_post));
          $arr['jumlah_favorite'] = count($this->db_model->get_where('tb_favorite', 'id_post', $value->id_post));
          
          $row[$i]=$arr;
          $i++;
      }
      if ($query) {
        $data['data'] = array(
          'jumlah_report' => count($query),
          'dataPost' => $row
        );
        $data['status']=200;
        $data['message']='Fetch data report sukses';
        $this->response($data, 200);
      } else {
        $data['status']=502;
        $data['message']='Fetch data report gagal';
        $this->response($data, 200);
      }
  }

  function report_by_kategori_get(){
    $id = $this->input->get('id_sub_kategori');
    $query = $this->db_model->get_data_report_by_kategori($id);
    $row = array();
    $i = 0;
    foreach ($query as $key => $value) {
        $arr['id_post'] = $value->id_post;
        $arr['deskripsi'] = $value->deskripsi;
        $arr['direktori_foto'] = base_url()."assets/themes/front/img/photos/".$value->foto;
        $arr['tgl_post'] = date("d M Y H:i A", strtotime($value->tgl_post));
        $arr['latitude'] = $value->latitude;
        $arr['longitude'] = $value->longitude;
        $arr['kategori_kejadian'] = $value->id_kejadian;
        $arr['sub_kategori_kejadian'] = $value->id_sub_kejadian;
        $arr['nama_pengepos'] = $value->nama;
        
        if ($value->avatar==NULL) {
          $avatar = "kosong";
        } else {
          $avatar = base_url()."assets/themes/front/img/avatar/".$value->avatar;
        }

        $arr['avatar'] = $avatar;

        $arr['jumlah_komentar'] = count($this->db_model->get_where('tb_komentar', 'id_post', $value->id_post));
        $arr['jumlah_favorite'] = count($this->db_model->get_where('tb_favorite', 'id_post', $value->id_post));
        
        $row[$i]=$arr;
        $i++;
    }
    if ($query) {
      $data['data'] = array(
        'jumlah_report' => count($query),
        'dataPost' => $row
      );
      $data['status']=200;
      $data['message']='Fetch data report sukses';
      $this->response($data, 200);
    } else {
      $data['status']=502;
      $data['message']='Fetch data report gagal';
      $this->response($data, 200);
    }
  }

  function report_by_status_get(){
    $status = $this->input->get('status');
    $query = $this->db_model->get_data_report_by_status($status);
    $row = array();
    $i = 0;
    foreach ($query as $key => $value) {
        $arr['id_post'] = $value->id_post;
        $arr['deskripsi'] = $value->deskripsi;
        $arr['direktori_foto'] = base_url()."assets/themes/front/img/photos/".$value->foto;
        $arr['tgl_post'] = date("d M Y H:i A", strtotime($value->tgl_post));
        $arr['latitude'] = $value->latitude;
        $arr['longitude'] = $value->longitude;
        $arr['kategori_kejadian'] = $value->id_kejadian;
        $arr['sub_kategori_kejadian'] = $value->id_sub_kejadian;
        $arr['nama_pengepos'] = $value->nama;
        
        if ($value->avatar==NULL) {
          $avatar = "kosong";
        } else {
          $avatar = base_url()."assets/themes/front/img/avatar/".$value->avatar;
        }

        $arr['avatar'] = $avatar;

        $arr['jumlah_komentar'] = count($this->db_model->get_where('tb_komentar', 'id_post', $value->id_post));
        $arr['jumlah_favorite'] = count($this->db_model->get_where('tb_favorite', 'id_post', $value->id_post));
        
        $row[$i]=$arr;
        $i++;
    }
    if ($query) {
      $data['data'] = array(
        'jumlah_report' => count($query),
        'dataPost' => $row
      );
      $data['status']=200;
      $data['message']='Fetch data report sukses';
      $this->response($data, 200);
    } else {
      $data['status']=502;
      $data['message']='Fetch data report gagal';
      $this->response($data, 200);
    }
  }

  function report_detail_get(){
      $id = $this->input->get('id');
      $query = $this->db_model->get_data_report_detail($id);
      if ((count($query)) < 1) {
        $data['status']=502;
        $data['message']='Data tidak ditemukan';
        $this->response($data, 200);
      } else if ($query) {

        if ($query[0]->avatar==NULL) {
          $avatar = "kosong";
        } else {
          $avatar = base_url()."assets/themes/front/img/avatar/".$query[0]->avatar;
        }

        $detail_report = array(
          'id_post' => $query[0]->id_post,
          'deskripsi' => $query[0]->deskripsi,
          'status' => $query[0]->status,
          'keterangan' => $query[0]->keterangan,
          'direktori_foto' => base_url()."assets/themes/front/img/photos/".$query[0]->foto,
          'ditangani_oleh' => $query[0]->ditangani_oleh,
          'tgl_post' => date("d M Y H:i A", strtotime($query[0]->tgl_post)),
          'tgl_status_berubah' => $query[0]->tgl_status,
          'latitude' => $query[0]->latitude,
          'longitude' => $query[0]->longitude,
          'id_kejadian' => $query[0]->id_kejadian,
          'kategori_kejadian' => $query[0]->nama_kejadian,
          'icon_kategori' => base_url()."assets/themes/front/img/marker/".$query[0]->icon,
          'id_sub_kejadian' => $query[0]->id_sub_kejadian,
          'sub_kategori_kejadian' => $query[0]->nama_sub_kejadian,
          'nama_pengepos' => $query[0]->nama,
          'avatar' => $avatar
        );
        $data['data']=$detail_report;
        $data['status']=200;
        $data['message']='Fetch data report sukses';
        $this->response($data, 200);
      } else {
        $data['status']=502;
        $data['message']='Fetch data report gagal';
        $this->response($data, 200);
      }
  }

  function update_user_post(){
    $id_user = $this->input->post('id_user');
    $get_user = $this->db_model->get_where('tb_user', 'id_user', $id_user);
    $db_password = $get_user[0]->password;
    $password_lama = $this->input->post('password_lama');
    $password_baru = $this->input->post('password_baru');

    $password_sha1 = sha1($password_baru);
    $options = [
      'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
    ];
    $password = password_hash($password_sha1, PASSWORD_DEFAULT, $options);

      if(isset($_FILES['avatar'])){
        $config['upload_path']="./assets/themes/front/img/avatar";
        $config['allowed_types']='gif|jpg|png';
        $this->load->library('upload',$config);
        if($this->upload->do_upload("avatar")){
          $nama_file = $this->upload->data('file_name');
          $data_img = array('upload_data' => $this->upload->data());
          if ($password_baru == NULL) {
            $data_user = array(
              'nama' => $this->input->post('nama', TRUE),
              'email' => $this->input->post('email', TRUE),
              'gender' => $this->input->post('gender'),
              'tgl_lahir' => $this->input->post('tgl_lahir'),
              'avatar' => $nama_file,
            );
          } else {
            if(password_verify(sha1($password_lama), $db_password)){
              $data_user = array(
                'nama' => $this->input->post('nama', TRUE),
                'email' => $this->input->post('email', TRUE),
                'gender' => $this->input->post('gender'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'avatar' => $nama_file,
                'password' => $password
              );
            } else {
              $data['status']=502;
              $data['message']='Password lama salah, gagal memperbaharui data';
              $this->response($data, 200);
            }
          }
        } else {
          $data['status']=502;
          $data['message']='Avatar gagal diupload, gagal memperbaharui data pengguna';
          $this->response($data, 200);
        }
      } else {
        if ($password_baru == NULL) {
          $data_user = array(
            'nama' => $this->input->post('nama', TRUE),
            'email' => $this->input->post('email', TRUE),
            'gender' => $this->input->post('gender'),
            'tgl_lahir' => $this->input->post('tgl_lahir')
          );
        } else {
          if(password_verify(sha1($password_lama), $db_password)){
            $data_user = array(
              'nama' => $this->input->post('nama', TRUE),
              'email' => $this->input->post('email', TRUE),
              'gender' => $this->input->post('gender'),
              'tgl_lahir' => $this->input->post('tgl_lahir'),
              'password' => $password
            );
          } else {
            $data['status']=502;
            $data['message']='Password lama salah, gagal memperbaharui data';
            $this->response($data, 200);
          }
        }
      }
      $result= $this->db_model->update('tb_user', 'id_user', $id_user, $data_user);
      if ($result == TRUE) {
          $data['status']=200;
          $data['message']='Data user berhasil diperbaharui';
          $this->response($data, 200);
      } else {
          $data['status']=502;
          $data['message']='Data user gagal diperbaharui';
          $this->response($data, 200);
      }
    
  }

  function user_data_get(){
    $id_user = $this->input->get('id_user');
    $data_user = $this->db_model->get_where('tb_user', 'id_user', $id_user);
    if ($data_user) {
      $avatar_check = $data_user[0]->avatar;
      if ($avatar_check==NULL) {
        $avatar = "kosong";
      } else {
        $avatar = base_url()."assets/themes/front/img/avatar/".$data_user[0]->avatar;
      }
      $data['data']= array(
        'id_user' => $data_user[0]->id_user,
        'username' => $data_user[0]->username,
        'password' => $data_user[0]->password,
        'nama' => $data_user[0]->nama,
        'email' => $data_user[0]->email,
        'gender' => $data_user[0]->gender,
        'tgl_lahir' => $data_user[0]->tgl_lahir,
        'avatar' => $avatar
      );
      $data['status']=200;
      $data['message']='Data user berhasil diambil';
      $this->response($data, 200); 
    } else {
      $data['status']=502;
      $data['message']='Fetch data user gagal';
      $this->response($data, 200);
    }    
  }

  function kategori_get(){
    $query = $this->db_model->get_data('tb_kejadian');
    $row = array();
    $i = 0;
    foreach ($query as $key => $value) {
        $arr['id_kategori'] = $value->id_kejadian;
        $arr['nama_kategori'] = $value->nama_kejadian;
        $arr['icon_kategori'] = base_url()."assets/themes/front/img/marker/".$value->icon;
        
        $row[$i]=$arr;
        $i++;
    }
    if ($query) {
      $data['data'] = array(
        'jumlah_kategori' => count($query),
        'dataKategori' => $row
      );
      $data['status']=200;
      $data['message']='Fetch data kategori sukses';
      $this->response($data, 200);
    } else {
      $data['status']=502;
      $data['message']='Fetch data kategori gagal';
      $this->response($data, 200);
    }
  }

  function sub_kategori_get(){
    $id_kejadian = $this->input->get('id_kejadian');
    $query = $this->db_model->get_where('tb_sub_kejadian', 'id_kejadian', $id_kejadian);
    $row = array();
    $i = 0;
    foreach ($query as $key => $value) {
        $arr['id_sub_kategori'] = $value->id_sub_kejadian;
        $arr['nama_sub_kategori'] = $value->nama_sub_kejadian;
        $arr['id_kategori'] = $value->id_kejadian;
        
        $row[$i]=$arr;
        $i++;
    }
    if ($query) {
      $data['data'] = array(
        'jumlah_sub_kategori' => count($query),
        'dataSubKategori' => $row
      );
      $data['status']=200;
      $data['message']='Fetch data sub kategori sukses';
      $this->response($data, 200);
    } else {
      $data['status']=502;
      $data['message']='Fetch data sub kategori gagal';
      $this->response($data, 200);
    }
  }

  function layanan_get(){
    $query = $this->db_model->get_data_layanan();
    $row = array();
    $i = 0;
    foreach ($query as $key => $value) {
        $arr['id_layanan'] = $value->id_layanan;
        $arr['deskripsi'] = $value->deskripsi;
        $arr['direktori_foto'] = base_url()."assets/themes/front/img/photos/".$value->foto;
        $arr['tgl_post'] = date("d M Y H:i A", strtotime($value->tgl_post));
        $arr['latitude'] = $value->latitude;
        $arr['longitude'] = $value->longitude;
        $arr['nama_pengepos'] = $value->nama;
        
        if ($value->avatar==NULL) {
          $avatar = "kosong";
        } else {
          $avatar = base_url()."assets/themes/front/img/avatar/".$value->avatar;
        }

        $arr['avatar'] = $avatar;

        $arr['jumlah_komentar'] = count($this->db_model->get_where('tb_komentar_layanan', 'id_layanan', $value->id_layanan));
        $arr['jumlah_favorite'] = count($this->db_model->get_where('tb_favorite_layanan', 'id_layanan', $value->id_layanan));

        $row[$i]=$arr;
        $i++;
    }
    if ($query) {
      $data['data'] = array(
        'jumlah_layanan' => count($query),
        'dataPost' => $row
      );
      $data['status']=200;
      $data['message']='Fetch data layanan kesehatan sukses';
      $this->response($data, 200);
    } else {
      $data['status']=502;
      $data['message']='Fetch data layanan kesehatan gagal';
      $this->response($data, 200);
    }
  }

  function layanan_detail_get(){
    $id = $this->input->get('id');
    $query = $this->db_model->get_data_layanan_detail($id);
    if ((count($query)) < 1) {
      $data['status']=502;
      $data['message']='Data tidak ditemukan';
      $this->response($data, 200);
    } else if ($query) {

      if ($query[0]->avatar==NULL) {
        $avatar = "kosong";
      } else {
        $avatar = base_url()."assets/themes/front/img/avatar/".$query[0]->avatar;
      }

      $detail_report = array(
        'id_layanan' => $query[0]->id_layanan,
        'deskripsi' => $query[0]->deskripsi,
        'direktori_foto' => base_url()."assets/themes/front/img/photos/".$query[0]->foto,
        'tgl_post' => date("d M Y H:i A", strtotime($query[0]->tgl_post)),
        'latitude' => $query[0]->latitude,
        'longitude' => $query[0]->longitude,
        'icon_layanan' => base_url()."assets/themes/front/img/marker/health_marker.png",
        'nama_pengepos' => $query[0]->nama,
        'avatar' => $avatar
      );
      $data['data']=$detail_report;
      $data['status']=200;
      $data['message']='Fetch data layanan kesehatan sukses';
      $this->response($data, 200);
    } else {
      $data['status']=502;
      $data['message']='Fetch data layanan kesehatan gagal';
      $this->response($data, 200);
    }
  }

  function komentar_report_get(){
    $id_post = $this->input->get('id_post');
    $query = $this->db_model->get_komentar_report($id_post);
    $row = array();
    $i = 0;
    foreach ($query as $key => $value) {
        $arr['id_komentar'] = $value->id_komentar;
        $arr['nama_user'] = $value->nama;

        if ($value->avatar==NULL) {
          $avatar = "kosong";
        } else {
          $avatar = base_url()."assets/themes/front/img/avatar/".$value->avatar;
        }

        $arr['avatar'] = $avatar;
        $arr['tgl_komentar'] = date("d M Y H:i A", strtotime($value->tgl_komentar));
        $arr['isi_komentar'] = $value->isi_komentar;

        $row[$i]=$arr;
        $i++;
    }
    if ($query) {
      $data['data'] = array(
        'jumlah_komentar' => count($query),
        'dataKomentar' => $row
      );
      $data['status']=200;
      $data['message']='Fetch data komentar sukses';
      $this->response($data, 200);
    } else {
      $data['status']=502;
      $data['message']='Fetch data komentar gagal';
      $this->response($data, 200);
    }
  }

  function komentar_layanan_get(){
    $id_layanan = $this->input->get('id_layanan');
    $query = $this->db_model->get_komentar_layanan($id_layanan);
    $row = array();
    $i = 0;
    foreach ($query as $key => $value) {
        $arr['id_komentar'] = $value->id_komentar_layanan;
        $arr['nama_user'] = $value->nama;

        if ($value->avatar==NULL) {
          $avatar = "kosong";
        } else {
          $avatar = base_url()."assets/themes/front/img/avatar/".$value->avatar;
        }

        $arr['avatar'] = $avatar;
        $arr['tgl_komentar'] = date("d M Y H:i A", strtotime($value->tgl_komentar));
        $arr['isi_komentar'] = $value->isi_komentar;

        $row[$i]=$arr;
        $i++;
    }
    if ($query) {
      $data['data'] = array(
        'jumlah_komentar' => count($query),
        'dataKomentar' => $row
      );
      $data['status']=200;
      $data['message']='Fetch data komentar layanan sukses';
      $this->response($data, 200);
    } else {
      $data['status']=502;
      $data['message']='Fetch data komentar layanan gagal';
      $this->response($data, 200);
    }
  }

  function komentar_report_post(){
    $isi = $this->post('isi', TRUE);
    $id_post = $this->post('id_post');
    $id_user = $this->post('id_user');
    
    $data_komentar = array(
        'isi_komentar' => $isi,
        'id_post' => $id_post,
        'id_user' => $id_user
    );
    $insert = $this->db_model->insert('tb_komentar', $data_komentar);
    if ($insert) {
        $data['status']=200;
        $data['message']='Komentar Anda telah ditambahkan';
        $this->response($data, 200);
    } else {
        $data['status']=502;
        $data['message']='Komentar Anda gagal ditambahkan, terjadi kesalahan';
        $this->response($data, 200);
    }
  }

  function komentar_layanan_post(){
    $isi = $this->post('isi', TRUE);
    $id_layanan = $this->post('id_layanan');
    $id_user = $this->post('id_user');
    
    $data_komentar = array(
        'isi_komentar' => $isi,
        'id_layanan' => $id_layanan,
        'id_user' => $id_user
    );
    $insert = $this->db_model->insert('tb_komentar_layanan', $data_komentar);
    if ($insert) {
        $data['status']=200;
        $data['message']='Komentar Anda telah ditambahkan';
        $this->response($data, 200);
    } else {
        $data['status']=502;
        $data['message']='Komentar Anda gagal ditambahkan, terjadi kesalahan';
        $this->response($data, 200);
    }
  }

  function favorite_report_post(){
    $id_post = $this->post('id_post');
    $id_user = $this->post('id_user');
    
    $data_fav = array(
        'id_post' => $id_post,
        'id_user' => $id_user
    );
    $insert = $this->db_model->insert('tb_favorite', $data_fav);
    if ($insert) {
        $data['status']=200;
        $data['message']='Report telah ditambahkan ke favorite';
        $this->response($data, 200);
    } else {
        $data['status']=502;
        $data['message']='Report gagal ditambahkan ke favorite';
        $this->response($data, 200);
    }
  }
  
  function favorite_layanan_post(){
    $id_layanan = $this->post('id_layanan');
    $id_user = $this->post('id_user');
    
    $data_fav = array(
        'id_layanan' => $id_layanan,
        'id_user' => $id_user
    );
    $insert = $this->db_model->insert('tb_favorite_layanan', $data_fav);
    if ($insert) {
        $data['status']=200;
        $data['message']='Layanan telah ditambahkan ke favorite';
        $this->response($data, 200);
    } else {
        $data['status']=502;
        $data['message']='Layanan gagal ditambahkan ke favorite';
        $this->response($data, 200);
    }
  }

  function unfavorite_report_post(){
    $id_post = $this->post('id_post');
    $id_user = $this->post('id_user');
    
    $delete = $this->db_model->delete2('tb_favorite', 'id_post', $id_post, 'id_user', $id_user);
    if ($delete) {
        $data['status']=200;
        $data['message']='Report telah dihapus dari favorite';
        $this->response($data, 200);
    } else {
        $data['status']=502;
        $data['message']='Report telah dihapus dari favorite';
        $this->response($data, 200);
    }
  } 

  function unfavorite_layanan_post(){
    $id_layanan = $this->post('id_layanan');
    $id_user = $this->post('id_user');
    
    $delete = $this->db_model->delete2('tb_favorite_layanan', 'id_layanan', $id_layanan, 'id_user', $id_user);
    if ($delete) {
        $data['status']=200;
        $data['message']='Layanan telah dihapus dari favorite';
        $this->response($data, 200);
    } else {
        $data['status']=502;
        $data['message']='Layanan telah dihapus dari favorite';
        $this->response($data, 200);
    }
  }

  function sub_kategori_all_get(){
    $query = $this->db_model->get_data('tb_sub_kejadian');
    $row = array();
    $i = 0;
    foreach ($query as $key => $value) {
        $arr['id_sub_kategori'] = $value->id_sub_kejadian;
        $arr['nama_sub_kategori'] = $value->nama_sub_kejadian;
        $arr['id_kategori'] = $value->id_kejadian;
        
        $row[$i]=$arr;
        $i++;
    }
    if ($query) {
      $data['data'] = array(
        'jumlah_sub_kategori' => count($query),
        'dataSubKategori' => $row
      );
      $data['status']=200;
      $data['message']='Fetch data report sukses';
      $this->response($data, 200);
    } else {
      $data['status']=502;
      $data['message']='Fetch data report gagal';
      $this->response($data, 200);
    }
  }

  function kamar_get(){
    $id_layanan = $this->input->get('id_layanan');
    $query = $this->db_model->get_where('tb_kamar', 'id_layanan', $id_layanan);
    $row = array();
    $i = 0;
    foreach ($query as $key => $value) {
        $arr['id_kamar'] = $value->id_kamar;
        $arr['jenis_kamar'] = $value->jenis_kamar;
        $arr['sisa_kamar'] = $value->sisa_kamar;
        $arr['total_kamar'] = $value->total_kamar;
        $arr['id_layanan'] = $value->id_layanan;
        
        $row[$i]=$arr;
        $i++;
    }
    if ($query) {
      $data['data'] = array(
        'jumlah_kamar' => count($query),
        'dataKamar' => $row
      );
      $data['status']=200;
      $data['message']='Fetch data kamar sukses';
      $this->response($data, 200);
    } else {
      $data['status']=502;
      $data['message']='Fetch data kamar gagal';
      $this->response($data, 200);
    }
  }

  function report_user_fav_get(){
    $id_user = $this->input->get('id_user');
    $query = $this->db_model->get_data_report_fav($id_user);
    $row = array();
    $i = 0;
    foreach ($query as $key => $value) {
        $arr['id_post'] = $value->id_post;
        $arr['deskripsi'] = $value->deskripsi;
        $arr['direktori_foto'] = base_url()."assets/themes/front/img/photos/".$value->foto;
        $arr['tgl_post'] = date("d M Y H:i A", strtotime($value->tgl_post));
        $arr['latitude'] = $value->latitude;
        $arr['longitude'] = $value->longitude;
        $arr['kategori_kejadian'] = $value->id_kejadian;
        $arr['sub_kategori_kejadian'] = $value->id_sub_kejadian;
        $arr['nama_pengepos'] = $value->nama;

        if ($value->avatar==NULL) {
          $avatar = "kosong";
        } else {
          $avatar = base_url()."assets/themes/front/img/avatar/".$value->avatar;
        }

        $arr['avatar'] = $avatar;

        $arr['jumlah_komentar'] = count($this->db_model->get_where('tb_komentar', 'id_post', $value->id_post));
        $arr['jumlah_favorite'] = count($this->db_model->get_where('tb_favorite', 'id_post', $value->id_post));
        
        $row[$i]=$arr;
        $i++;
    }
    if ($query) {
      $data['data'] = array(
        'jumlah_report' => count($query),
        'dataFavorite' => $row
      );
      $data['status']=200;
      $data['message']='Fetch data report sukses';
      $this->response($data, 200);
    } else {
      $data['status']=502;
      $data['message']='Fetch data report gagal';
      $this->response($data, 200);
    }
  }

}
