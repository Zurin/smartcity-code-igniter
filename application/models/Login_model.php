<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}

		public function login_method(){
				// Menghindari injectsi hacking
				$username = $this->security->xss_clean($this->input->post('username'));
				$password = $this->security->xss_clean($this->input->post('password'));
				$this->db->where('username', $username);
				$query = $this->db->get('tb_user');
				//print_r($query->num_rows());
				// Cek apakah user tersebut ada??
				if($query->num_rows() == 1)
				{
						//Jika user ada maka buat sessi
						$row = $query->row();
						if(password_verify(sha1($password), $row->password)){
								$data = array(
												'id_user' => $row->id_user,
												'username' => $row->username,
                                                'nama' => $row->nama,
                                                'email' => $row->email,
												'level' => $row->level,
												'avatar' => $row->avatar
								);
							$this->session->set_userdata("login", $data);
							return true;
						} else return false;
				} else{
                    // Jika tidak maka data tidak ditemukan
                    return false;
				}
		}

		public function login_admin(){
			// Menghindari injectsi hacking
			$username = $this->security->xss_clean($this->input->post('username'));
			$password = $this->security->xss_clean($this->input->post('password'));
			// pengambilan query (indentify iD)
			$this->db->where('username', $username);
			$where_user = '(level="admin" or level = "adminRS")';
			$this->db->where($where_user);
			$query = $this->db->get('tb_user');
			//print_r($query->num_rows());
			// Cek apakah user tersebut ada??
			if($query->num_rows() == 1)
			{
					//Jika user ada maka buat sessi
					$row = $query->row();
					if(password_verify(sha1($password), $row->password)){
							$data = array(
											'id_user' => $row->id_user,
											'username' => $row->username,
											'nama' => $row->nama,
											'email' => $row->email,
											'level' => $row->level,
											'avatar' => $row->avatar
							);
						$this->session->set_userdata("login", $data);
						return true;
					} else return false;
			} else{
				// Jika tidak maka data tidak ditemukan
				return false;
			}
		}

}