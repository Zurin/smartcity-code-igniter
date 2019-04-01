<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landing extends CI_Controller {

  function __construct()
  {
		parent::__construct();
		$this->_init();
  }

  private function _init()
	{
		$this->output->set_template('landing');
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
		$data = array(
			'halaman' => "Landing Page Smart City"
		);
		$this->load->view('landing/landing_page', $data);
	}

}