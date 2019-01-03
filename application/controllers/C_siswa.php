<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_peminjaman','pinjam');
	}
	public function page_pinjam_sarana()
	{
		if($this->session->userdata('logged_in')==null){
			$this->load->view('login.php');
		}else{

			$data1['home_header'] 		= "";
			$data1['rental_header'] 	= "active";
			$data1['status_header'] 	= "";

			$data2['prasarana']			= $this->pinjam->get_nama_prasarana();

			$this->load->view('header_siswa.php', $data1);
			$this->load->view('input_permohonan.php', $data2);
		}
	}

	public function insert_rental()
	{
		$rent = array(
			'id_prasarana' => $this->input->post('id_prasarana'), 
			'id_peminjam' => $this->session->userdata('logged_in')['id_peminjam'],
			'jumlah' => $this->input->post('jumlah'), 
			'jam' => $this->input->post('jam'), 
			'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
			'status' => 'Menunggu Konfirmasi',
			'durasi' => 2 
		);

		if($this->pinjam->insert($rent)){
			echo "sukses";
		}else{
			echo "gagal";
		}
	}

    public function page_lihat_status()
    {
    	if($this->session->userdata('logged_in')==null){
			$this->load->view('login.php');
		}else{

			$data1['home_header'] 		= "";
			$data1['rental_header'] 	= "";
			$data1['status_header'] 	= "active";

			$id_siswa = $this->session->userdata('logged_in')['id_peminjam'];
			$data2['peminjaman']			= $this->pinjam->get_status_peminjaman($id_siswa);

			$this->load->view('header_siswa.php', $data1);
			$this->load->view('lihat_status.php', $data2);
		}
    }

    public function modal_detail()
	{
		if($this->input->post('rowid')){
			$row = $this->pinjam->get('id_peminjaman',$this->input->post('rowid'));

			echo '<form method="post">
	            <input type="hidden" name="id_user" value="'.$row->id_peminjaman.'">
	            <div class="form-group row">
                    <div class="col-md-6">
		                <label id="modal">Nama Prasarana</label>
		                <input type="text" class="form-control" name="nama" value="'.$row->nama_prasarana.'" readonly>
		            </div>
                    <div class="col-md-6">
		                <label id="modal">Nama Peminjam</label>
		                <input type="text" class="form-control" name="nama" value="'.$row->nama.'" readonly>
	                </div>
	            </div>
	            <div class="form-group row">
	            	<div class="col-md-6">
		                <label id="modal">Status</label>
		                <input type="text" class="form-control" name="status" value="'.$row->status_peminjaman.'" readonly>
	                </div>
	                <div class="col-md-6">
	                	<label id="modal">Tanggal Pinjam</label>
	                	<input type="text" class="form-control" name="tanggal" value="'.$row->tanggal.'" readonly>
	                </div>
	            </div>
	            <div class="form-group row">
	            	<div class="col-md-6">
		                <label id="modal">Durasi</label>
		                <input type="text" class="form-control" name="durasi" value="'.$row->durasi.'" readonly>
	                </div>
	                <div class="col-md-6">
	                	<label id="modal">Jam</label>
	                	<input type="text" class="form-control" name="tanggalkembali" value="'.$row->jam.'" readonly>
	                </div>
	            </div>
	            <div class="form-group row">
	            	<div class="col-md-6">
		                <label id="modal">Kondisi Pinjam</label>
		                <input type="text" class="form-control" name="durasi" value="'.$row->kondisi_pinjam.'" readonly>
	                </div>
	                <div class="col-md-6">
	                	<label id="modal">Jam</label>
	                	<input type="text" class="form-control" name="tanggalkembali" value="'.$row->durasi.'" readonly>
	                </div>
	            </div>
	        </form>';
		}else{
			echo 'Error boy';
		}
	}
}

/* End of file  C_siswa.php */
/* Location: ./application/controllers/ C_siswa.php */