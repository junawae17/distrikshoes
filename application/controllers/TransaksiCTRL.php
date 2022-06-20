<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransaksiCTRL extends Admins {
	
	public function getData() {
		$data	= $this->public_data;
		$data['title']='Data Transaksi';
		$data['currentPage']='Transaksi';
		$data['allData']= $this->db->query("select * FROM transaction__ 
											LEFT JOIN members__ on members__.member_id = transaction__.member_id 
											left join dropship__ on dropship__.id_transaksi = transaction__.transaction_id
											order by transaction__.created_date DESC ");
		$data['content']='Transaksi/AllData.php';
		$this->load->view('LanderApp/Template', $data);
	}
	
	public function saveData(){
		
		// echo '</pre>'; var_dump($_POST);
		// exit();
		$this->db->trans_begin();
		$action = $this->input->post('action');

		
		$session_user = $this->session->userdata('session_user');	
		$this->form_validation->set_rules('product_name','Jenis Akun','trim|required');
		$this->form_validation->set_rules('price','Pemilik Akun','trim|required');
		$this->form_validation->set_rules('weight','Nomor Akun','trim|required');
		// $this->form_validation->set_rules('stock','Nomor Akun','trim|required');
		$this->form_validation->set_rules('category_id','Nomor Akun','trim|required');
		// $this->form_validation->set_rules('information','Nomor Akun','trim|required');
		
		if($this->form_validation->run()==FALSE){
			$this->session->set_flashdata('error',validation_errors());
		}else{
			$data = array(
				'product_name' => $this->input->post('product_name'),
				'price' => $this->input->post('price'),
				'weight' => $this->input->post('weight'),
				'stock' => 0,
				'category_id' => $this->input->post('category_id'),
				'information' => $this->input->post('information'),
				'modified_date' => date('Y-m-d H:i:s'),
				'modified_by' => $session_user
			);
				
			$fileName = str_replace(' ', '_', str_replace('\'', '', $_FILES['images']['name']));
			if($fileName[0]!=null){ // ada file
				$this->load->library('upload');
				if(($action=='update') and ($this->input->post('images_old')!=null)){
					$convertData = explode(",",$this->input->post('images_old'));
				}else{
					$convertData = array();
				}
				$dateNow = date('YmdHis');
				for ($i=0; $i < count($fileName); $i++) { 
					$config = array(
						'upload_path'   => "./assets/uploads/transaksi",
						'allowed_types' => 'jpg|gif|png',
						'max_size'     => '1000000',                       
						'file_name'     => $dateNow.'_'.$fileName[$i],                       
					);
					$_FILES['file']['name']     = $_FILES['images']['name'][$i];
					$_FILES['file']['type']     = $_FILES['images']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
					$_FILES['file']['error']     = $_FILES['images']['error'][$i];
					$_FILES['file']['size']     = $_FILES['images']['size'][$i];
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('file')){
						$fileData = $this->upload->data();
						array_push($convertData, $dateNow.'_'.$fileName[$i]);
					}
				}
				if($action=='update'){
					if($fileName[0]!=null){
						$data += array(
							'images_product' => implode(",",$convertData),
						);
					}
					$where = array(
						'product_id' => $this->input->post('product_id'),
					);
					$this->M__db->update('product__',$where,$data);
				}else{
					$data += array(
						'images_product' => implode(",",$convertData),
						'is_active' => 1,
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $session_user
					);
					
					$this->M__db->simpan('product__',$data);
					$idp =  $this->db->insert_id();

					if ($this->input->post('stock')){
						foreach ($this->input->post('stock') as $key => $value) {
							// foreach($this->input->post('stock')[$key] as $dt => $dts){
								for ($x = 1; $x <= $this->input->post('stock')[$key]; $x++) {
 
							 	$datastok = [ 
							            'product_id' => $idp, 
							            'id_size' => $this->input->post('id_size')[$key], 
							            // 'stock' => $this->input->post('stock')[$key], 
							            'created_date' => date('Y-m-d H:i:s'),
										'created_by' => $session_user,
										'modified_date' => date('Y-m-d H:i:s'),
										'modified_by' => $session_user
							 	];

							 	$this->M__db->simpan('datastock__',$datastok);
						 	}
						}
					}
				}
						
			}else{ // tidak ada file
				$where = array(
					'product_id' => $this->input->post('product_id'),
				);
				$this->M__db->update('product__',$where,$data);
			}
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error','Data Produk gagal disimpan');	
			}else{
				$this->db->trans_commit();
				$this->session->set_flashdata('success','Data Produk berhasil disimpan!');	
			}
		}
		if($action=='update'){
			redirect(base_url().'Admin/formTransaksi/'.paramEncrypt($this->input->post('product_id')));
		}else{
			redirect(base_url().'Admin/Transaksi');
		}
	}

	public function saveStock(){
		
		$this->db->trans_begin();
		$action = $this->input->post('action');
		if ($this->input->post('stock')){
			foreach ($this->input->post('stock') as $key => $value) {
									// foreach($this->input->post('stock')[$key] as $dt => $dts){
				for ($x = 1; $x <= $this->input->post('stock')[$key]; $x++) {
		 
					$datastok = [ 
									            'product_id' => $this->input->post('product_id'), 
									            'id_size' => $this->input->post('id_size')[$key], 
									            // 'stock' => $this->input->post('stock')[$key], 
									            'created_date' => date('Y-m-d H:i:s'),
												'created_by' => $session_user,
												'modified_date' => date('Y-m-d H:i:s'),
												'modified_by' => $session_user
								];

								$this->M__db->simpan('datastock__',$datastok);
				}
			}
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error','Data Produk gagal disimpan');	
		}else{
			$this->db->trans_commit();
			$this->session->set_flashdata('success','Data Produk berhasil disimpan!');	
		}
				
		if($action=='update'){
					redirect(base_url().'Admin/formTransaksi/'.paramEncrypt($this->input->post('product_id')));
		}else{
					redirect(base_url().'Admin/Transaksi');
		}
	}

	
	
	public function saveGambar(){
		
		// echo '</pre>'; var_dump($_POST);
		// exit();
		$this->db->trans_begin();
		$action = $this->input->post('action');

		
		$session_user = $this->session->userdata('session_user');	
	
		// if($this->form_validation->run()==FALSE){
		// 	$this->session->set_flashdata('error',validation_errors());
		// }else{
			
				
			$fileName = str_replace(' ', '_', str_replace('\'', '', $_FILES['images']['name']));
			if($fileName[0]!=null){ // ada file
				$this->load->library('upload');
				if(($action=='update') and ($this->input->post('images_old')!=null)){
					$convertData = explode(",",$this->input->post('images_old'));
				}else{
					$convertData = array();
				}
				$dateNow = date('YmdHis');
				for ($i=0; $i < count($fileName); $i++) { 
					$config = array(
						'upload_path'   => "./assets/uploads/product",
						'allowed_types' => 'jpg|gif|png',
						'max_size'     => '1000000',                       
						'file_name'     => $dateNow.'_'.$fileName[$i],                       
					);
					$_FILES['file']['name']     = $_FILES['images']['name'][$i];
					$_FILES['file']['type']     = $_FILES['images']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
					$_FILES['file']['error']     = $_FILES['images']['error'][$i];
					$_FILES['file']['size']     = $_FILES['images']['size'][$i];
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('file')){
						$fileData = $this->upload->data();
						array_push($convertData, $dateNow.'_'.$fileName[$i]);
					}
				}
				if($action=='update'){
					if($fileName[0]!=null){
						$data = array(
							'images_product' => implode(",",$convertData),
						);
					}
					$where = array(
						'product_id' => $this->input->post('product_id'),
					);
					$this->M__db->update('product__',$where,$data);
				}else{
					$data = array(
						'images_product' => implode(",",$convertData),
						'is_active' => 1,
						'created_date' => date('Y-m-d H:i:s'),
						'created_by' => $session_user
					);
					
					$this->M__db->simpan('product__',$data);
					$idp =  $this->db->insert_id();

				}
						
			}else{ // tidak ada file

				$where = array(
					'product_id' => $this->input->post('product_id'),
				);

				$this->M__db->update('product__',$where,$data);
			}

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error','Gambar Produk gagal disimpan');	
			}else{
				$this->db->trans_commit();
				$this->session->set_flashdata('success','Gambar Produk berhasil disimpan!');	
			}
		// }

		if($action=='update'){
			redirect(base_url().'Admin/formTransaksi/'.paramEncrypt($this->input->post('product_id')));
		}else{
			redirect(base_url().'Admin/Transaksi');
		}
	}


	public function saveDataResi(){
		
		// echo '</pre>'; var_dump($this->input->post('resi'));
		// exit();

		$this->db->trans_begin();
		$action = $this->input->post('action');
		$session_user = $this->session->userdata('session_user');	
	
		// if($this->form_validation->run()==FALSE){
		// 	$this->session->set_flashdata('error',validation_errors());
		// }else{
			
				
			$fileName = str_replace(' ', '_', str_replace('\'', '', $_FILES['images']['name']));
			if($fileName[0]!=null){ // ada file
				$this->load->library('upload');
				if(($action=='update') and ($this->input->post('images_old')!=null)){
					$convertData = explode(",",$this->input->post('images_old'));
				}else{
					$convertData = array();
				}
				$dateNow = date('YmdHis');
				for ($i=0; $i < count($fileName); $i++) { 
					$config = array(
						'upload_path'   => "./assets/uploads/dataresi",
						'allowed_types' => 'jpg|gif|png',
						'max_size'     => '1000000',                       
						'file_name'     => $dateNow.'_'.$fileName[$i],                       
					);
					$_FILES['file']['name']     = $_FILES['images']['name'][$i];
					$_FILES['file']['type']     = $_FILES['images']['type'][$i];
					$_FILES['file']['tmp_name'] = $_FILES['images']['tmp_name'][$i];
					$_FILES['file']['error']     = $_FILES['images']['error'][$i];
					$_FILES['file']['size']     = $_FILES['images']['size'][$i];
					
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					
					if($this->upload->do_upload('file')){
						$fileData = $this->upload->data();
						array_push($convertData, $dateNow.'_'.$fileName[$i]);
					}
				}
				if($action=='update'){
					if($fileName[0]!=null){
						$data = array(
							'no_resi' => $this->input->post('resi'),
							'gambar_resi' => implode(",",$convertData),
							'created_date_resi' => date('Y-m-d H:i:s'),
							'created_by_resi' => $session_user,
						);
					}
					$where = array(
						'transaction_id' => $this->input->post('id_transaction'),
					);
					$this->M__db->update('transaction__',$where,$data);

				}

						
			}else{ // tidak ada file

				$data = array(
							'no_resi' => $this->input->post('resi'),
							'created_date_resi' => date('Y-m-d H:i:s'),
							'created_by_resi' => $session_user,
						);
				$where = array(
					'transaction_id' => $this->input->post('id_transaction'),
				);

				$this->M__db->update('transaction__',$where,$data);

			}

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$this->session->set_flashdata('error','Gambar resi  gagal disimpan');	
			}else{
				$this->db->trans_commit();
				$this->session->set_flashdata('success','Gambar  resi  berhasil disimpan!');	
			}
		// }

		if($action=='update'){
			redirect(base_url().'Admin/Transaksi');
		}else{
			redirect(base_url().'Admin/Transaksi');
		}
	}
	
	public function updateStatusPembayaran(){
		$this->db->trans_begin();
		$where = array(
			'transaction_id' => $this->uri->segment(3)
			);
			$data = array(
			'status' => $this->uri->segment(4),
			// 'modified_date' => date('Y-m-d H:i:s'),
			'modified_by' => $this->session->userdata('session_user')
		);
		
		$this->M__db->update('transaction__',$where,$data);
		if($this->uri->segment(4)==1){ $ms='Belum';}else{ $ms='Selesai';}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error','Status Transaksi pembayaran '.$ms.'!');	
		}else{
			$this->db->trans_commit();
			$this->session->set_flashdata('success','Status Transaksi pembayaran '.$ms.'!');	
		}
		redirect('Admin/Transaksi');
	}

	public function updateStatusPengiriman(){
		$this->db->trans_begin();
		$where = array(
			'transaction_id' => $this->uri->segment(3)
			);
			$data = array(
			'status_pengiriman' => $this->uri->segment(4),
			// 'modified_date' => date('Y-m-d H:i:s'),
			'modified_by' => $this->session->userdata('session_user')
		);
		
		$this->M__db->update('transaction__',$where,$data);
		if($this->uri->segment(4)==1){ $ms='Belum';}else{ $ms='Selesai';}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error','Status Transaksi pembayaran '.$ms.'!');	
		}else{
			$this->db->trans_commit();
			$this->session->set_flashdata('success','Status Transaksi pembayaran '.$ms.'!');	
		}
		redirect('Admin/Transaksi');
	}

	public function updateStatusTransaksi(){
		$this->db->trans_begin();
		$where = array(
			'transaction_id' => $this->uri->segment(3)
			);
			$data = array(
			'status_transaksi' => $this->uri->segment(4),
			'modified_date' => date('Y-m-d H:i:s'),
			'modified_by' => $this->session->userdata('session_user')
		);
		
		$this->M__db->update('transaction__',$where,$data);
		if($this->uri->segment(4)==1){ $ms='Belum';}else{ $ms='Selesai';}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error','Status Transaksi pembayaran '.$ms.'!');	
		}else{
			$this->db->trans_commit();
			$this->session->set_flashdata('success','Status Transaksi pembayaran '.$ms.'!');	
		}
		redirect('Admin/Transaksi');
	}
	
	public function imagesTransaksi(){
		$this->db->trans_begin();
		$where = array(
			'product_id' => $this->uri->segment(3)
		);
		$rows = $this->M__db->cek('product__','images_product',$where)->row_array();
		$images = explode(',',$rows['images_product']);
		$convertData =  array();
		foreach ($images as $key) {
			if($key!=$this->uri->segment(4)){
				array_push($convertData, $key);
			}
		}
		$data = array(
			'images_product' => implode(",",$convertData),
			'modified_date' => date('Y-m-d H:i:s'),
			'modified_by' => $this->session->userdata('session_user')
		);
		
		$this->M__db->update('product__',$where,$data);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error','Gambar Produk gagal dihapus!');	
		}else{
			@unlink("./assets/uploads/transaksi/".$this->uri->segment(4));
			$this->db->trans_commit();
			$this->session->set_flashdata('success','Gambar Porduk berhasil dihapus!');	
		}
		redirect(base_url().'Admin/formTransaksi/'.paramEncrypt($this->uri->segment(3)));
	}

	public function hapusStock(){
		$this->db->trans_begin();
		$where = array(
			'id_stock' => $this->uri->segment(3)
		);
		$data = array(
			'status_stock' => 2,
			'modified_date' => date('Y-m-d H:i:s'),
			'modified_by' => $this->session->userdata('session_user')
		);
		
		$this->M__db->update('datastock__',$where,$data);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->session->set_flashdata('error','Data Stock  gagal dihapus!');	
		}else{
		
			$this->db->trans_commit();
			$this->session->set_flashdata('success','Data Stock  berhasil dihapus!');	
		}
		redirect(base_url().'Admin/formTransaksi/'.paramEncrypt($this->uri->segment(4)));
	}

	

	public function formData() {
		$data	= $this->public_data;
		$data['title']='Data Produk';
		$data['currentPage']='Transaksi';
		$where = array(
			'product_id' => paramDecrypt($this->uri->segment(3)),
			);
		$data['rows']=$this->M__db->cek('product__','*',$where)->row_array();
		// $data['rowsstock']=$this->M__db->cek('datastock__','*',$where)->get();
		$data['content']='Product/formProduct.php';
		$this->load->view('LanderApp/Template', $data);
	}

	public function loadData(){
		$action =$this->input->post('action');
		$where = array(
			'transaction_id' => $this->input->post('id')
			);
		 $data['row'] = $this->M__db->cek('transaction__','*',$where)->row_array();
		 // var_dump($data['row'] );
		 // exit();
		 $data['id_product'] =  $this->input->post('id') ;
		
		$this->load->view('LanderApp/Transaksi/Detail', $data);
		
	}

	public function printalamat(){

	$data['datarow']= $this->db->query("select * FROM transaction__ 
											LEFT JOIN members__ on members__.member_id = transaction__.member_id 
											left join dropship__ on dropship__.id_transaksi = transaction__.transaction_id
											 where transaction__.transaction_id = ".paramDecrypt($this->uri->segment(3))." ")->row(); 
    // $data = array(
    //     "dataku" => array(
    //         "nama" => ,
    //         "url" => "http://petanikode.com"
    //     )
    // );

    $this->load->library('pdf');
    $this->pdf->setPaper('A4', 'landscape');
    $this->pdf->filename = "alamat.pdf";
    $this->pdf->load_view('LanderApp/Transaksi/alamat', $data);


}


	
}
