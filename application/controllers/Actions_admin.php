<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actions_admin extends CI_Controller {

  function __construct()
  {
        parent::__construct();
        $this->load->model('db_model');
        $this->user = $this->session->userdata('login');
        
        if (($this->user['level'] != 'admin') || $this->user==NULL) {
            if($this->user['level'] == 'adminRS'){
                
            } else {
                $this->session->sess_destroy();
                redirect(base_url()."index.php/actions/form_login_admin");
            }
        }
  }
	
    public function ajax_edit()
	{
            $id = $this->uri->segment(3);
			$data = $this->db_model->get_where('tb_post', 'id_post', $id); 
 
 
			echo json_encode($data);
    }

    public function update_report(){
        $id_post = $this->input->post('id_post');

        $data = array(
            'keterangan' => $this->input->post('keterangan'),
            'ditangani_oleh' => $this->input->post('ditangani'),
            'status' => $this->input->post('status'),
            'tgl_status' => date("Y-m-d")
        );
        $result= $this->db_model->update('tb_post', 'id_post', $id_post, $data);
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }

    public function delete_report(){
        $id_post = $this->uri->segment(3);

        $result= $this->db_model->delete('tb_post', 'id_post', $id_post);
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }

    public function ajax_edit_user()
	{
            $id = $this->uri->segment(3);
			$data = $this->db_model->get_where('tb_user', 'id_user', $id); 
 
 
			echo json_encode($data);
    }

    public function update_user(){
        $id_user = $this->input->post('id_user');

        $data = array(
            'level' => $this->input->post('level'),
        );
        $result= $this->db_model->update('tb_user', 'id_user', $id_user, $data);
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }

    public function delete_user(){
        $id_user = $this->uri->segment(3);

        $result= $this->db_model->delete('tb_user', 'id_user', $id_user);
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }

    public function user_new()
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
            'level' => $this->input->post('level')
        );
        $insert = $this->db_model->insert('tb_user', $data);
        if ($insert) {
            echo "ok"; 
        } else {
            echo "not";
        }
    }

    public function add_layanan(){
        $config['upload_path']="./assets/themes/front/img/photos";
        $config['allowed_types']='gif|jpg|png';
        $this->load->library('upload',$config);
        if($this->upload->do_upload("foto")){
            $nama_file = $this->upload->data('file_name');
            $data = array('upload_data' => $this->upload->data());
            $lat = $this->input->post('latitude');
            $long = $this->input->post('longitude');
            $data1 = array(
                'deskripsi' => $this->input->post('deskripsi', TRUE),
                'foto' => $nama_file,
                'latitude' => $lat,
                'longitude' => $long,
                'id_user' => $this->input->post('id_user')
            );
            if ($lat == 'undefined' || $long == 'undefined') {
                exit("not");
            }
            $result= $this->db_model->insert('tb_layanan', $data1);
            if ($result == TRUE) {
                echo "ok";
            } else
                echo "not";
        } else {
            echo "upload fail";
        }
    }

    public function ajax_edit_layanan()
	{
            $id = $this->uri->segment(3);
			$data = $this->db_model->get_where('tb_layanan', 'id_layanan', $id); 
 
 
			echo json_encode($data);
    }

    public function delete_layanan(){
        $id_layanan = $this->uri->segment(3);

        $result= $this->db_model->delete('tb_layanan', 'id_layanan', $id_layanan);
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }

    public function update_layanan(){
        $id_layanan = $this->input->post('id_layanan');
        $config['upload_path']="./assets/themes/front/img/photos";
        $config['allowed_types']='gif|jpg|png';
        $this->load->library('upload',$config);

            if($this->upload->do_upload("foto")){
                $nama_file = $this->upload->data('file_name');
                $data = array('upload_data' => $this->upload->data());
                $data1 = array(
                    'deskripsi' => $this->input->post('deskripsi', TRUE),
                    'foto' => $nama_file
                );
            } else {
                $data1 = array(
                    'deskripsi' => $this->input->post('deskripsi', TRUE)
                );
            }
            
        $result= $this->db_model->update('tb_layanan', 'id_layanan', $id_layanan, $data1);
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }

    public function get_kamar()
	{
        $id = $this->uri->segment(3);
		$data = $this->db_model->get_where('tb_kamar', 'id_layanan', $id);  
 
		echo json_encode($data);
    }

    public function kamar_edit()
	{
            $id = $this->uri->segment(3);
			$data = $this->db_model->get_where('tb_kamar', 'id_kamar', $id); 
 
 
			echo json_encode($data);
    }

    public function add_kamar(){
        $total_data = $this->input->post('jenis_kamar');
        $data = array();

        foreach ($total_data as $key => $value){
            $data[] = array(
                'jenis_kamar' => $_POST['jenis_kamar'][$key],
                'sisa_kamar' => $_POST['sisa_kamar'][$key],
                'total_kamar' => $_POST['total_kamar'][$key],
                'id_layanan' => $_POST['id_layanan'][$key]
            );
        }
        $result= $this->db->insert_batch('tb_kamar', $data);

        if ($result)
            echo "ok";
        else
            echo "not";
    }

    public function delete_kamar(){
        $id_kamar = $this->uri->segment(3);

        $result= $this->db_model->delete('tb_kamar', 'id_kamar', $id_kamar);
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }

    public function update_kamar(){
        $id_kamar = $this->input->post('id_kamar');

        $data = array(
            'jenis_kamar' => $this->input->post('jenis'),
            'sisa_kamar' => $this->input->post('sisa'),
            'total_kamar' => $this->input->post('total')
        );
        $result= $this->db_model->update('tb_kamar', 'id_kamar', $id_kamar, $data);
        
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }

    public function get_komentar_layanan()
	{
        $id_layanan = $this->uri->segment(3);
		$data = $this->db_model->get_komentar_layanan($id_layanan);  
 
		echo json_encode($data);
    }

    public function delete_komentar_layanan(){
        $id_komentar_layanan = $this->uri->segment(3);

        $result= $this->db_model->delete('tb_komentar_layanan', 'id_komentar_layanan', $id_komentar_layanan);
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }

    public function get_komentar_report()
	{
        $id_report = $this->uri->segment(3);
		$data = $this->db_model->get_komentar_report($id_report);  
 
		echo json_encode($data);
    }

    public function delete_komentar_report(){
        $id_komentar = $this->uri->segment(3);

        $result= $this->db_model->delete('tb_komentar', 'id_komentar', $id_komentar);
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }

    public function ajax_edit_config()
	{
            $id = $this->uri->segment(3);
			$data = $this->db_model->get_where('tb_judul', 'id', $id); 
 
 
			echo json_encode($data);
    }

    public function config_web(){
        $id = $this->input->post('id');
        $config['upload_path']="./assets/themes/front/img/brand";
        $config['allowed_types']='gif|jpg|png|ico';
        $this->load->library('upload',$config);

            if($this->upload->do_upload("brand")){
                $nama_file = $this->upload->data('file_name');
                $data = array('upload_data' => $this->upload->data());
                $data1 = array(
                    'judul_web' => $this->input->post('judul_web', TRUE),
                    'about' => $this->input->post('about', TRUE),
                    'brand' => $nama_file
                );
                if($this->upload->do_upload("favicon")){
                    $favicon_name = $this->upload->data('file_name');
                    $data = array('upload_data' => $this->upload->data());
                    $data1['favicon'] = $favicon_name;
                }
            } else {
                $data1 = array(
                    'judul_web' => $this->input->post('judul_web', TRUE),
                    'about' => $this->input->post('about', TRUE)
                );
                if($this->upload->do_upload("favicon")){
                    $favicon_name = $this->upload->data('file_name');
                    $data = array('upload_data' => $this->upload->data());
                    $data1['favicon'] = $favicon_name;
                }
            }
            
        $result= $this->db_model->update('tb_judul', 'id', $id, $data1);
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }

    public function add_socmed(){
        $data = array(
            'fa_sosmed' => $this->input->post('fa_sosmed', TRUE),
            'url' => $this->input->post('url', TRUE)
        );
        $result= $this->db_model->insert('tb_sosmed', $data);
        if ($result == TRUE) {
            echo "ok";
        } else
            echo "not";
    }

    public function get_data_socmed()
	{
		$data = $this->db_model->get_data_order('tb_sosmed', 'id_sosmed', 'ASC');  
 
		echo json_encode($data);
    }

    public function delete_socmed(){
        $id_sosmed = $this->uri->segment(3);

        $result= $this->db_model->delete('tb_sosmed', 'id_sosmed', $id_sosmed);
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }

    public function ajax_edit_socmed()
	{
            $id_sosmed = $this->uri->segment(3);
			$data = $this->db_model->get_where('tb_sosmed', 'id_sosmed', $id_sosmed); 
 
 
			echo json_encode($data);
    }

    public function update_socmed(){
        $id_sosmed = $this->input->post('id_sosmed');
            
        $data = array(
            'fa_sosmed' => $this->input->post('fa_sosmed', TRUE),
            'url' => $this->input->post('url', TRUE)
        );            
            
        $result= $this->db_model->update('tb_sosmed', 'id_sosmed', $id_sosmed, $data);
        if ($result == TRUE)
            echo "ok";
        else
            echo "not";
    }


}