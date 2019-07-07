<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_peminjam extends CI_Model {

	protected $_tabel = 'tb_peminjam';
	
	public function insert($data)
	{
		$obj = (object) $data;
		$this->db->insert($this->_tabel, $obj);	
		return $this->db->insert_id();
	}

	public function verify($key) {
	    // nilai dari status yang berawal dari Tidak Aktif akan diubah menjadi Aktif disini
	    $data = array('status' => "Aktif");
	    $this->db->where('md5(email)', $key);
	    return $this->db->update($this->_tabel, $data);
 	}

 	public function cek_login($data)
	{
		$kondisi = "email = '".$data['email']."' AND password ='".$data['password']."' AND status = 'Aktif'";
		$this->db->where($kondisi);
		$this->db->limit(1);

		$query = $this->db->get($this->_tabel);

		if ($query->num_rows()==1) {
			return true;
		} else {
			return false;
		}
	}

	public function get_data_session($email)
	{
		$this->db->where('email', $email);
		$this->db->select('*');
		$this->db->limit(1);

		$query = $this->db->get($this->_tabel);

		return $query->row();
	}

	public function get_all_siswa()
	{
		$this->db->where('jenis_user', 'Siswa');
		$this->db->select('*');
		$query = $this->db->get($this->_tabel);

		return $query->result();
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

public function getJumlah($id_prasarana) {
	$jumlah=0;
	$row = $this->db->query("SELECT sum(stok_tersedia) as jumlah from tb_prasarana WHERE id_prasarana=$id_prasarana")->row();
	if ($row){
		$jumlah = $row->jumlah;
	}
	else {
		$jumlah=0;
	}
	return $jumlah;
}


}

/* End of file m_peminjam.php */
/* Location: ./application/models/m_peminjam.php */