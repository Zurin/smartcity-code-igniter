<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actions extends CI_Controller {

  function __construct()
  {
        parent::__construct();
        $this->load->model('db_model');
        $this->user = $this->session->userdata('login');
  }
	
	public function register()
	{
        $username = $this->input->post('username', TRUE);
	    $ada = $this->db_model->username_check($username);

        $count = count($ada);
        
        if ($count>0){
            exit("not");
        }

        $password_sha1 = sha1($this->input->post('password'));
        $options = [
		    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
		];
        $password = password_hash($password_sha1, PASSWORD_DEFAULT, $options);
        $date_explode = explode('-', $this->input->post('tgl_lahir'));
        $date = $date_explode[2]."-".$date_explode[1]."-".$date_explode[0];
		$data = array(
            'nama' => $this->input->post('nama', TRUE),
            'username' => $username,
            'password' => $password,
            'email' => $this->input->post('email', TRUE),
            'gender' => $this->input->post('gender'),
            'tgl_lahir' => $date,
        );
        $insert = $this->db_model->insert('tb_user', $data);
        if ($insert) {
            echo "ok"; 
        } else {
            echo "not";
        }
    }

    public function add_report(){
        $user = $this->user;
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
                'id_user' => $user['id_user']
            );
            if ($lat == 'undefined' || $long == 'undefined') {
                exit("not");
            }
            $result= $this->db_model->insert('tb_post', $data1);
            if ($result == TRUE) {
                echo "ok";
            } else
                echo "not";
        } else {
            echo "upload fail";
        }

    }

    function get_sub_kejadian(){
        $kejadian = $this->input->get('kejadian');
        $sub_kejadian = $this->db_model->get_where('tb_sub_kejadian', 'id_kejadian', $kejadian);

        foreach ($sub_kejadian as $key => $value) {
            echo "<option value=\"".$value->id_sub_kejadian."\">".$value->nama_sub_kejadian."</option>";
        }
    }

    public function change_avatar(){
        $user = $this->user;
        $config['upload_path']="./assets/themes/front/img/avatar";
        $config['allowed_types']='gif|jpg|png';
        $this->load->library('upload',$config);
        if($this->upload->do_upload("avatar")){
            $nama_file = $this->upload->data('file_name');
            $data = array('upload_data' => $this->upload->data());
            $data1 = array(
                'avatar' => $nama_file
            );
            $result= $this->db_model->update('tb_user', 'id_user', $user['id_user'], $data1);
            if ($result == TRUE) {
                echo "ok";
            } else
                echo "not";
        } else {
            echo "upload fail";
        }
    }

    public function change_password(){
        $id_user = $this->user['id_user'];
        $get_user = $this->db_model->get_where('tb_user', 'id_user', $id_user);
        $db_password = $get_user[0]->password;
        $password_lama = $this->input->post('password_lama');
        $password_baru = $this->input->post('password_baru');

        $password_sha1 = sha1($password_baru);
        $options = [
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
        ];
        $password = password_hash($password_sha1, PASSWORD_DEFAULT, $options);

        if(password_verify(sha1($password_lama), $db_password)){
            $data_user = array(
              'password' => $password
            );
            $result= $this->db_model->update('tb_user', 'id_user', $id_user, $data_user);
            if ($result == TRUE)
                echo "ok";
            else
                echo "not";
        } else {
            echo "wrong";
        }
    }

    public function add_komentar(){
        $user = $this->user;
        $data = array(
                'isi_komentar' => $this->input->post('isi_komentar', TRUE),
                'id_post' => $this->input->post('id_post'),
                'id_user' => $user['id_user']
        );
        $result= $this->db_model->insert('tb_komentar', $data);

        if ($result == TRUE) {
            echo "ok";
        } else
            echo "not";
    }

    public function get_komentar()
	{
        $id = $this->uri->segment(3);
		$data = $this->db_model->get_komentar_report($id);  
 
		echo json_encode($data);
    }

    public function add_komentar_layanan(){
        $user = $this->user;
        $data = array(
                'isi_komentar' => $this->input->post('isi_komentar_layanan', TRUE),
                'id_layanan' => $this->input->post('id_layanan'),
                'id_user' => $user['id_user']
        );
        $result= $this->db_model->insert('tb_komentar_layanan', $data);

        if ($result == TRUE) {
            echo "ok";
        } else
            echo "not";
    }

    public function get_komentar_layanan()
	{
        $id = $this->uri->segment(3);
		$data = $this->db_model->get_komentar_layanan($id);  
 
		echo json_encode($data);
    }

    public function change_general(){
        $id_user = $this->user['id_user'];
        $date_explode = explode('-', $this->input->post('tgl_lahir'));
        $date = $date_explode[2]."-".$date_explode[1]."-".$date_explode[0];
        $data_user = array(
            'nama' => $this->input->post('nama'),
            'gender' => $this->input->post('gender'),
            'email' => $this->input->post('email'),
            'tgl_lahir' => $date
        );
        $result= $this->db_model->update('tb_user', 'id_user', $id_user, $data_user);
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }

    

    function username_check(){
	    $username = $this->input->post('username');
	    $ada = $this->db_model->username_check($username);

	    $count = count($ada);

	    if ($count==0) {
	        echo 'true';
	    } else {
	        echo 'false';
	    }
    }

    public function get_fav(){
        $id_user = $this->uri->segment(3);
        $id_post = $this->uri->segment(4);
        
        $result= $this->db_model->get_where2('tb_favorite', 'id_post', 'id_user', $id_post, $id_user);

        if (count($result)>0)
            echo "TRUE";
        else
            echo "FALSE";
    }

    public function add_fav(){
        $id_user = $this->uri->segment(3);
        $id_post = $this->uri->segment(4);

        $data = array(
            'id_post' => $id_post,
            'id_user' => $id_user
        );
        
        $result= $this->db_model->insert('tb_favorite', $data);

        if ($result) 
            echo "TRUE";
        else
            echo "FALSE";
    }

    public function un_fav(){
        $id_user = $this->uri->segment(3);
        $id_post = $this->uri->segment(4);
        
        $result= $this->db_model->delete2('tb_favorite', 'id_user', $id_user, 'id_post', $id_post);

        if ($result) 
            echo "TRUE";
        else
            echo "FALSE";
    }

    public function get_fav_layanan(){
        $id_user = $this->uri->segment(3);
        $id_layanan = $this->uri->segment(4);
        
        $result= $this->db_model->get_where2('tb_favorite_layanan', 'id_layanan', 'id_user', $id_layanan, $id_user);

        if (count($result)>0)
            echo "TRUE";
        else
            echo "FALSE";
    }

    public function add_fav_layanan(){
        $id_user = $this->uri->segment(3);
        $id_layanan = $this->uri->segment(4);

        $data = array(
            'id_layanan' => $id_layanan,
            'id_user' => $id_user
        );
        
        $result= $this->db_model->insert('tb_favorite_layanan', $data);

        if ($result)
            echo "TRUE";
        else
            echo "FALSE";
    }

    public function un_fav_layanan(){
        $id_user = $this->uri->segment(3);
        $id_layanan = $this->uri->segment(4);
        
        $result= $this->db_model->delete2('tb_favorite_layanan', 'id_user', $id_user, 'id_layanan', $id_layanan);

        if ($result) {
            echo "TRUE";
        } else
            echo "FALSE";
    }

    public function get_kamar()
	{
        $id = $this->uri->segment(3);
		$data = $this->db_model->get_where('tb_kamar', 'id_layanan', $id);  
 
		echo json_encode($data);
    }
    
    public function login()
	{
        $this->load->model('login_model');
        $result = $this->login_model->login_method();
            //print_r($result);
        if($result == FALSE){
            echo "not";
        }else
            echo "ok";
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url()."index.php/map");
    }

    public function form_login_admin(){
        $this->load->view('form/login_admin');
    }

    public function login_admin(){
        $this->load->model('login_model');
        $result = $this->login_model->login_admin();
            //print_r($result);
        if($result == FALSE){
            echo "not";
        }else
            echo "ok";
    }

    public function logout_admin(){
        $this->session->sess_destroy();
        redirect(base_url()."index.php/city-admin");
    }

}