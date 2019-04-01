<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

  function __construct()
  {
		parent::__construct();
		$this->load->model('db_model');
		$this->user = $this->session->userdata('login');
		$this->_init();
  }

    private function _init()
	{
		$this->output->set_template('form');
		$this->load->css('assets/themes/front/vendor/bootstrap/css/bootstrap.min.css');
		$this->load->css('assets/themes/front/vendor/font-awesome/css/font-awesome.min.css');
		$this->load->css('https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');
		$this->load->css('https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic');
		$this->load->css('assets/themes/front/css/creative.css');
		$this->load->css('assets/themes/front/vendor/jquery-ui/jquery-ui.min.css');
		$this->load->css('assets/themes/front/vendor/jquery-ui/jquery-ui.theme.min.css');

		$this->load->js('assets/themes/front/vendor/jquery/jquery.min.js');
		$this->load->js('assets/themes/front/vendor/jquery-ui/jquery-ui.min.js');
		$this->load->js('assets/themes/front/vendor/bootstrap/js/popper.js');
		$this->load->js('assets/themes/front/vendor/bootstrap/js/bootstrap.min.js');
		$this->output->set_meta('title', 'Auth User');
	}

    public function login()
	{
		if ($this->user != NULL) {
			redirect(base_url().'index.php/map');
		}
		// $this->load->js('assets/themes/front/js/login.js');
		$data = array(
			'halaman' => "Login User",
			'judul' => $this->db_model->get_data('tb_judul')
		);
		$this->load->view('form/login', $data);
	}
	
	public function register()
	{
		if ($this->user != NULL) {
			redirect(base_url().'index.php/map');
		}
		$this->load->js('assets/themes/front/js/register.js');
		$data = array(
			'halaman' => "Register User",
			'judul' => $this->db_model->get_data('tb_judul')
		);
		$this->load->view('form/register', $data);
    }

}