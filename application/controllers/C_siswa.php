<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_siswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_peminjaman','pinjam');
		$this->load->model('M_prasarana','prasarana');
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
		$this->form_validation->set_rules('id_prasarana', 'ID Prasarana', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
		$this->form_validation->set_rules('jam', 'Jam', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		if ($this->form_validation->run()) {
			$rent = array(
				'id_prasarana' => $this->input->post('id_prasarana'), 
				'id_peminjam' => $this->session->userdata('logged_in')['id_peminjam'],
				'jumlah' => $this->input->post('jumlah'), 
				'jam' => $this->input->post('jam'), 
				'tanggal' => date('Y-m-d',strtotime($this->input->post('tanggal'))),
				'status' => 'Menunggu Konfirmasi',
				'durasi' => 2,
				'alasan_pinjam' => $this->input->post('alasan_pinjam')
			);

			if($this->pinjam->insert($rent)){
				redirect('c_siswa/page_lihat_status','refresh');
			}else{
				echo "gagal";
			}
		} else {
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
    
    public function logout()
    {
        $this->session->set_userdata('logged_in', FALSE);
        session_destroy();
        redirect($this->index);
    }

    public function modal_detail()
	{
		if($this->input->post('rowid')){
			$row = $this->pinjam->get('id_peminjaman',$this->input->post('rowid'));

			echo '<form method="post">
	            <input type="hidden" name="id_user" value="'.$row->id_peminjaman.'">
	            <div class="form-group row">
                    <div class="col-md-6">
		                <label id="modal">Nama Sarana</label>
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
	            
	                <div class="col-md-6">
	                	<label id="modal">Jam</label>
	                	<input type="text" class="form-control" name="tanggalkembali" value="'.$row->jam.'" readonly>
	                </div>
	            </div>
	            
	                
	            </div>
	        </form>';
		}else{
			echo 'Error';
		}
	}

	public function get_stok_prasarana()
	{
		$id_prasarana = $this->input->post('id_prasarana');
		//TO DO: get stok sarana
		echo json_encode($this->input->post());
	}
}

/* End of file  C_siswa.php */
/* Location: ./application/controllers/ C_siswa.php */