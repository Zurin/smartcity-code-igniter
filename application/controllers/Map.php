<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {

  function __construct()
  {
		parent::__construct();
		$this->load->model('db_model');
		$this->user = $this->session->userdata('login');
		$this->_init();
  }

    private function _init()
	{
		$this->output->set_template('map');
		$this->load->css('assets/themes/front/vendor/bootstrap/css/bootstrap.min.css');
		$this->load->css('assets/themes/front/css/dataTables.bootstrap4.min.css');
		$this->load->css('assets/themes/front/vendor/font-awesome/css/font-awesome.min.css');
		$this->load->css('https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');
		$this->load->css('https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic');
		$this->load->css('assets/themes/front/vendor/magnific-popup/magnific-popup.css');
		$this->load->css('assets/themes/front/css/creative.css');
		$this->load->css('assets/themes/admin/css/plugins/fancyBox/jquery.fancybox.min.css');

		$this->load->js('assets/themes/front/vendor/jquery/jquery.min.js');
		$this->load->js('assets/themes/front/vendor/bootstrap/js/bootstrap.bundle.min.js');
		$this->load->js('assets/themes/front/vendor/jquery-easing/jquery.easing.min.js');
		$this->load->js('assets/themes/front/js/jquery.dataTables.min.js');
		$this->load->js('assets/themes/front/js/dataTables.bootstrap4.min.js');
		$this->load->js('assets/themes/front/vendor/scrollreveal/scrollreveal.min.js');
		$this->load->js('assets/themes/front/vendor/magnific-popup/jquery.magnific-popup.min.js');
		$this->load->js('assets/themes/front/js/creative.js');
		$this->load->js('assets/themes/admin/js/plugins/fancyBox/jquery.fancybox.min.js');
		$this->output->set_meta('title', 'Landing Page Smart City');
	}

    public function index()
	{
		$this->load->js('https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js');
		$this->load->js('https://maps.googleapis.com/maps/api/js?key=AIzaSyD9dF4USe_uzgeUKcfjgqLezbEh6fW6KtU&language=id&libraries=places&callback=initMap');
		$this->load->js('assets/themes/front/vendor/jquery/locationpicker.jquery.js');
		$this->load->js('assets/themes/front/js/komentar.js');
		$data = array(
			'halaman' => "Normal Map",
			'judul' => $this->db_model->get_data('tb_judul'),
			'user' => $this->user,
			'kejadian' => $this->db_model->get_data_order('tb_kejadian', 'nama_kejadian', 'ASC'),
			'lokasi' => $this->db_model->get_data_report(),
			'list_view' => $this->db_model->get_data_report_listview(),
			'sosmed' => $this->db_model->get_data_order('tb_sosmed', 'id_sosmed', 'ASC')
		);
		$this->load->view('map/normal_map', $data);
    }

    public function heat_map()
	{
		$this->load->js('https://maps.googleapis.com/maps/api/js?key=AIzaSyD9dF4USe_uzgeUKcfjgqLezbEh6fW6KtU&language=id&libraries=places,visualization&callback=initMap');
		$this->load->js('assets/themes/front/vendor/jquery/locationpicker.jquery.js');
		$data = array(
			'halaman' => "Heat Map",
			'judul' => $this->db_model->get_data('tb_judul'),
			'user' => $this->user,
			'kejadian' => $this->db_model->get_data_order('tb_kejadian', 'nama_kejadian', 'ASC'),
			'lokasi' => $this->db_model->get_data('tb_post'),
			'list_view' => $this->db_model->get_data_report_listview(),
			'sosmed' => $this->db_model->get_data_order('tb_sosmed', 'id_sosmed', 'ASC')
		);
		$this->load->view('map/heat_map', $data);
	}

	public function health_map()
	{
		$this->load->js('https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js');
		$this->load->js('https://maps.googleapis.com/maps/api/js?key=AIzaSyD9dF4USe_uzgeUKcfjgqLezbEh6fW6KtU&language=id&libraries=places&callback=initMap');
		$this->load->js('assets/themes/front/vendor/jquery/locationpicker.jquery.js');
		$this->load->js('assets/themes/front/js/komentarLayanan.js');
		$data = array(
			'halaman' => "Health Map",
			'judul' => $this->db_model->get_data('tb_judul'),
			'user' => $this->user,
			'lokasi' => $this->db_model->get_data_layanan(),
			'list_view' => $this->db_model->get_data_report(),
			'sosmed' => $this->db_model->get_data_order('tb_sosmed', 'id_sosmed', 'ASC')
		);
		$this->load->view('map/health_map', $data);
    }

}