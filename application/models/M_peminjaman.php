<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_peminjaman extends CI_Model {
	protected $_tabel = 'tb_peminjaman';
	
	public function insert($data)
	{
		$obj = (object) $data;
		$this->db->insert($this->_tabel, $obj);	
		return $this->db->insert_id();
	}

	public function get_all_peminjaman()
	{
		$this->db->select('tb_peminjam.*, tb_peminjaman.*, tb_peminjaman.status as status_peminjaman, tb_prasarana.*');
		$this->db->join('tb_peminjam', 'tb_peminjam.id_peminjam = tb_peminjaman.id_peminjam', 'left');
		$this->db->join('tb_prasarana', 'tb_prasarana.id_prasarana = tb_peminjaman.id_prasarana', 'left');
		$query = $this->db->get($this->_tabel);

		return $query->result();
	}

	public function get_nama_prasarana()
	{
		$this->db->select('nama_prasarana as nama, tb_prasarana.id_prasarana as id');
		$query = $this->db->get('tb_prasarana');

		return $query->result();
	}

	public function get_status_peminjaman($id_siswa)
	{
		$this->db->select('tb_peminjam.*, tb_peminjaman.*, tb_peminjaman.status as status_peminjaman, tb_prasarana.*');
		$this->db->join('tb_peminjam', 'tb_peminjam.id_peminjam = tb_peminjaman.id_peminjam', 'left');
		$this->db->join('tb_prasarana', 'tb_prasarana.id_prasarana = tb_peminjaman.id_prasarana', 'left');
		$this->db->where('tb_peminjaman.id_peminjam', $id_siswa);
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

		$this->db->select('tb_peminjam.*, tb_peminjaman.*, tb_peminjaman.status as status_peminjaman, tb_prasarana.*');
		$this->db->join('tb_peminjam', 'tb_peminjam.id_peminjam = tb_peminjaman.id_peminjam', 'left');
		$this->db->join('tb_prasarana', 'tb_prasarana.id_prasarana = tb_peminjaman.id_prasarana', 'left');
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
}

/* End of file m_peminjaman.php */
/* Location: ./application/models/m_peminjaman.php */