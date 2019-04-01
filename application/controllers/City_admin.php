<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class City_admin extends CI_Controller {

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
		$this->_init();
  }

    private function _init()
	{
		$this->output->set_template('admin');
        $this->load->css('assets/themes/admin/css/bootstrap.min.css');
        $this->load->css('assets/themes/admin/font-awesome/css/font-awesome.css');
        $this->load->css('assets/themes/admin/css/plugins/toastr/toastr.min.css');
        $this->load->css('assets/themes/admin/css/animate.css');
        $this->load->css('assets/themes/admin/css/style.css');

        //Mainly scripts
        $this->load->js('assets/themes/admin/js/jquery-2.1.1.js');
        $this->load->js('assets/themes/admin/js/bootstrap.min.js');
        $this->load->js('assets/themes/admin/js/plugins/metisMenu/jquery.metisMenu.js');
        $this->load->js('assets/themes/admin/js/plugins/slimscroll/jquery.slimscroll.min.js');
        // Flot
        // $this->load->js('assets/themes/admin/js/plugins/flot/jquery.flot.js');
        // $this->load->js('assets/themes/admin/js/plugins/flot/jquery.flot.tooltip.min.js');
        // $this->load->js('assets/themes/admin/js/plugins/flot/jquery.flot.spline.js');
        // $this->load->js('assets/themes/admin/js/plugins/flot/jquery.flot.resize.js');
        // $this->load->js('assets/themes/admin/js/plugins/flot/jquery.flot.pie.js');
        // $this->load->js('assets/themes/admin/js/plugins/flot/jquery.flot.symbol.js');
        // $this->load->js('assets/themes/admin/js/plugins/flot/jquery.flot.time.js');
        // Peity
        // $this->load->js('assets/themes/admin/js/plugins/peity/jquery.peity.min.js');
        // $this->load->js('assets/themes/admin/js/demo/peity-demo.js');
        // Custom and plugin javascript
        $this->load->js('assets/themes/admin/js/inspinia.js');
        // $this->load->js('assets/themes/admin/js/plugins/pace/pace.min.js');
        // jQuery UI
        // $this->load->js('assets/themes/admin/js/plugins/jquery-ui/jquery-ui.min.js');
        // // Sparkline
        // $this->load->js('assets/themes/admin/js/plugins/sparkline/jquery.sparkline.min.js');
        // // Sparkline demo data
        // $this->load->js('assets/themes/admin/js/demo/sparkline-demo.js');
        // // Toastr
        $this->load->js('assets/themes/admin/js/plugins/toastr/toastr.min.js');
		$this->output->set_meta('title', 'Admin Page Smart City');
	}

    public function index()
	{
		$data = array(
            'halaman' => "Dashboard Admin",
            'user' => $this->user,
            'laporan' => count($this->db_model->get_data('tb_post')),
            'kejadian' => count($this->db_model->get_data('tb_kejadian')),
            'pengguna' => count($this->db_model->get_data('tb_user'))
        );
        
        $this->load->view('admin/dashboard', $data);
    }

    public function report()
    {
        $this->load->css('assets/themes/admin/css/plugins/fancyBox/jquery.fancybox.min.css');
        $this->load->css('assets/themes/admin/css/plugins/dataTables/dataTables.bootstrap.css');
        $this->load->css('assets/themes/admin/css/plugins/dataTables/dataTables.responsive.css');
        $this->load->css('assets/themes/admin/css/plugins/dataTables/dataTables.tableTools.min.css');
        $this->load->css('assets/themes/admin/css/plugins/sweetalert/sweetalert.css');
        
        $this->load->js('assets/themes/admin/js/plugins/fancyBox/jquery.fancybox.min.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/jquery.dataTables.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/dataTables.bootstrap.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/dataTables.responsive.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/dataTables.tableTools.min.js');
        $this->load->js('assets/themes/admin/js/plugins/sweetalert/sweetalert.min.js');
        $this->load->js('assets/themes/admin/js/report.js');
		$data = array(
			'halaman' => "Manage Report",
            'user' => $this->user,
            'data_report' => $this->db_model->get_data_report()
		);
        $this->load->view('admin/report', $data);
    }

    public function manage_user()
    {
        $this->load->css('assets/themes/admin/css/plugins/fancyBox/jquery.fancybox.min.css');
        $this->load->css('assets/themes/admin/css/plugins/dataTables/dataTables.bootstrap.css');
        $this->load->css('assets/themes/admin/css/plugins/dataTables/dataTables.responsive.css');
        $this->load->css('assets/themes/admin/css/plugins/dataTables/dataTables.tableTools.min.css');
        $this->load->css('assets/themes/admin/css/plugins/sweetalert/sweetalert.css');
        $this->load->css('assets/themes/admin/css/plugins/iCheck/custom.css');
        $this->load->css('assets/themes/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css');
        $this->load->css('assets/themes/admin/css/plugins/datapicker/datepicker3.css');
        
        $this->load->js('assets/themes/admin/js/plugins/fancyBox/jquery.fancybox.min.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/jquery.dataTables.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/dataTables.bootstrap.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/dataTables.responsive.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/dataTables.tableTools.min.js');
        $this->load->js('assets/themes/admin/js/plugins/sweetalert/sweetalert.min.js');
        $this->load->js('assets/themes/admin/js/plugins/iCheck/icheck.min.js');
        $this->load->js('assets/themes/admin/js/plugins/datapicker/bootstrap-datepicker.js');
        $this->load->js('assets/themes/admin/js/user.js');
		$data = array(
			'halaman' => "Manage User",
            'user' => $this->user,
            'data_user' => $this->db_model->get_data_order('tb_user', 'username', 'ASC')
		);
        $this->load->view('admin/manage_user', $data);
    }

    public function add_user(){
        $this->load->css('assets/themes/admin/css/plugins/fancyBox/jquery.fancybox.min.css');
        $this->load->css('assets/themes/admin/css/plugins/dataTables/dataTables.bootstrap.css');
        $this->load->css('assets/themes/admin/css/plugins/dataTables/dataTables.responsive.css');
        $this->load->css('assets/themes/admin/css/plugins/dataTables/dataTables.tableTools.min.css');
        $this->load->css('assets/themes/admin/css/plugins/sweetalert/sweetalert.css');
        $this->load->css('assets/themes/admin/css/plugins/iCheck/custom.css');
        $this->load->css('assets/themes/admin/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css');
        $this->load->css('assets/themes/admin/css/plugins/datapicker/datepicker3.css');
        
        $this->load->js('assets/themes/admin/js/plugins/fancyBox/jquery.fancybox.min.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/jquery.dataTables.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/dataTables.bootstrap.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/dataTables.responsive.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/dataTables.tableTools.min.js');
        $this->load->js('assets/themes/admin/js/plugins/sweetalert/sweetalert.min.js');
        $this->load->js('assets/themes/admin/js/plugins/iCheck/icheck.min.js');
        $this->load->js('assets/themes/admin/js/plugins/datapicker/bootstrap-datepicker.js');
        $this->load->js('assets/themes/admin/js/user.js');
		$data = array(
			'halaman' => "Tambah User",
            'user' => $this->user,
		);
        $this->load->view('admin/add_user', $data);
    }


    public function report_komentar(){
        $this->load->css('assets/themes/admin/css/plugins/dataTables/dataTables.bootstrap.css');
        $this->load->css('assets/themes/admin/css/plugins/dataTables/dataTables.responsive.css');
        $this->load->css('assets/themes/admin/css/plugins/dataTables/dataTables.tableTools.min.css');
        $this->load->css('assets/themes/admin/css/plugins/sweetalert/sweetalert.css');
        
        $this->load->js('assets/themes/admin/js/plugins/dataTables/jquery.dataTables.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/dataTables.bootstrap.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/dataTables.responsive.js');
        $this->load->js('assets/themes/admin/js/plugins/dataTables/dataTables.tableTools.min.js');
        $this->load->js('assets/themes/admin/js/plugins/sweetalert/sweetalert.min.js');
        $this->load->js('assets/themes/admin/js/report.js');

        $id_report = $this->uri->segment(3);
		$data = array(
			'halaman' => "Manage Komentar Report",
            'user' => $this->user,
            'id_layanan' => $id_report,
            'data_komentar' => $this->db_model->get_komentar_report($id_report)
		);
        $this->load->view('admin/report_komentar', $data);
    }

    public function web_title(){
        $this->load->css('assets/themes/admin/css/plugins/fancyBox/jquery.fancybox.min.css');
        $this->load->css('assets/themes/admin/css/plugins/sweetalert/sweetalert.css');
        
        $this->load->js('assets/themes/admin/js/plugins/fancyBox/jquery.fancybox.min.js');
        $this->load->js('assets/themes/admin/js/plugins/sweetalert/sweetalert.min.js');
        $this->load->js('assets/themes/admin/js/web_config.js');

        $id_report = $this->uri->segment(3);
		$data = array(
			'halaman' => "Judul Web",
            'user' => $this->user,
            'title' => $this->db_model->get_data('tb_judul')
		);
        $this->load->view('admin/web_config', $data);
    }

    public function web_socmed(){
        $this->load->css('assets/themes/admin/css/plugins/fancyBox/jquery.fancybox.min.css');
        $this->load->css('assets/themes/admin/css/plugins/sweetalert/sweetalert.css');
        
        $this->load->js('assets/themes/admin/js/plugins/fancyBox/jquery.fancybox.min.js');
        $this->load->js('assets/themes/admin/js/plugins/sweetalert/sweetalert.min.js');
        $this->load->js('assets/themes/admin/js/web_config.js');

        $id_report = $this->uri->segment(3);
		$data = array(
			'halaman' => "Sosial Media",
            'user' => $this->user,
            'data_sosmed' => $this->db_model->get_data_order('tb_sosmed', 'id_sosmed', 'ASC')
		);
        $this->load->view('admin/web_socmed', $data);
    }

}