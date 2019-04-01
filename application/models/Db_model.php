<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Db_model extends CI_Model {



	public $variable;



	public function __construct()
	{
		parent::__construct();
	}

  public function get_data($table){
		$this->db->from($table);
		$query=$this->db->get();

		return $query->result();
	}

  public function get_data_order($table, $key, $order){
		$this->db->from($table);
		$this->db->order_by($key, $order);
		$query=$this->db->get();

		return $query->result();
	}

  public function get_data_limit($table, $limit, $start, $key, $order){
		$this->db->from($table);
    $this->db->order_by($key, $order);
		$this->db->limit($limit, $start);
		$query=$this->db->get();

		return $query->result();
	}

	public function get_data_limit_where($table, $limit, $start, $field, $isi, $key, $order){
		$this->db->from($table);
		$this->db->where($field,$isi);
    $this->db->order_by($key, $order);
		$this->db->limit($limit, $start);
		$query=$this->db->get();

		return $query->result();
	}

	public function get_data_limit_where2($table, $limit, $start, $field1, $isi1, $field2, $isi2, $key, $order){
		$this->db->from($table);
		$this->db->where($field1,$isi1);
		$this->db->where($field2,$isi2);
    $this->db->order_by($key, $order);
		$this->db->limit($limit, $start);
		$query=$this->db->get();

		return $query->result();
	}

  	public function get_where($table,$field,$isi){
		$this->db->from($table);
		$this->db->where($field,$isi);
		$query=$this->db->get();

		return $query->result();
	}

  	public function get_where2($table, $field1, $field2, $isi1, $isi2){
		$this->db->from($table);
		$this->db->where($field1, $isi1);
    	$this->db->where($field2, $isi2);
		$query=$this->db->get();

		return $query->result();
	}

	public function get_where_order($table,$field,$isi,$field_order,$order_type){
		$this->db->from($table);
		$this->db->where($field,$isi);
		$this->db->order_by($field_order, $order_type);
		$query=$this->db->get();

		return $query->result();
	}

  	public function get_data_report(){
    	$this->db->select('p.*, u.nama, u.avatar, k.*, ks.*');
		$this->db->from('tb_post p');
		$this->db->join('tb_user u', 'u.id_user = p.id_user');
		$this->db->join('tb_sub_kejadian ks', 'ks.id_sub_kejadian = p.id_sub_kejadian');
		$this->db->join('tb_kejadian k', 'k.id_kejadian = ks.id_kejadian');
		$this->db->order_by('p.id_post', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_data_report_listview(){
    	$this->db->select('p.*, u.nama, u.avatar, k.*, ks.*');
		$this->db->from('tb_post p');
		$this->db->join('tb_user u', 'u.id_user = p.id_user');
		$this->db->join('tb_sub_kejadian ks', 'ks.id_sub_kejadian = p.id_sub_kejadian');
		$this->db->join('tb_kejadian k', 'k.id_kejadian = ks.id_kejadian');
		$this->db->group_by(array("p.latitude", "p.longitude"));
		$this->db->order_by('p.id_post', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_data_report_by_kategori($id){
    	$this->db->select('p.*, u.nama, u.avatar, k.*, ks.*');
		$this->db->from('tb_post p');
		$this->db->join('tb_user u', 'u.id_user = p.id_user');
		$this->db->join('tb_sub_kejadian ks', 'ks.id_sub_kejadian = p.id_sub_kejadian');
		$this->db->join('tb_kejadian k', 'k.id_kejadian = ks.id_kejadian');
		$this->db->where('p.id_sub_kejadian', $id);
		$this->db->order_by('p.id_post', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_data_report_by_status($status){
    	$this->db->select('p.*, u.nama, u.avatar, k.*, ks.*');
		$this->db->from('tb_post p');
		$this->db->join('tb_user u', 'u.id_user = p.id_user');
		$this->db->join('tb_sub_kejadian ks', 'ks.id_sub_kejadian = p.id_sub_kejadian');
		$this->db->join('tb_kejadian k', 'k.id_kejadian = ks.id_kejadian');
		$this->db->where('p.status', $status);
		$this->db->order_by('p.id_post', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_data_report_user($id_user){
    	$this->db->select('p.*, u.nama, u.avatar, k.*, ks.*');
		$this->db->from('tb_post p');
		$this->db->join('tb_user u', 'u.id_user = p.id_user');
		$this->db->join('tb_sub_kejadian ks', 'ks.id_sub_kejadian = p.id_sub_kejadian');
		$this->db->join('tb_kejadian k', 'k.id_kejadian = ks.id_kejadian');
		$this->db->order_by('p.id_post', 'DESC');
		$this->db->where('p.id_user', $id_user);
		$query = $this->db->get();

		return $query->result();
	}

	public function get_data_report_fav($id_user){
    	$this->db->select('p.*, u.nama, u.avatar,  k.*, ks.*, fav.*');
		$this->db->from('tb_favorite fav');
		$this->db->join('tb_user u', 'u.id_user = fav.id_user');
		$this->db->join('tb_post p', 'p.id_post = fav.id_post');
		$this->db->join('tb_sub_kejadian ks', 'ks.id_sub_kejadian = p.id_sub_kejadian');
		$this->db->join('tb_kejadian k', 'k.id_kejadian = ks.id_kejadian');
		$this->db->where('fav.id_user', $id_user);
		$this->db->order_by('p.id_post', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}
	
	public function get_data_report_detail($id_post){
    	$this->db->select('p.*, u.nama, u.avatar, k.*, ks.*');
		$this->db->from('tb_post p');
		$this->db->join('tb_user u', 'u.id_user = p.id_user');
		$this->db->join('tb_sub_kejadian ks', 'ks.id_sub_kejadian = p.id_sub_kejadian');
		$this->db->join('tb_kejadian k', 'k.id_kejadian = ks.id_kejadian');
		$this->db->order_by('p.id_post', 'DESC');
		$this->db->where('p.id_post', $id_post);
		$query = $this->db->get();

		return $query->result();
	}
	
	public function get_data_layanan(){
   		$this->db->select('l.*, u.nama, u.avatar');
		$this->db->from('tb_layanan l');
		$this->db->join('tb_user u', 'u.id_user = l.id_user');
		$this->db->order_by('l.id_layanan', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_data_layanan_2($id_user){
		$this->db->select('l.*, u.nama, u.avatar');
		$this->db->from('tb_layanan l');
		$this->db->join('tb_user u', 'u.id_user = l.id_user');
		$this->db->where('l.id_user', $id_user);
		$this->db->order_by('l.id_layanan', 'DESC');
		$query = $this->db->get();

	 	return $query->result();
 	}

	public function get_data_layanan_detail($id_layanan){
    $this->db->select('l.*, u.nama, u.avatar');
		$this->db->from('tb_layanan l');
		$this->db->join('tb_user u', 'u.id_user = l.id_user');
		$this->db->order_by('l.id_layanan', 'DESC');
		$this->db->where('l.id_layanan', $id_layanan);
		$query = $this->db->get();

		return $query->result();
	}

	public function get_komentar_report($id){
    $this->db->select('u.nama, u.username, u.avatar, k.*');
		$this->db->from('tb_komentar k');
		$this->db->join('tb_user u', 'u.id_user = k.id_user');
		$this->db->join('tb_post p', 'p.id_post = k.id_post');
		$this->db->where('k.id_post', $id);
		$this->db->order_by('k.id_komentar', 'ASC');
		$query = $this->db->get();

		return $query->result();
	}

	public function get_komentar_layanan($id){
    $this->db->select('u.nama, u.username, u.avatar, k.*');
		$this->db->from('tb_komentar_layanan k');
		$this->db->join('tb_user u', 'u.id_user = k.id_user');
		$this->db->join('tb_layanan l', 'l.id_layanan = k.id_layanan');
		$this->db->where('k.id_layanan', $id);
		$this->db->order_by('k.id_komentar_layanan', 'ASC');
		$query = $this->db->get();

		return $query->result();
	}

	function username_check($username)
	{
	    $this->db->select('*');
	    $this->db->from('tb_user');
	    $this->db->where('username', $username);
	    $query = $this->db->get();
	    $result = $query->result_array();

	    return $result;
	}

	public function insert($table, $data)
	{
		$this->db->trans_start();
		$this->db->insert($table, $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return false;
		} else {
			return true;
		}
	}

	public function delete($table, $field, $value)
	{
			$this->db->trans_start();
			$this->db->where($field, $value);
  		$this->db->delete($table);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return false;
			} else {
				return true;
			}
	}

	public function delete2($table, $field1, $value1, $field2, $value2)
	{
			$this->db->trans_start();
			$this->db->where($field1, $value1);
			$this->db->where($field2, $value2);
  		$this->db->delete($table);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				return false;
			} else {
				return true;
			}
	}

	public function update($table, $field, $value, $data)
	{
		$this->db->trans_start();
		$this->db->where($field, $value);
		$this->db->update($table, $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			return false;
		} else {
			return true;
		}
	}

}