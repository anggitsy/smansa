<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pengelola extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_peminjam','user');
		$this->load->model('m_peminjaman','peminjaman');
	}

	public function index()
	{
		if($this->session->userdata('logged_in')==null){
			$this->load->view('login.php');
		}else{
			if ($this->session->userdata('logged_in')['jenis_user']=='Siswa') {
				$data1['home_header'] 		= "active";
				$data1['rental_header'] 	= "";
				$data1['status_header'] 		= "";

				$this->load->view('header_siswa.php', $data1);
				$this->load->view('index_siswa.php');

			} else {
				$data1['home_header'] 		= "active";
				$data1['student_header'] 	= "";
				$data1['prasarana_header'] 	= "";
				$data1['rental_header'] 	= "";
				$data1['back_header'] 		= "";
				$data1['report_header'] 	= "";

				$this->load->view('header.php', $data1);
				$this->load->view('index_pengelola.php');
			}
		}			
	}

	public function page_registrasi()
	{
		$this->load->view('signup.php');
	}

	public function page_kelola_siswa()
	{
		$data['siswa'] = $this->user->get_all_siswa();
		$data1['home_header'] 		= "";
		$data1['student_header'] 	= "active";
		$data1['prasarana_header'] 	= "";
		$data1['rental_header'] 	= "";
		$data1['back_header'] 		= "";
		$data1['report_header'] 	= "";

		$this->load->view('header.php', $data1);
		$this->load->view('page_kelola_siswa.php',$data);
	}

	public function page_kelola_peminjaman()
	{
		$data['peminjaman'] = $this->peminjaman->get_all_peminjaman();
		$data1['home_header'] 		= "";
		$data1['student_header'] 	= "";
		$data1['prasarana_header'] 	= "";
		$data1['rental_header'] 	= "active";
		$data1['back_header'] 		= "";
		$data1['report_header'] 	= "";

		$this->load->view('header.php', $data1);
		$this->load->view('page_kelola_peminjaman.php',$data);
	}

	public function page_kelola_prasarana()
	{
		$data['peminjaman'] = $this->peminjaman->get_all_peminjaman();
		$data1['home_header'] 		= "";
		$data1['student_header'] 	= "";
		$data1['rental_header'] 	= "";
		$data1['prasarana_header'] 	= "active";
		$data1['back_header'] 		= "";
		$data1['report_header'] 	= "";

		$this->load->view('header.php', $data1);
		$this->load->view('page_kelola_prasarana.php',$data);
	}

	public function buat_akun()
	{
		//Set validation rules
	    $this->form_validation->set_rules('nis', 'NIS', 'trim|required');
	    $this->form_validation->set_rules('nama', 'Nama Lengkap', 'trim|required|min_length[3]|max_length[30]');
	    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tb_peminjam.email]');
	    $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
	    $this->form_validation->set_rules('confirm', 'Konfirmasi Password', 'trim|md5|matches[password]|required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->page_registrasi();
		}
		else
		{
			$user = array(
				'nis' 			=> $this->input->post('nis'),
				'nama' 			=> $this->input->post('nama'), 
				'email' 		=> $this->input->post('email'), 
				'password' 		=> $this->input->post('password'),
				'status' 		=> 'Tidak Aktif',
				'jenis_user' 	=> 'Siswa'
			);

			$this->create_akun($user);
		}
	}

	public function create_akun($user)
	{
		if($this->user->insert($user)){
			$name = $this->input->post('nama');
			$email = $this->input->post('email');
			
			if($this->send_mail($email,$name)){
    			
    			$this->session->set_flashdata('registrasi', '<div class="alert alert-success text-center">Registrasi akun berhasil! Silahkan cek email Anda untuk melakukan aktivasi akun.</div>');
				redirect('c_pengelola/index');

			}else{
	      			
				// $this->session->set_flashdata('registrasi', '<div class="alert alert-danger text-center">Registrasi akun gagal! Silahkan cek data kembali.</div>');
				// redirect('c_pengelola/page_registrasi');
			}
		}
	}

	public function send_mail($email,$name) 
	{
    
	    $from_email = 'marketing@muarasejagatabadi.com'; // ganti dengan email kalian
	    $subject = 'Konfirmasi Email Anda untuk Aktivasi Akun';
	    $message = 'Kepada '. $name .',<br /><br />
	                Klik link di bawah ini untuk mengaktifkan akun anda untuk login ke aplikasi.<br /><br />
	                http://localhost/smansa/c_pengelola/verify/' . md5($email) . '<br /><br /><br />
	                Thanks<br />
	                <b>Anggit Maghfirani</b>';

	    $config['protocol'] = 'smtp';
	    $config['smtp_host'] = 'mx1.hostinger.co.id'; // sesuaikan dengan host email
	    $config['smtp_timeout'] = '7';
	    $config['smtp_port'] = '587'; // sesuaikan
	    $config['smtp_user'] = $from_email;
	    $config['smtp_pass'] = 'marketingmsa'; // ganti dengan password email ganti dengan password email
	    $config['mailtype'] = 'html';
	    $config['charset'] = 'iso-8859-1';
	    $config['wordwrap'] = TRUE;
	    $config['newline'] = "\r\n";
	    $config['crlf'] = "\r\n";
	    $this->email->initialize($config);

	    $this->email->from($from_email, 'Logistik SMAN 1 Baleendah');
	    $this->email->to($email);
	    $this->email->subject($subject);
	    $this->email->message($message);
	    
	    return $this->email->send(FALSE);
	    // gunakan return untuk mengembalikan nilai yang akan selanjutnya diproses ke verifikasi email
	    // return $this->email->send(FALSE);
	}

	public function verify($hash=NULL) {
		if ($this->user->verify($hash)) {
	      $this->session->set_flashdata('verify', '<div class="alert alert-success text-center">Email sukses diverifikasi!</div>');
	      redirect('c_pengelola/index');
	    } else {
	      $this->session->set_flashdata('verify', '<div class="alert alert-danger text-center">Email gagal diverifikasi!</div>');
	      redirect('c_pengelola/index');
	    }
	}

	public function login($value='')
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
        
  		if ($this->form_validation->run() == FALSE)
        {
            $this->index();
        }
        else
        {
        	$data = array(
	        	'email' => $this->input->post('email'),
	        	'password'   => $this->input->post('password')
        	);

        	if($this->user->cek_login($data)){
        		$result = $this->user->get_data_session($data['email']);

        		if (isset($result)) {        			
        			$data_session = array(
        				'id_peminjam' => $result->id_peminjam,
        				'email' => $result->email,
        				'nama' => $result->nama,
                        'session_id' => session_id(),
                        'jenis_user' => $result->jenis_user
        			);

        			$this->session->set_userdata('logged_in', $data_session);
        			redirect($this->index);
        		}
        	}else{
        		$this->session->set_flashdata('login','<span class="text-error">Email atau Password salah</span>');
        		$this->index();
        	}
        }
	}

	public function modal_siswa()
	{
		if($this->input->post('rowid')){
			$row = $this->user->get('id_peminjam',$this->input->post('rowid'));

			if ($row->status=="Aktif") {
				$option2 = '<option value="Aktif" selected>Aktif</option>
	            			<option value="Tidak Aktif">Tidak Aktif</option>';
			} else {
				$option2 = '<option value="Aktif">Aktif</option>
	            			<option value="Tidak Aktif" selected>Tidak Aktif</option>';
			}

			if ($row->jenis_user=="Siswa") {
				$option = '<option value="Siswa" selected>Siswa</option>
	            			<option value="Pengelola">Pengelola</option>';
			} else {
				$option = '<option value="Siswa">Siswa</option>
	            			<option value="Pengelola" selected>Pengelola</option>';
			}

			echo '<form action="'.base_url().'c_pengelola/update_siswa" method="post">
	            <input type="hidden" name="id_user" value="'.$row->id_peminjam.'">
	            <div class="form-group row">
                    <div class="col-md-6">
		                <label>Nama Depan</label>
		                <input type="text" class="form-control" name="nama" value="'.$row->nama.'" readonly>
		            </div>
                    <div class="col-md-6">
		                <label>NIS</label>
		                <input type="text" class="form-control" name="nama" value="'.$row->nis.'" readonly>
	                </div>
	            </div>
	            <div class="form-group row">
	            	<div class="col-md-6">
		                <label>Email</label>
		                <input type="text" class="form-control" name="deskripsi" value="'.$row->email.'" readonly>
	                </div>
	                <div class="col-md-6">
	                	<label>Password</label>
	                	<input type="password" class="form-control" name="password" value="'.$row->password.'" readonly>
	                </div>
	            </div>
	            <div class="form-group row">
                    <div class="col-md-6">
		                <label>Jenis Akun</label>
		                <select name="jenis_user" class="form-control show-tick">'.$option.'
	                    </select>
	                </div>
                    <div class="col-md-6">
		                <label>Status Akun</label>
		                <select name="status" class="form-control show-tick">'.$option2.'
	                    </select>
	                </div>
	            </div>
	            <button class="btn btn-primary" type="submit"><i class="material-icons">check</i>  Update</button>
	        </form>';
		}
	}

	public function update_siswa()
	{
		$data = array(
			'jenis_user' => $this->input->post('jenis_user'), 
			'status' => $this->input->post('status') 
		);

		$id_user = $this->input->post('id_user');

		if($this->user->update('id_peminjam', $id_user, $data)){
			$this->session->set_flashdata('info', '<div class="alert alert-success">
                                <p><i class="material-icons">check_circle</i>
                                <strong>Sukses!</strong> Data berhasil diubah! (ID: '.$id_user.')</p></div>');
			redirect('c_pengelola/page_kelola_siswa');
		}else{
			$this->session->set_flashdata('info', '<div class="alert alert-danger">
                                <p><i class="material-icons">check_close</i>
                                <strong>Sukses!</strong> Data gagal diubah! (ID: '.$id_user.')</p></div>');
			redirect('c_pengelola/page_kelola_siswa');
		}
	}

	public function update_status()
	{
		$data = array(
			'status' => $this->input->post('status_peminjaman')
		);

		$id_peminjaman = $this->input->post('id_peminjaman');

		if($this->peminjaman->update('id_peminjaman', $id_peminjaman, $data)){
			$this->session->set_flashdata('info', '<div class="alert alert-success">
                                <p><i class="material-icons">check_circle</i>
                                <strong>Sukses!</strong> Data berhasil diubah! (ID: '.$id_peminjaman.')</p></div>');
			redirect('c_pengelola/page_kelola_peminjaman');
		}else{
			$this->session->set_flashdata('info', '<div class="alert alert-danger">
                                <p><i class="material-icons">check_close</i>
                                <strong>Sukses!</strong> Data gagal diubah! (ID: '.$id_peminjaman.')</p></div>');
			redirect('c_pengelola/page_kelola_peminjaman');
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
			$row = $this->peminjaman->get('id_peminjaman',$this->input->post('rowid'));

			if ($row->status_peminjaman=="Menunggu Konfirmasi") {
				$option = '<option value="Menunggu Konfimasi" selected>Menunggu Konfimasi</option>
	            			<option value="Sudah Konfirmasi">Sudah Konfirmasi</option>
	            			<option value="Sedang Dipinjam">Sedang Dipinjam</option>
	            			<option value="Terkonfirmasi">Telah Kembali</option>';
			} else if ($row->status_peminjaman=="Sudah Konfirmasi") {
				$option = '<option value="Menunggu Konfimasi">Menunggu Konfimasi</option>
	            			<option value="Sudah Konfirmasi" selected>Sudah Konfirmasi</option>
	            			<option value="Sedang Dipinjam">Sedang Dipinjam</option>
	            			<option value="Terkonfirmasi">Telah Kembali</option>';
			} else if ($row->status_peminjaman=="Sedang Dipinjam"){ 
				$option = '<option value="Menunggu Konfimasi">Menunggu Konfimasi</option>
	            			<option value="Sudah Konfirmasi">Sudah Konfirmasi</option>
	            			<option value="Sedang Dipinjam" selected>Sedang Dipinjam</option>
	            			<option value="Terkonfirmasi">Telah Kembali</option>';
			} else {
				$option = '<option value="Menunggu Konfimasi">Menunggu Konfimasi</option>
	            			<option value="Sudah Konfirmasi">Sudah Konfirmasi</option>
	            			<option value="Sedang Dipinjam">Sedang Dipinjam</option>
	            			<option value="Terkonfirmasi" selected>Telah Kembali</option>';
			}

			echo '<form method="post" action="'.base_url().'c_pengelola/update_status">
	            <input type="hidden" name="id_peminjaman" value="'.$row->id_peminjaman.'">
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
		                <label>Status Peminjaman</label>
		                <select name="status_peminjaman" class="form-control show-tick">'.$option.'</select>
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
	            <button class="btn btn-primary" type="submit"><i class="material-icons">check</i>  Update</button>

	        </form>';
		}else{
			echo 'Error';
		}
	}
}