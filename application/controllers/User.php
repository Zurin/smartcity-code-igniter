<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

  function __construct()
  {
		parent::__construct();
		$this->load->model('db_model');
		$this->user = $this->session->userdata('login');
		$this->_init();
  }

    private function _init()
	{
		$this->output->set_template('user_area');
		$this->load->css('assets/themes/front/vendor/bootstrap/css/bootstrap.min.css');
		$this->load->css('assets/themes/front/vendor/font-awesome/css/font-awesome.min.css');
		$this->load->css('https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');
		$this->load->css('https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic');
		$this->load->css('assets/themes/front/vendor/magnific-popup/magnific-popup.css');
		$this->load->css('assets/themes/front/css/creative.css');

		$this->load->js('assets/themes/front/vendor/jquery/jquery.min.js');
		$this->load->js('assets/themes/front/vendor/bootstrap/js/bootstrap.bundle.min.js');
		$this->load->js('assets/themes/front/vendor/jquery-easing/jquery.easing.min.js');
		$this->load->js('assets/themes/front/vendor/scrollreveal/scrollreveal.min.js');
		$this->load->js('assets/themes/front/vendor/magnific-popup/jquery.magnific-popup.min.js');
		$this->load->js('assets/themes/front/js/creative.js');
		$this->output->set_meta('title', 'Landing Page Smart City');
	}

    public function index()
	{
        if ($this->user==NULL) {
            redirect(base_url().'index.php/auth/login');
        }
		$data = array(
			'halaman' => "Profil | ".$this->user['nama'],
			'judul' => $this->db_model->get_data('tb_judul'),
            'user' => $this->user,
            'data_user' => $this->db_model->get_where('tb_user', 'id_user', $this->user['id_user']),
			'data_lap_user' => $this->db_model->get_data_report_user($this->user['id_user']),
			'data_fav' => $this->db_model->get_data_report_fav($this->user['id_user'])
		);
		$this->load->view('user_area/user_profile', $data);
    }

    public function edit()
	{
        $this->load->css('assets/themes/front/vendor/jquery-ui/jquery-ui.min.css');
        $this->load->css('assets/themes/front/vendor/jquery-ui/jquery-ui.theme.min.css');
        $this->load->js('assets/themes/front/vendor/jquery-ui/jquery-ui.min.js');
        if ($this->user==NULL) {
            redirect(base_url().'index.php/auth/login');
        }
		$data = array(
			'halaman' => "Edit Profile",
			'judul' => $this->db_model->get_data('tb_judul'),
            'user' => $this->user,
            'data_user' => $this->db_model->get_where('tb_user', 'id_user', $this->user['id_user'])
		);
		$this->load->view('user_area/user_edit', $data);
	}
	
	public function report_detail(){
		$this->load->js('https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js');
		$this->load->js('https://maps.googleapis.com/maps/api/js?key=AIzaSyD9dF4USe_uzgeUKcfjgqLezbEh6fW6KtU&language=id&libraries=places&callback=initMap');
		$this->load->js('assets/themes/front/js/komentar.js');
		$id_post = $this->uri->segment(3);
		$data = array(
			'halaman' => "Detail Report",
			'judul' => $this->db_model->get_data('tb_judul'),
            'user' => $this->user,
            'data_report' => $this->db_model->get_data_report_detail($id_post)
		);
		$this->load->view('user_area/user_report_detail', $data);
	}

}