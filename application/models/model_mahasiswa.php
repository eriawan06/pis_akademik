<?php

	class Model_mahasiswa extends CI_Model
	{

		public $tableUser = "tbl_user";
		public $table ="tbl_mahasiswa";

		function getAll()
		{
		  $sql = "SELECT tm.id, tm.nim, tu.nama_lengkap, tu.gender, tm.tmpt_lahir, tm.tgl_lahir
			FROM tbl_mahasiswa tm
			LEFT JOIN tbl_user tu ON tu.id_user = tm.id_user
		  ";
		  $data = $this->db->query($sql);
				return $data;
		}

		function save($foto)
		{
			$dataUser = array(
				//tabel di database => name di form
				'nama_lengkap' 	=> $this->input->post('nama', TRUE),
				'username'    	=> $this->input->post('username', TRUE),
				'password'    	=> md5($this->input->post('password', TRUE)),
				'id_level_user' => 5,
				'gender'      	=> $this->input->post('gender', TRUE),
				'foto'			=> $foto,
			);
	
			$this->db->insert($this->tableUser, $dataUser);
	
			$this->db->where('username', $dataUser['username']);
			$user = $this->db->get($this->tableUser)->row_array();

			$data = array(
				'id_user' 		=> $user['id_user'],
				'nim'           => $this->input->post('nim', TRUE),
				'tgl_lahir' 	=> $this->input->post('tanggal_lahir', TRUE),
				'tmpt_lahir' 	=> $this->input->post('tempat_lahir', TRUE),
				'kd_agama'	    => $this->input->post('agama', TRUE),
				'kd_kelas'	    => $this->input->post('kelas', TRUE),
			);
			$this->db->insert($this->table, $data);

			// ketika pengguna menginsert data siswa, maka data nim, kd_kelas dan tahun_akademik_aktif akan otomatis terinsert dengan sendirinya ke tbl_riwayat_kelas
			$tahun_akademik = $this->db->get_where('tbl_tahun_akademik', array('is_aktif' => 'Y'))->row_array();
			$riwayat = array(
							'nim' 				=> $this->input->post('nim', TRUE),
							'kd_kelas'			=> $this->input->post('kelas', TRUE),
							'id_tahun_akademik'	=> $tahun_akademik['id_tahun_akademik']
						); 
			$this->db->insert('tbl_riwayat_kelas', $riwayat);
		}

		function update($foto)
		{
			if (empty($foto)) {
				//update tanpa foto
				$data = array(
					'nim'          => $this->input->post('nim', TRUE),
					'nama'          => $this->input->post('nama', TRUE),
					'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
					'tempat_lahir'  => $this->input->post('tempat_lahir', TRUE),
					'gender'        => $this->input->post('gender', TRUE),
					'kd_agama'	    => $this->input->post('agama', TRUE),
					'kd_kelas'	    => $this->input->post('kelas', TRUE),
				);
			} else {
				//update dengan foto
				$data = array(
					'nim'          => $this->input->post('nim', TRUE),
					'nama'          => $this->input->post('nama', TRUE),
					'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
					'tempat_lahir'  => $this->input->post('tempat_lahir', TRUE),
					'gender'        => $this->input->post('gender', TRUE),
					'kd_agama'	    => $this->input->post('agama', TRUE),
					'foto'			=> $foto,
					'kd_kelas'	    => $this->input->post('kelas', TRUE),
				);
			}

			$id	= $this->input->post('id');
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
		}

		// Fungsi untuk melakukan proses upload file
	  	public function upload_csv($filename){
		    $this->load->library('upload'); // Load librari upload
		    
		    $config['upload_path'] = './csv/';
		    $config['allowed_types'] = 'csv';
		    $config['max_size']  = '2048';
		    $config['overwrite'] = true;
		    $config['file_name'] = $filename;
		  
		    $this->upload->initialize($config); // Load konfigurasi uploadnya
		    if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
		      // Jika berhasil :
		      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
		      return $return;
		    }else{
		      // Jika gagal :
		      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
		      return $return;
		    }
		  }
	  
		// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
		public function insert_multiple($data){
		    $this->db->insert_batch('tbl_mhs', $data);
		}

	}
	
?>