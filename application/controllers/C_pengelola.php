<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pengelola extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_peminjam','user');
		$this->load->model('m_peminjaman','peminjaman');
		$this->load->model('m_prasarana','prasarana');
		$this->load->model('m_pengembalian','pengembalian');
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
		$data['prasarana'] = $this->prasarana->get_all_prasarana();
		$data1['home_header'] 		= "";
		$data1['student_header'] 	= "";
		$data1['rental_header'] 	= "";
		$data1['prasarana_header'] 	= "active";
		$data1['back_header'] 		= "";
		$data1['report_header'] 	= "";

		$this->load->view('header.php', $data1);
		$this->load->view('page_kelola_prasarana.php',$data);
	}

	public function page_kelola_pengembalian()
	{
		$data['pengembalian'] = $this->pengembalian->get_all_pengembalian();
		$data1['home_header'] 		= "";
		$data1['student_header'] 	= "";
		$data1['rental_header'] 	= "";
		$data1['prasarana_header'] 	= "";
		$data1['back_header'] 		= "active";
		$data1['report_header'] 	= "";

		$this->load->view('header.php', $data1);
		$this->load->view('page_kelola_pengembalian.php',$data);
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
			echo json_encode($row);
		}else{
			echo 'Error';
		}
	}

	public function modal_add_pengembalian()
	{
		echo '<form method="post" enctype="multipart/form-data" action="'.base_url().'c_pengelola/add_pengembalian">
	            <div class="form-group row">
                    <div class="col-md-6">
		                <label id="modal">Nama Sarana</label>
		                <input type="text" class="form-control" name="nama_prasarana" required>
		            </div>
                    <div class="col-md-6">
		                <label id="modal">Stok</label>
		                <input type="number" class="form-control" name="stok" required min="1">
	                </div>
	            </div>
	            <div class="form-group row">
	            	<div class="col-md-6">
		                <label id="modal">Status Sarana</label>
		                <select name = "status" class="form-control">
		                <option value="Baik" selected>Baik</option>
	            	<option value="Buruk">Buruk</option>
	            	</select>
	                </div>
	                
	      
	            </div>
	            <div class="form-group row">
	                <div class="col-md-6">
	                	<label id="modal">Foto Prasarana</label>
	                	<input type="file" class="form-control" name="foto" required>
	                </div>
	            </div>
	            <button class="btn btn-primary" type="submit"><i class="material-icons">check</i>  Save</button>
	        </form>';
	}

	public function add_pengembalian()
	{
		# code...
	}

	public function modal_add_prasarana()
	{
		echo '<form method="post" enctype="multipart/form-data" action="'.base_url().'c_pengelola/add_prasarana">
	            <div class="form-group row">
                    <div class="col-md-6">
		                <label id="modal">Nama Sarana</label>
		                <input type="text" class="form-control" name="nama_prasarana" required>
		            </div>
                    <div class="col-md-6">
		                <label id="modal">Stok</label>
		                <input type="number" class="form-control" name="stok" required min="1">
	                </div>
	            </div>
	            <div class="form-group row">
	            	<div class="col-md-6">
		                <label id="modal">Status Sarana</label>
		                <select name = "status" class="form-control">
		                <option value="Baik" selected>Baik</option>
	            	<option value="Buruk">Buruk</option>
	            	</select>
	                </div>
	                
	      
	            </div>
	            <div class="form-group row">
	                <div class="col-md-6">
	                	<label id="modal">Foto Prasarana</label>
	                	<input type="file" class="form-control" name="foto" required>
	                </div>
	            </div>
	            <button class="btn btn-primary" type="submit"><i class="material-icons">check</i>  Save</button>
	        </form>';
	}

	public function modal_detail_prasarana()
	{
		$prasarana = $this->prasarana->get('id_prasarana',$this->input->post('rowid'));
		echo '<form method="post" enctype="multipart/form-data" action="'.base_url().'c_pengelola/edit_prasarana">
				<input type="hidden" name="id_prasarana" value="'.$prasarana->id_prasarana.'">
	            <div class="form-group row">
                    <div class="col-md-6">
		                <label id="modal">Nama Sarana</label>
		                <input type="text" class="form-control" name="nama_prasarana" value="'.$prasarana->nama_prasarana.'" required>
		            </div>
	            </div>
	            <div class="form-group row">
	            	<div class="col-md-6">
		                <label id="modal">Status Sarana</label>
		                <select name = "status" class="form-control">
		                <option value="Baik" selected>Baik</option>
	            	<option value="Buruk">Buruk</option>
	            	</select>
	                </div>
	            </div>
	            <div class="form-group row">
	                <div class="col-md-6">
	                	<label id="modal">Foto Prasarana</label>
	                	<input type="file" class="form-control" name="foto">
	                	<input type="hidden" name="hidden_foto" value="'.$prasarana->foto.'">
	                </div>
	                <div class="col-md-6">
	                	<img src="'.base_url().'/uploads/'.$prasarana->foto.'" alt="foto_prasarana" width="50%">
	                </div>
	            </div>
	            <button class="btn btn-primary" type="submit"><i class="material-icons">check</i>  Save</button>
	        </form>';
	}

	public function add_prasarana()
	{
		$this->form_validation->set_rules('nama_prasarana', 'Nama Prasarana', 'required');
		$this->form_validation->set_rules('stok', 'Stok', 'required|numeric');
		$this->form_validation->set_rules('status', 'Status Prasarana', 'required');

		if ($this->form_validation->run()) {
			if (!empty($_FILES['foto']['tmp_name'])) {
				$config['upload_path']          = './uploads/';
	            $config['allowed_types']        = 'gif|jpg|png';
	            $config['max_size']             = 3000;
	            $config['max_width']            = 1024;
	            $config['max_height']           = 768;
	            $config['encrypt_name']			= TRUE;

	            $this->load->library('upload', $config);

	            if ($this->upload->do_upload('foto'))
	            {
					$foto = $this->upload->data();
	            } else {
	            	$errors = $this->upload->display_errors();
	            }
			}

			if (empty($errors)) {
				$data = array(
					'nama_prasarana' => $this->input->post('nama_prasarana'),
					'stok' => $this->input->post('stok'),
					'stok_tersedia' => $this->input->post('stok'),
					'status' => $this->input->post('status'),
					'foto' => (empty($foto)) ? "" : $foto['file_name']
				);
				if ($this->prasarana->insert($data)) {
					redirect('c_pengelola/page_kelola_prasarana','refresh');
				}
			} else {
				# fail upload
			}
		} else {
			# fail
		}
	}

	public function edit_prasarana()
	{
		$this->form_validation->set_rules('id_prasarana', 'ID Prasarana', 'required');
		$this->form_validation->set_rules('nama_prasarana', 'Nama Prasarana', 'required');
		$this->form_validation->set_rules('status', 'Status Prasarana', 'required');

		if ($this->form_validation->run()) {
			if (!empty($_FILES['foto']['tmp_name'])) {
				$config['upload_path']          = './uploads/';
	            $config['allowed_types']        = 'gif|jpg|png';
	            $config['max_size']             = 3000;
	            $config['max_width']            = 1024;
	            $config['max_height']           = 768;
	            $config['encrypt_name']			= TRUE;

	            $this->load->library('upload', $config);

	            if ($this->upload->do_upload('foto'))
	            {
					$foto = $this->upload->data();
					$foto = $foto['file_name'];
	            } else {
	            	$errors = $this->upload->display_errors();
	            }
			} else {
				$foto = $this->input->post('hidden_foto');
			}

			if (empty($errors)) {
				$data = array(
					'nama_prasarana' => $this->input->post('nama_prasarana'),
					'status' => $this->input->post('status'),
					'foto' => (empty($foto)) ? "" : $foto
				);
				if ($this->prasarana->update('id_prasarana',$this->input->post('id_prasarana'),$data)) {
					redirect('c_pengelola/page_kelola_prasarana','refresh');
				}
			} else {
				# fail upload
			}
		} else {
			# fail
		}
	}

	public function hapus_prasarana()
	{
		if ($this->prasarana->delete($this->input->post('id_prasarana'))) {
			redirect('c_pengelola/page_kelola_prasarana','refresh');
		} else {
			# error
		}
	}
}