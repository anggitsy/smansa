<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_prasarana extends CI_Model {

	protected $_tabel = 'tb_prasarana';

	public function insert($data)
	{
		$obj = (object) $data;
		$this->db->insert($this->_tabel, $obj);
		return $this->db->insert_id();
	}

	public function update()
	{
		$args = func_get_args();

		//update('nama',$nama, $data)
		if(count($args) > 2){
			$this->db->where($args[0], $args[1]);
			$data = (object) $args[2];
		}
		//update(3, $data)
		elseif(count($args) == 2 && is_numeric($args[0])){
			$this->db->where('id', $args[0]);
			$data = (object) $args[1];
		}
		else
		{
			$this->db->where($args[0]);
			$data = (object) $args[1];
		}

		$this->db->limit(1);
		return $this->db->update($this->_tabel, $data);
	}

	public function delete($id)
	{
		return $this->db->delete($this->_tabel, array('id_prasarana' => $id));
	}

	public function get()
	{
		//Ambil argumen yang dilewatkan ke fungsi
		$args = func_get_args();

		if(count($args)>1){
			$this->db->where($args[0], $args[1]);
			// $this->db->where('nama', $name);
		}
		elseif (count($args)==1 && is_numeric($args)) {
			$this->db->where('id', $args[0]);
			// $this->db->where('id', $args[0]);
		}
		else
		{
			$this->db->where($args[0]);
			// $this->db->where(array('id' => $id, 'nama' => $nama));
			// $this->db->where("name ='JOE' and status = 'aktif'");
		}

		$this->db->select('*');
		//Hanya mengembalikan satu record
		$this->db->limit(1);

		//Mengembalikan hasil query
		return $this->db->get($this->_tabel)->row();
	}

	public function get_all_prasarana()
	{
		return $this->db->get($this->_tabel)->result();
	}

}

/* End of file M_prasarana.php */
/* Location: ./application/models/M_prasarana.php */